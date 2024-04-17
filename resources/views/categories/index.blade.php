<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-[3rem] text-cream leading-wider">
                All Categories
            </h2>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="container mx-auto px-[2rem] grid grid-cols-4 gap-2">
            <div class="col-span-3 border-4 border-espresso">

                <div class="grid grid-cols-6 gap-4 border-4 border-black-600 px-3 py-1">
                    <p class="font-bold">No.</p>
                    <p class="font-bold">Category ID</p>
                    <p class="font-bold">Category</p>
                    <p class="font-bold">Created At</p>
                    <p class="font-bold">Updated At</p>
                    <p class="font-bold">Actions</p>
                </div>

                @foreach ($categories as $category)
                    <div class="grid grid-cols-6 gap-4 pt-4 border-b-2 px-3">
                        {{-- categories.firstItem + loop-iteration.currentindex yung parang logic --}}
                        <p class="font-bold">{{ $categories->firstItem() + $loop->index }}</p>
                        <p class="font-bold">{{ $category->category_id }}</p>
                        <p>{{ $category->category_name }}</p>
                        {{-- <p>{{ $category->user_id }}</p> --}}
                        @if ($category->created_at == null)
                            <span class="text-red-600">Date not set</span>
                        @else
                            <p>{{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</p>
                        @endif
                        @if ($category->updated_at == null)
                            <span class="text-red-600">Date not set</span>
                        @else
                            <p>{{ Carbon\Carbon::parse($category->updated_at)->diffForHumans() }}</p>
                        @endif
                        <p class="text-white">
                            <a href="{{ route('categories.edit', $category->category_id) }}"
                                class="bg-caramel edit-button hover:bg-coffee-brown px-2 py-1 rounded-sm mb-1">Edit</a>
                            <a href="{{ route('categories.softDelete', $category->category_id) }}"
                                class="bg-red hover:bg-crimson px-2 py-1 rounded-sm mb-1">Trash</a>
                        </p>
                    </div>
                @endforeach
                <div class="container mx-auto mt-2 px-[2rem] pt-4 pb-2">
                    {{ $categories->links() }}
                </div>
            </div>

            <div class="border-4 px-4 pb-4 pt-0 border-espresso rounded-sm">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <label for="category_name" class="block font-bold text-lg mt-2">Add Category</label>
                    <input type="text" name="category_name" id="category_name"
                        class="rounded block p-1 mt-2 w-full focus:border-coffee-brown focus:ring-coffee-brown"
                        placeholder="Enter Category">
                    @error('category_name')
                        <span class="text-red mt-1">{{ $message }}</span>
                    @enderror
                    <button
                        class="block bg-caramel hover:bg-espresso mt-4 w-full py-1 rounded-sm text-white">Add</button>
                </form>
                {{-- edit --}}
                @if ($editing ?? false)
                    <hr class="h-[0.15rem] bg-coffee-brown text-coffee-brown my-3">
                    <form action="{{ route('categories.update', $toBeEdited->category_id) }}" method="POST">
                        @csrf
                        @method('put')
                        <label for="category_name" class="block font-bold text-lg">Update Category</label>
                        <input
                            type="text"
                            name="category_name"
                            value="{{ $toBeEdited->category_name }}"
                            class="rounded block p-1 mt-2 w-full focus:border-coffee-brown focus:ring-coffee-brown"
                            placeholder="Enter Category">
                        @error('category_name')
                            <span class="text-red mt-1">{{ $message }}</span>
                        @enderror
                        <div class="flex space-x-1">

                            <button class="block bg-caramel hover:bg-espresso mt-4 flex-1 py-1 rounded-sm text-white">
                                Update
                            </button>
                            <a href="{{ route('categories.cancel') }}" class="bg-red mt-4 flex-1 hover:bg-crimson text-center text-cream pt-[4px] rounded-sm">Cancel</a>
                        </div>
                    </form>
                @endif

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


        <div class="container mx-auto mt-4 px-[2rem] grid grid-cols-4 gap-2">
            <div class="col-span-3 border-4 border-espresso">

                <div class="grid grid-cols-5 gap-4 border-4 border-black-600 px-3 py-1">
                    <p class="font-bold">No.</p>
                    <p class="font-bold">Category ID</p>
                    <p class="font-bold">Category</p>
                    <p class="font-bold">Trashed at</p>
                    <p class="font-bold">Actions</p>
                </div>

                @foreach ($trashes as $trash)
                    <div class="grid grid-cols-5 gap-4 pt-4 border-b-2 px-3">
                        <p class="font-bold">{{ $trashes->firstItem() + $loop->index }}</p>
                        <p class="font-bold">{{ $trash->category_id }}</p>
                        <p>{{ $trash->category_name }}</p>
                        {{-- <p>{{ $category->user_id }}</p> --}}
                        @if ($trash->deleted_at == null)
                            <span class="text-red-600">Date not set</span>
                        @else
                            <p>{{ Carbon\Carbon::parse($trash->deleted_at)->diffForHumans() }}</p>
                        @endif
                        <p class="text-white">
                            <a href="{{ route('categories.restore', $trash->category_id) }}"
                                class="bg-caramel hover:bg-coffee-brown px-2 py-1 rounded-sm mb-1">Restore</a>
                            <a href="{{ route('categories.forceDelete', $trash->category_id) }}"
                                class="bg-red hover:bg-crimson px-2 py-1 rounded-sm mb-1">Delete</a>
                        </p>
                    </div>
                @endforeach
                <div class="container mx-auto mt-2 px-[2rem] pt-4 pb-2">
                    {{ $trashes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
