<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-[3rem] text-cream leading-wider">
            {{ __('All Products') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto px-[2rem] grid grid-cols-9 gap-2">
            <div class="col-span-9 border-4 border-espresso">
                <div class="grid grid-cols-[repeat(23,1fr)] gap-4 border-4 border-black-600 px-3 py-1">
                    <p class="font-bold col-span-1">No.</p>
                    <p class="font-bold col-span-3">Product </p>
                    <p class="font-bold col-span-2">Image </p>
                    <p class="font-bold col-span-3">Price</p>
                    <p class="font-bold col-span-2">Discount</p>
                    <p class="font-bold col-span-1">Stock</p>
                    <p class="font-bold col-span-2">Created At</p>
                    <p class="font-bold col-span-2">Updated At</p>
                    <p class="font-bold col-span-7">Actions</p>
                </div>
                @include('products.components.product')
            </div>

            <div class="border-4 px-4 pb-4 col-span-4 pt-0 border-espresso rounded-sm">
                @include('products.components.add_product')
                @include('products.components.add_discount')
                @include('products.components.add')
                @include('products.components.edit')
                @include('products.components.stock_management')
                @if (session('success'))
                    <div id="toast-success"
                        class="flex items-center w-full max-w-lg mt-5 p-4 mb-4 text-gray-500 bg-latte rounded-sm shadow dark:text-cream dark:bg-coffee-brown ms-auto"
                        role="alert">
                        <div
                            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-espresso dark:text-green">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>
                            <span class="sr-only">Check icon</span>
                        </div>
                        <div class="ms-3 text-sm font-normal">{{ session('success') }}</div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-coffee-brown dark:hover:bg-espresso"
                            data-dismiss-target="#toast-success" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endif
                <script>
                    function displayFileName(input) {
                        const fileNameSpan = document.getElementById('imageFileName');
                        if (input.files.length > 0) {
                            fileNameSpan.textContent = input.files[0].name;
                        } else {
                            fileNameSpan.textContent = 'No Image Uploaded';
                        }
                    }
                </script>
            </div>

            <div class="border-4 pb-4 col-span-5 pt-0 border-espresso rounded-sm">
                <div class="grid grid-cols-4 gap-4 border-4 border-black-600 px-3 py-1">
                    <p class="font-bold">No.</p>
                    <p class="font-bold">Product </p>
                    <p class="font-bold">Trashed At</p>
                    <p class="font-bold">Actions</p>
                </div>
                @include('products.components.trash')
            </div>


        </div>
    </div>

</x-app-layout>
