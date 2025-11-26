<x-app-layout>
    <x-slot:title>
        {{ __('Order Payment Successful') }}
    </x-slot:title>
<div class="max-w-2xl mx-auto p-6 text-center">
    <h2 class="text-2xl font-bold text-green-600">Payment Successful 🎉</h2>
    <p class="mt-3">Order #{{ $order->order_number }} has been paid successfully!</p>
    <a href={{ route('orders.show', $order->id) }} class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">View Orders</a>
</div>
</x-app-layout>