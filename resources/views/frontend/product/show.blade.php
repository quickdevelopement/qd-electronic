<x-app-layout>
    <x-slot:title>
        {{ __("Product Details") }}
    </x-slot:title>
    <div class="py-5">
        <div class="container mx-auto max-w-7xl">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <img src="{{ asset('images/products/'.$product->image) }}" alt="{{ $product->title }}"
                            class="w-full object-cover rounded-lg mb-4">
                    </div>
                    <div>
                        
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">{{ $product->title }}</h2>
                        @if($product->discount > 0)
                           <div class="flex items-baseline space-x-4">
                             <p class="text-gray-600 dark:text-gray-300 mb-4 line-through"><span class="text-2xl">৳</span>{{ number_format($product->price, 2) }}</p>
                            <p class="text-gray-800 dark:text-white mb-4"><span class="text-2xl">৳</span>{{ number_format($product->price - ($product->price * $product->discount / 100), 2) }}</p>
                            <div class="bg-red-600 text-white text-xs font-semibold px-2 py-1 rounded">-{{ $product->discount }}%</div>
                           </div>
                        @else
                            <p class="text-gray-600 dark:text-gray-300 mb-4"><span class="text-2xl">৳</span>{{ number_format($product->price, 2) }}</p>
                        @endif

                        @php
                            $availableStock = $product->inventory->stock_quantity - $product->inventory->reserved_quantity;
                         @endphp
                         @if($availableStock > 0)
                             <p class="bg-green-600 py-1 px-2 rounded-md text-white dark:text-green-400 mb-4 inline-block">In Stock: {{ $availableStock }}</p>
                         @else
                             <p class="bg-red-600 py-1 px-2 rounded-md text-white dark:text-red-400 mb-4 inline-block">Out of Stock</p>
                         @endif
                         <p class="text-gray-700 dark:text-gray-300 mb-4 font-bold">SKU: {{ $product->sku }}</p>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $product->description }}</p>
                       <form action="{{ route('cart.add', $product->id) }}" method="POST">
                           @csrf
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add to Cart</button>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>