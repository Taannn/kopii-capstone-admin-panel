@if ($adding ?? false)
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex p-4 justify-between gap-4 text-espresso">
            <div class="text-coffee-brown flex-1">
                <div>
                    <label for="product_name">Product Name</label>
                    <input type="text"
                        class="rounded block p-1 mt-2 w-full border-2 border-caramel focus:border-coffee-brown focus:ring-coffee-brown"
                        name="product_name" id="product_name" placeholder="e.g. Brown Mug" />
                    @error('product_name')
                        <span class="text-red mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="product_desc">Product Description</label><br>
                    <textarea name="product_desc" id="product_desc"
                        class="rounded block p-1 mt-2 w-full border-2 border-caramel focus:border-coffee-brown focus:ring-coffee-brown"
                        rows="3" placeholder="e.g. Elegently crafted mugs from..."></textarea>
                    @error('product_desc')
                        <span class="text-red mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-5">
                    <label for="product_img">Product Image</label>
                    <input
                        style="visibility: hidden; position: absolute;"
                        type="file" name="product_img" id="product_img"
                        onchange="displayFileName(this)"
                        class="rounded block p-1 mt-2 w-full border-2 border-caramel bg-cream focus:border-coffee-brown focus:ring-coffee-brown" />
                    <div
                        onclick="getElementById('product_img').click()"
                        class="rounded-sm p-1 border-caramel border-2 flex align-items-center">
                        <button type="button" class="inline-block p-1 bg-caramel text-cream rounded-sm">Upload Image</button>
                        <span id="imageFileName" class="text-espresso ms-1 mt-[0.3rem] text-[0.8rem]">No Image Uploaded</span>
                    </div>
                    @error('product_img')
                        <span class="text-red mt-1">{{ $message }}</span>
                    @enderror
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
            </div>
            <div class="text-coffee-brown flex-1">
                <div>
                    <label for="product_price">Product Price</label>
                    <input
                        type="text" name="product_price" id="product_price"
                        onkeypress="return /[0-9]/i.test(event.key)"
                        maxlength="12"
                        class="rounded block p-1 mt-2 w-full border-2 border-caramel focus:border-coffee-brown focus:ring-coffee-brown" />
                    @error('product_price')
                        <span class="text-red mt-1">{{ $message }}</span>
                    @enderror
                    </div">
                    <div class="mt-4">
                        <label for="product_stock">Product Stock</label>
                        <input
                            type="text"
                            onkeypress="return /[0-9]/i.test(event.key)"
                            maxlength="5"
                            class="rounded block p-1 mt-2 w-full border-2 border-caramel focus:border-coffee-brown focus:ring-coffee-brown"
                            name="product_stock" id="product_stock" />
                        @error('product_stock')
                            <span class="text-red mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-4">
                        <label for="category_id">Category ID</label>
                        <input
                            type="text"
                            onkeypress="return /[0-9]/i.test(event.key)"
                            maxlength="10"
                            class="rounded block p-1 mt-2 w-full border-2 border-caramel focus:border-coffee-brown focus:ring-coffee-brown"
                            name="category_id" id="category_id" />
                        @error('category_id')
                            <span class="text-red mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex gap-1 mt-4">
                        <button type="submit"
                            class="block bg-caramel hover:bg-espresso flex-1 py-2 rounded-sm text-white">
                            Add
                        </button>
                        <a href="{{ route('products.index') }}"
                            class="block bg-red hover:bg-crimson text-center flex-1 py-2 rounded-sm text-white">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endif
