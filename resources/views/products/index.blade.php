<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-[3rem] text-cream leading-wider">
            {{ __('All Products') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto px-[2rem] grid grid-cols-8 gap-2">
            <div class="col-span-8 border-4 border-espresso">

                <div class="grid grid-cols-9 gap-4 border-4 border-black-600 px-3 py-1">
                    <p class="font-bold">No.</p>
                    <p class="font-bold">Product </p>
                    <p class="font-bold">Price</p>
                    <p class="font-bold">Discount</p>
                    <p class="font-bold">Stock</p>
                    <p class="font-bold">Created At</p>
                    <p class="font-bold">Updated At</p>
                    <p class="font-bold col-span-2">Actions</p>
                </div>

                @foreach ($products as $product)
                    <div class="grid grid-cols-9 gap-4 pt-4 border-b-2 px-3">
                        <p class="font-bold">{{ $products->firstItem() + $loop->index }}</p>
                        <p class="font-bold">{{ $product->product_name }}</p>
                        @if ($product->discount == null)
                            <p>{{ $product->product_price }}</p>
                        @else
                            <p>{{ $product->product_price }}</p>
                        @endif
                        @if ($product->discount == null)
                            <span class="text-red-600">No Discount</span>
                        @else
                            <p>{{ $product->discount }} %</p>
                        @endif
                        <p>{{ $product->product_stock }}</p>
                        @if ($product->created_at == null)
                            <span class="text-red-600">Date not set</span>
                        @else
                            <p>{{ Carbon\Carbon::parse($product->created_at)->diffForHumans() }}</p>
                        @endif
                        @if ($product->updated_at == null)
                            <span class="text-red-600">Date not set</span>
                        @else
                            <p>{{ Carbon\Carbon::parse($product->updated_at)->diffForHumans() }}</p>
                        @endif
                        <p class="text-white col-span-2">
                            <a href="" class="bg-latte hover:bg-latte-700 px-2 me-1 py-1 rounded-sm mb-1">Add
                                discount
                            </a>
                            <a href=""
                                class="bg-caramel edit-button hover:bg-coffee-brown px-2 me-1 py-1 rounded-sm mb-1">Edit
                            </a>
                            <a href="" class="bg-red hover:bg-crimson px-2 py-1 rounded-sm mb-1">Trash
                            </a>
                        </p>
                    </div>
                @endforeach
                <div class="container mx-auto mt-2 px-[2rem] pt-4 pb-2">
                    {{ $products->links() }}
                </div>
            </div>

            <div class="border-4 px-4 pb-4 col-span-3 pt-0 border-espresso rounded-sm">
                <form action="" method="POST">
                    @csrf
                    <label for="category_name" class="block font-bold text-lg mt-2">Add Product</label>
                    <input type="text" name="category_name" id="category_name"
                        class="rounded block p-1 mt-2 w-full focus:border-coffee-brown focus:ring-coffee-brown"
                        placeholder="Enter Category">
                    @error('category_name')
                        <span class="text-red mt-1">{{ $message }}</span>
                    @enderror
                    <button
                        class="block bg-caramel hover:bg-espresso mt-4 w-full py-1 rounded-sm text-white">Add</button>
                </form>
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
            </div>

        </div>
    </div>

</x-app-layout>
