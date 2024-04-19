@if (count($trashes) === 0 ?? false)
    <h1 class="text-center mt-4 text-espresso">Nothing trashed yet</h1>
@else
    @foreach ($trashes as $trash)
        <div class="grid grid-cols-4 gap-4 pt-4 border-b-2 px-3">
            <p class="font-bold">{{ $trashes->firstItem() + $loop->index }}</p>
            <p>{{ $trash->product_name }}</p>
            @if ($trash->deleted_at == null)
                <span class="text-red-600">Date not set</span>
            @else
                <p>{{ Carbon\Carbon::parse($trash->deleted_at)->diffForHumans() }}</p>
            @endif
            <p class="text-white">
                <a href="{{ route('products.restore', $trash->product_id) }}"
                    class="bg-caramel hover:bg-coffee-brown px-2 py-1 rounded-sm mb-1">Restore</a>
                <a href="{{ route('products.forceDelete', $trash->product_id) }}"
                    class="bg-red hover:bg-crimson px-2 py-1 rounded-sm mb-1">Delete</a>
            </p>
        </div>
    @endforeach
    <div class="container mx-auto mt-2 px-[2rem] pt-4 pb-2">
        {{ $trashes->links() }}
    </div>
@endif
