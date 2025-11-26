<x-dashboard-layout>
    <x-slot:title>
        {{ ("Your Orderds") }}
        </x-slot>

        <div class="p-4 sm:ml-64">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                <div class="mx-auto p-6 bg-white">
                    <h2 class="text-2xl font-bold">Order #{{ $order->order_number }}</h2>
                    <p> Delivery Status: <span
                            class="font-semibold ml-3 px-4 py-1 rounded-md  text-white {{$order->status === 'delivered' ? 'bg-green-500' : 'bg-red-500'}}">{{ ucfirst($order->status) }}</span>
                    </p>



                    <h3 class="mt-4 font-bold text-2xl">Items: </h3>
                    <ol>
                        @foreach($order->items as $item)
                        <li class="mt-2 list-inside flex">
                            <svg class="w-6 h-6 me-2 text-green-500 dark:text-green-400 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>
                            <div>
                                <h3 class="font-semibold text-green-600 text-xl">{{ $item->product->title }}</h3>
                                <p class="font-bold">SKU: {{ $item->product->sku }}</p>
                                <p>Quantity: {{ $item->quantity }}</p>
                                <p>Price: ৳ {{ $item->unit_price }}</p>

                        </li>

                        @endforeach
                    </ol>
                    <hr>
                    <div class="mt-4">
                        <p><strong>Subtotal:</strong> ৳ {{ $order->subtotal }}</p>
                        <p><strong>Shipping:</strong> ৳ {{ $order->shipping_cost }}</p>
                        <p><strong>Total:</strong> ৳ {{ $order->total }}</p>
                        <p> Payment Status: <span
                                class="font-semibold ml-3 px-4 py-1 rounded-md  text-white {{$order->payment_status === 'paid' ? 'bg-green-500' : 'bg-red-500'}}">{{ ucfirst($order->payment_status) }}</span>
                        </p>
                    </div>
                </div>
                <form method="GET" action="{{ route('orders.invoice', $order->id) }}" class="mt-4">
                    <x-primary-button>Invoice</x-primary-button>
                </form>
            </div>
        </div>
        </div>
</x-dashboard-layout>