<div class="col-span-6 sm:col-span-3">
    <label for="category_name" class="block text-sm font-medium text-gray-700">Nombre de la categoria</label>
    <input type="text"
           name="category_name"
           id="category_name"
           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
           value="@if(isset($category->category_name)) {{ $category->category_name }} @endif"
    >
</div>
<div class="py-3 text-right">
    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ $text }}</button>
</div>
