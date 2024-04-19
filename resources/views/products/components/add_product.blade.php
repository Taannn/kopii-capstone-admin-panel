@if (!$adding && !$editing && !$addingDiscount && !$updatingStock ?? false)
    <form action="{{ route('products.add') }}" method="get">
        @csrf
        <button class="block bg-caramel py-3 hover:bg-espresso mt-4 w-full text-[1.6rem] rounded-sm text-white">Add
        </button>
    </form>
@endif
