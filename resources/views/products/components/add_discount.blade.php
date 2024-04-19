@if ($addingDiscount ?? false)
    <form action="{{ route('discount.update', $discounted->product_id) }}" method="post">
        @csrf
        @method('put')
        <div>
            <input type="text" onkeypress="return /[0-9]/i.test(event.key)" maxlength="3"
                class="rounded block p-1 mt-4 w-full border-2 border-caramel focus:border-coffee-brown focus:ring-coffee-brown"
                name="discount" id="discount" placeholder="e.g. 20" />
            @if (session('exceedingDiscount'))
                <span class="text-red mt-1">{{ session('exceedingDiscount') }}</span>
            @endif
            <div class="flex space-x-1">
                <button type="submit"
                    class="bg-caramel text-cream flex-1 w-full mt-4 hover:bg-coffee-brown rounded-sm py-2">Add
                    Discount
                </button>
                <a href="{{ route('products.index') }}"
                    class="bg-red mt-4 flex-1 hover:bg-crimson text-center text-cream pt-[7px] rounded-sm">Cancel</a>
            </div>
        </div>
        @error('discount')
            <span class="text-red mt-1">{{ $message }}</span>
        @enderror
    </form>
@endif
