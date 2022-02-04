<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos ver') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-1 gap-1">
                            <div class="bg-white">
                                <div class="pt-6">
                                    <!-- Image gallery -->
                                    <div class="lg:pr-1">
                                        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl title-money">
                                            <span>{{$product->product_name}}</span><small class="font-medium">$1900</small>
                                        </h1>
                                    </div>

                                    <div class="mt-6 max-w-2xl mx-auto sm:px-1 lg:px-1 lg:grid lg:grid-cols-1 lg:gap-x-1">
                                        <div class="container-img-preview-show">
                                            <img src="{{ url('image-viewer',$product->product_image) }}" alt="Model wearing plain white basic tee." class="w-full h-full object-center object-cover">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
