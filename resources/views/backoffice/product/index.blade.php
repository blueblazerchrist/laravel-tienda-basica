<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 m-1 mb-2">Crear nuevo producto</a>
            <x-table :columns="$columns" :data="$products" :actions="$actions"></x-table>
        </div>
    </div>
</x-app-layout>

<div id="modal" product-id="" class="display-none absolute top-0 left-0 rounded">
    <article class="container-modal bg-white p-5 rounded-lg">
        <header id="modal-header" class="title-modal">titulo</header>
        <article id="modal-body" class="body-modal">hola mundo</article>
        <footer id="modal-footer" class="footer-modal">button</footer>
    </article>
</div>

<script>
    const productEditElements = document.getElementsByClassName('products_edit');
    const productShowElements = document.getElementsByClassName('products_show');
    const productDeleteElements = document.getElementsByClassName('products_delete');
    const pricesModalElements = document.getElementsByClassName('prices_modal');
    const pricesModalDisplayElements = document.getElementById('modal');
    const pricesModalDisplayHeaderElements = document.getElementById('modal-header');

    const modal = document.getElementById('modal');

    Array.from(productEditElements).forEach(function(element) {
        element.addEventListener('click', function() {
            const id = this.getAttribute('id')
            window.location.href = `{{ url('products') }}/${ id }/edit`
        });
    });

    Array.from(productShowElements).forEach(function(element) {
        element.addEventListener('click', function() {
            const id = this.getAttribute('id')
            window.location.href = `{{ url('products') }}/${ id }`
        });
    });

    Array.from(pricesModalElements).forEach(function(element) {
        element.addEventListener('click', function() {
            const id = this.getAttribute('id')
            modal.classList.remove('display-none')
            modal.classList.add('flex')
            modal.setAttribute('product-id', id);

            const requestOptions = {
                method: 'GET',
                redirect: 'follow'
            };

            fetch(`{{url('api/products',)}}/${id}`, requestOptions)
                .then(response => response.json())
                .then(result => {
                    if(result.status) {
                        pricesModalDisplayHeaderElements.innerHTML = '';
                        const productName = document.createElement('span');
                        productName.textContent = result.product.product_name;
                        const productReference = document.createElement('span');
                        productReference.textContent = result.product.reference;
                        pricesModalDisplayHeaderElements.appendChild(productName);
                        pricesModalDisplayHeaderElements.appendChild(productReference);
                    }
                })
                .catch(error => console.log('error', error));
        });
    });

    pricesModalDisplayElements.addEventListener('click', function(e) {
        if(e.target === e.currentTarget) {
            modal.classList.add('display-none')
            modal.classList.remove('flex')
        }
    });

    Array.from(productDeleteElements).forEach(function(element) {
        element.addEventListener('click', function() {
            const id = this.getAttribute('id')
            const url = `{{ url('products') }}/${id}`
            const formData = new FormData();
            formData.append("_method", "delete");
            formData.append("_token", "{{csrf_token()}}");

            const requestOptions = {
                method: 'POST',
                body: formData,
                redirect: 'follow'
            };

            fetch(url, requestOptions)
                .then(response => response.json())
                .then(data => {
                    if(data.status) {
                        location.reload();
                    }
                })
                .catch(error => console.log('error', error));
        });
    });
</script>
