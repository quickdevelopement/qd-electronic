<x-app-layout>
    <x-slot:title>
        {{ __('Cart Info') }}
    </x-slot:title>
    @if($cart !== null)
        
    <div class="max-w-4xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Your Cart</h2>
        
        @forelse($cart->items as $item)
            <div class="flex justify-between items-center border-b py-2">
                <div>
                    <img src="{{ asset('images/products/'.$item->product->image) }}" alt="{{ $item->product->title }}" class="w-16 h-16 object-cover rounded">
                </div>
                <div>
                    <p class="font-semibold">{{ $item->product->title }}</p>
                    <p class="text-gray-500">৳ {{ $item->price }} × {{ $item->quantity }}</p>
                </div>
                <form method="POST" action="{{ route('cart.remove', $item) }}">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Remove</button>
                </form>
            </div>
        @empty
            <p class="text-4xl font-bold text-red-600">No items in cart</p>
        @endforelse
        <hr class="my-4 border-2 border-green-600">
        <div class="mt-4 flex justify-between">
            <span class="font-bold">Total:</span>
            <span>৳ {{ $cart->total() }}</span>
        </div>

       @if($cart->items->isNotEmpty())
        <div class="mt-6">
            <a href="{{ route('checkout.page') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Proceed to Checkout</a>
        </div>
        @else
         <div class="mt-6">
            <a href="{{ route('products') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Continue Shopping</a>
         </div>
        @endif
    </div>
    @else
        <div class="max-w-4xl mx-auto p-6">
            <h2 class="text-4xl font-bold mb-4">Your cart is empty.</h2>
            <x-nav-link href="{{ route('products')}}" class="bg-green-700 text-white px-4 py-2 rounded hover:text-white hover:bg-blue-700">Continue Shopping</x-nav-link>
        </div>
    @endif
</x-app-layout>
