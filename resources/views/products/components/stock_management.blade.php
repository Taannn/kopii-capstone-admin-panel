@if ($updatingStock ?? false)
    <div class="grid grid-cols-10 gap-4 mt-4">
        <div class="col-span-6 border-2 rounded-sm border-caramel px-3 py-2">
            <h1 class="font-bold me-1 text-[1.4rem]">{{ $stock->product_name }}</h1>
            <p class="font-bold me-1 text-[1.2rem]">
              Stocks: {{ $stock->product_stock }}
              @if (session('decrementError'))
                <span class="ms-2 text-crimson text-sm">{{ session('decrementError') }}</span>
              @endif
              @if (session('incrementError'))
                <span class="ms-2 text-crimson text-sm">{{ session('incrementError') }}</span>
              @endif
            </p>
        </div>
        <div class="col-span-2 border-2 rounded-sm border-caramel flex gap-2 flex-col text-cream p-1">
            <form action="{{ route('stock.increment', $stock->product_id) }}" method="POST"
                style="visibility: hidden; position: absolute">
                @csrf
                @method('put')
                <button id="increment" type="submit"></button>
            </form>
            <form action="{{ route('stock.decrement', $stock->product_id) }}" method="POST"
                style="visibility: hidden; position: absolute">
                @csrf
                @method('put')
                <button id="decrement" type="submit"></button>
            </form>
            <a onclick="document.getElementById('increment').click()"
                class="bg-caramel cursor-pointer text-center hover:bg-coffee-brown rounded-sm flex-1 text-[1.4rem]">+</a>
            <a onclick="document.getElementById('decrement').click()"
                class="bg-red cursor-pointer text-center hover:bg-crimson rounded-sm flex-1 text-[1.4rem]">-</a>
        </div>
        <div
            class="col-span-2 border-2 border-caramel rounded-sm text-cream p-1 flex align-items-center justify-content-center ">
            <a href="{{ route('products.index') }}"
                class="bg-red text-center hover:bg-crimson text-cream rounded-sm pt-6 w-full">Cancel</a>
        </div>
        <div class="col-span-5">
            <form action="{{ route('stock.increment.amount', $stock->product_id) }}" method="post">
                @csrf
                @method('put')
                <label for="product_price">Increase Stocks By:</label>
                <input type="text" name="incrementAmount" id="incrementAmount"
                    onkeypress="return /[0-9]/i.test(event.key)" maxlength="6"
                    class="rounded block p-1 mt-2 w-full border-2 border-caramel focus:border-coffee-brown focus:ring-coffee-brown" />
                @error('incrementAmount')
                    <span class="text-red mt-1">{{ $message }}</span>
                @enderror
                @if (session('incrementAmountError'))
                    <span class="text-red mt-1">{{ session('incrementAmountError') }}</span>
                @endif
                <button type="submit"
                    class="bg-caramel text-center text-cream mt-2 w-full hover:bg-coffee-brown rounded-sm flex-1 text-[1.4rem]">+</button>
            </form>
        </div>
        <div class="col-span-5">
            <form action="{{ route('stock.decrement.amount', $stock->product_id) }}" method="post">
                @csrf
                @method('put')
                <label for="product_price">Decrease Stocks By:</label>
                <input type="text" name="decrementAmount" id="decrementAmount"
                    onkeypress="return /[0-9]/i.test(event.key)" maxlength="6"
                    class="rounded block p-1 mt-2 w-full border-2 border-caramel focus:border-coffee-brown focus:ring-coffee-brown" />
                @error('decrementAmount')
                    <span class="text-red mt-1">{{ $message }}</span>
                @enderror
                @if (session('decrementAmountError'))
                    <span class="text-red mt-1">{{ session('decrementAmountError') }}</span>
                @endif
                <button type="submit"
                    class="bg-red text-center hover:bg-crimson text-cream mt-2 w-full rounded-sm flex-1 text-[1.4rem]">-</button>
            </form>

        </div>
    </div>
@endif
