<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Images') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1>Products</h1>

                <form enctype="multipart/form-data" action="{{ route('images.store') }}" method="POST">
                    @csrf
                    <label for="product_img" class="block font-bold text-lg mt-2">Add Category</label>
                    <input type="file" name="product_img" id="category_name"
                        class="rounded block p-1 mt-2 w-full focus:border-coffee-brown focus:ring-coffee-brown"
                        placeholder="Enter Category">
                    @error('product_img')
                        <span class="text-red mt-1">{{ $message }}</span>
                    @enderror
                    <button type="submit"
                        class="block bg-caramel hover:bg-espresso mt-4 w-full py-1 rounded-sm text-white">Upload</button>
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


        @foreach ($images as $image)
        <div>
          @if ($image->product_img)
          <img src="{{ $image->product_img }}" class="w-[3rem] h-[3rem]" alt="">
          @else
          <span>No image</span>
          @endif
        </div>
        @endforeach

            </div>
        </div>
    </div>

</x-app-layout>
