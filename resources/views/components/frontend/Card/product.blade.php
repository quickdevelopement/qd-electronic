@props(['product'])

<div class="w-full bg-gradient-to-t p-4 rounded-md from-green-500 via-green-200 to-orange-500 shadow-md">
    <a href="{{ route('product.show', $product->id) }}">
        <img src="{{ asset('images/products/'.$product->image) }}" alt="{{ $product->title }}"
            class="w-full object-cover rounded-lg mb-4">
        <h2 class="text-lg font-semibold text-black dark:text-white">{{ $product->title }}</h2>
        <div class="flex justify-between items-center">
            <p class="text-white font-bold text-3xl dark:text-gray-300 mt-2"><span
                    class="text-4xl">৳</span>{{ number_format($product->price, 2) }}</p>
            <!-- in stock without reserved -->
            @php
            $availableStock = $product->inventory->stock_quantity - $product->inventory->reserved_quantity;
            @endphp
            @if($availableStock > 0)
            <p class="bg-green-800 py-1 px-2 rounded-md text-white dark:text-green-400 mt-1">In Stock:
                {{ $availableStock }}</p>
            @else
            <p class="bg-red-600 py-1 px-2 rounded-md text-white dark:text-red-400 mt-1">Out of Stock</p>
            @endif
        </div>
    </a>
</div>