<div class="col-span-2 px-4 py-2 border-4 border-coffee-brown rounded-sm">
    <p>Total Users</p>
    <p class="mt-2"><i class="fa-solid fa-user-group me-2"></i> {{ $totalCount }}</p>
</div>
<div class="col-span-2 px-4 py-2 border-4 border-coffee-brown rounded-sm text-green">
    <p>Completed Orders</p>
    <p class="mt-2"><i class="fa-regular fa-circle-check me-2"></i>{{ $completedOrders }}</p>
</div>
<div class="col-span-2 px-4 py-2 border-4 border-coffee-brown rounded-sm text-crimson">
    <p>Cancelled Orders</p>
    <p class="mt-2"><i class="fa-regular fa-circle-xmark me-2"></i>{{ $cancelledOrders }}</p>
</div>
<div class="col-span-2 px-4 py-2 border-4 border-coffee-brown rounded-sm">
    <p>Total Sales</p>
    <p class="mt-2"><i class="fa-solid fa-money-bill-trend-up me-2"></i>₱ {{ $totalSales }}</p>
</div>
