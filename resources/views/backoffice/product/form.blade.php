<div class="px-4 py-5 bg-white sm:p-6">
    <div class="grid grid-cols-1 gap-1">

        <div>
            <label class="block text-sm font-medium text-gray-700"> Cover photo </label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="product_image" class="cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Upload a file</span>
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                    <input id="product_image" name="product_image" type="file" class="absolute drag-and-drop cursor-pointer top-0 left-0">
                    <div class="container-img-preview absolute top-0 left-0">
                        <img src="@if(isset($product->product_image)){{ url('image-viewer',$product->product_image) }}@endif"
                             class="img-preview @if(!isset($product->product_image)) display-none @endif"
                             id="img_preview">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Categoria</label>

            <select id="category_id" option-selected="@if(isset($product)){{ $product->category_id }}@endif" name="category_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option name="{{ null }}">Seleccione una categoria</option>
            </select>
        </div>

        <div class="col-span-6 sm:col-span-3">
            <label for="product_name" class="block text-sm font-medium text-gray-700">Nombre del producto</label>
            <input type="text"
                   name="product_name"
                   id="product_name"
                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                   value="@if(isset($product->product_name)){{ $product->product_name }}@endif"
            >
        </div>

        <div class="col-span-6 sm:col-span-3">
            <label for="reference" class="block text-sm font-medium text-gray-700">Referencia</label>
            <input type="text"
                   name="reference"
                   id="reference"
                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                   value="@if(isset($product->reference)){{ $product->reference }}@endif"
            >
        </div>

    </div>
</div>
<div class="px-4 py-3 text-right sm:px-6">
    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
</div>

<script>
    const imgInp = document.getElementById('product_image');
    const blah = document.getElementById('img_preview');

    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.classList.remove('display-none');
            blah.classList.add('display-block');
            blah.src = URL.createObjectURL(file)
        } else {
            blah.classList.add('display-none');
            blah.classList.remove('display-block');
            blah.src = '';
        }
    }

    const requestOptions = {
        method: 'GET',
    };

    const select = document.getElementById('category_id');
    const categoryId = parseInt(select.getAttribute('option-selected'));

    fetch("{{ url( 'api/list-categories') }}", requestOptions)
        .then(response => response.json())
        .then(result => {
            if(result.status) {
                result.categories.forEach( category => {
                    const opt = document.createElement('option');
                    const text = document.createTextNode(category.category_name);
                    opt.appendChild( text );
                    opt.value = category.id;
                    select.appendChild(opt);
                    if(categoryId === category.id) {
                        opt.setAttribute('selected','true');
                    }
                })
            }
        })
        .catch(error => console.log('error', error));
</script>
