<x-app-layout>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Products') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <h1>Products</h1>
        @foreach ($products as $product)
        <div>
          <span>{{ $product->product_name }}</span>
          @if ($product->category)
          <span>{{ $product->category->category_name }}</span>
          @else
          <span>No category</span>
          @endif
        </div>
        @endforeach
        {{ $products->links() }}
      </div>
    </div>
  </div>

</x-app-layout>
