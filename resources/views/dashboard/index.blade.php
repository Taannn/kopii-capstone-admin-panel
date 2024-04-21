<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-[2.1rem] text-cream leading-wider">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto px-[2rem] grid grid-cols-8 gap-2 text-caramel text-[1.3rem] text-center">
            @include('dashboard.components.statistics')
            <div class="border-4 border-coffee-brown text-black col-span-6 text-base text-left h-[60vh]">
                <div class="border-4 grid grid-cols-8 px-2">
                    <p class="font-bold">No.</p>
                    <p class="font-bold">Order ID</p>
                    <p class="font-bold">Status</p>
                    <p class="font-bold">Total Amount</p>
                    <p class="font-bold">Order Date</p>
                    <p class="font-bold">Updated At</p>
                    <p class="font-bold col-span-2">Actions</p>
                </div>
                @if (count($orders) === 0 ?? false)
                    <h1 class="text-center text-espresso my-4">No Orders to process</h1>
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
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    @endif
                @else
                    @foreach ($orders as $order)
                        <form action="{{ route('dashboard.shipout', $order->order_id) }}" method="post"
                            style="visibility: hidden;" class="absolute">
                            @csrf
                            @method('PUT')
                            <button type="submit" id="shipOut{{ $order->order_id }}"
                                style="visibility: hidden;"></button>
                        </form>
                        <div class="grid grid-cols-8 gap-4 pt-4 border-b-2 text-left px-2 text-[1rem]">
                            <p class="font-bold">{{ $orders->firstItem() + $loop->index }}</p>
                            <p class="font-bold">KOPII100{{ $order->order_id }}</p>
                            <p>{{ $order->status }}</p>
                            <p>₱ {{ $order->price }}</p>
                            @if ($order->created_at == null)
                                <span class="text-red-600">Date not set</span>
                            @else
                                <p>{{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</p>
                            @endif
                            @if ($order->updated_at == null)
                                <span class="text-red-600">Date not set</span>
                            @else
                                <p>{{ Carbon\Carbon::parse($order->updated_at)->diffForHumans() }}</p>
                            @endif
                            <p class="text-white col-span-2">
                                <a href="{{ route('dashboard.show', $order->order_id) }}"
                                    class="bg-caramel edit-button hover:bg-coffee-brown px-2 py-1 rounded-sm mb-1">View
                                    Details</a>
                                @if ($order->status === 'To Ship' ?? false)
                                    <a onclick="document.getElementById('shipOut{{ $order->order_id }}').click()"
                                        class="bg-coffee-brown hover:bg-espresso px-2 py-1 rounded-sm mb-1">Ship Out</a>
                                @endif

                            </p>
                        </div>
                    @endforeach
                    <div class="container mx-auto mt-2 px-[2rem] pt-4 pb-2">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
            <div class="col-span-2 border-4 border-coffee-brown h-[60vh] text-left text-espresso">
                <div class="text-black border-4 text-center px-2">
                    <p class="font-bold">Order Details</p>
                </div>
                @if ($orderDetail && $addressDetail)
                    <div class="grid grid-cols-3 gap-2 px-2 py-1 text-[1.1rem]">
                        <p class="me-2">Product Name: </p>
                        <p class="font-bold col-span-2">{{ $orderDetail->product->product_name }}</p>
                    </div>
                    <div class="grid grid-cols-3 gap-2 px-2 py-1 text-[1.2rem] justify-between">
                        <p>₱ {{ $orderDetail->product->product_price }}</p>
                        <p class="col-span-2">x {{ $orderDetail->quantity }}</p>
                    </div>
                    <div class="grid grid-cols-4 gap-2 px-2 py-1 text-left border-t-4">
                        <p class="col-span-2">Order ID: </p>
                        <p class="col-span-2">KOPII{{ $orderDetail->order_id }}</p>
                        <p class="col-span-2">Order Date</p>
                        <p class="col-span-2">{{ $orderDetail->created_at }}</p>
                    </div>
                    <div class="grid grid-cols-3 gap-2 px-2 py-1 border-t-4 text-[1.1rem]">
                        <p>Name: </p>
                        <p class="font-bold col-span-2">{{ $orderDetail->customer->first_name }}
                            {{ $orderDetail->customer->last_name }}</p>
                    </div>
                    <div class="grid grid-cols-3 gap-2 px-2 py-1 text-[1.1rem]">
                        <p>Address: </p>
                        <p class="font-bold col-span-2">{{ $addressDetail->address }}, {{ $addressDetail->city }},
                            {{ $addressDetail->zip_code }}</p>
                    </div>
                @else
                    <p class="mt-6 text-center text-coffee-brown">Nothing viewed yet</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
