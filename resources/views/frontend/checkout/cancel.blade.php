<x-app-layout>
    <x-slot:title>
        {{ __('Order Cancelled') }}
    </x-slot:title>
    <div class="max-w-2xl mx-auto p-6 text-center">
        <h2 class="text-2xl font-bold text-red-600">Payment Cancelled ❌</h2>
        <p class="mt-3">Your payment was not completed.</p>
        <a href="{{ route('carts') }}" class="mt-4 inline-block bg-gray-700 text-white px-4 py-2 rounded">Back to
            Cart</a>
    </div>
</x-app-layout>