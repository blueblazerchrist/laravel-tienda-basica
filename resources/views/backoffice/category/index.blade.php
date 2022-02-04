<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('categories.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 m-1 mb-2">Crear Nueva categoria</a>
            <x-table :columns="$columns" :data="$categories" :actions="$actions"></x-table>
        </div>
    </div>
</x-app-layout>

<script>
    const categoryEditElements = document.getElementsByClassName('categories_edit');
    const categoryDeleteElements = document.getElementsByClassName('categories_delete');

    Array.from(categoryEditElements).forEach(function(element) {
        element.addEventListener('click', function() {
            const id = this.getAttribute('id')
            window.location.href = `{{ url('categories') }}/${ id }/edit`
        });
    });

    Array.from(categoryDeleteElements).forEach(function(element) {
        element.addEventListener('click', function() {
            const id = this.getAttribute('id')
            const url = `{{ url('categories') }}/${id}`
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
