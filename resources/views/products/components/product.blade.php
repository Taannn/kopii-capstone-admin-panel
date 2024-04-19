@php
    function calculateDiscountedPrice($originalPrice, $discountPercentage)
    {
        $discountAmount = ($originalPrice * $discountPercentage) / 100;
        $discountedPrice = $originalPrice - $discountAmount;
        $discountedPrice = round($discountedPrice, 2);
        return $discountedPrice;
    }
@endphp
@if (count($products) === 0 ?? false)
    <h1 class="text-center text-espresso my-4">No products addded</h1>
@else
    @foreach ($products as $product)
        <div class="grid grid-cols-10 gap-4 pt-4 border-b-2 px-3 relative">
            <form action="{{ route('discount.remove', $product->product_id) }}" method="post" style="visibility: hidden;"
                class="absolute">
                @csrf
                @method('PUT')
                <button type="submit" id="discountRemove" style="visibility: hidden;"></button>
            </form>
            <p class="font-bold">{{ $products->firstItem() + $loop->index }}</p>
            <p class="font-bold">{{ $product->product_name }}</p>
            <img src="{{ $product->product_img }}" class="w-[2.7rem] h-[2.2rem] rounded-sm" alt="">
            @if ($product->discount == null)
                <p>₱ {{ number_format($product->product_price, 2) }}</p>
            @else
                <div>
                    <span
                        class="line-through me-1 text-sm text-crimson">{{ number_format($product->product_price, 2) }}</span>
                    <span class="font-bold">₱
                        {{ number_format(calculateDiscountedPrice($product->product_price, $product->discount), 2) }}</span>
                </div>
            @endif

            @if ($product->discount == null)
                <span class="text-red-600">No Discount</span>
            @else
                <p class="font-bold">{{ $product->discount }} %</p>
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
            <div class="text-white col-span-2">
                @if ($product->discount == null)
                    <a href="{{ route('discount.edit', $product->product_id) }}"
                        class="bg-latte hover:bg-latte-700 px-2 me-1 py-1 rounded-sm mb-1">Add
                        Discount
                    </a>
                @else
                    <a onclick="document.getElementById('discountRemove').click()"
                        class="bg-latte hover:bg-latte-700 px-2 me-1 py-1 rounded-sm mb-1 cursor-pointer">Reset
                    </a>
                @endif
                <a href="{{ route('products.edit', $product->product_id) }}"
                    class="bg-caramel edit-button hover:bg-coffee-brown px-2 me-1 py-1 rounded-sm mb-1">Edit
                </a>
                <a href="{{ route('products.softDelete', $product->product_id) }}"
                    class="bg-red hover:bg-crimson px-2 py-1 rounded-sm mb-1">Trash
                </a>
            </div>
        </div>
    @endforeach
    <div class="container mx-auto mt-2 px-[2rem] pt-4 pb-2">
        {{ $products->links() }}
    </div>
@endif
