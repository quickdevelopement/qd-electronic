<x-dashboard-layout>
    <x-slot:title>
        {{ __('Dashboard') }}
    </x-slot:title>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div class="flex items-center justify-center h-24 rounded-sm bg-gray-50 dark:bg-gray-800">
                    <div>
                        <h3 class="text-2xl text-slate-800 dark:text-slate-100">Products
                            <span class="font-bold">{{ $products->count() }}</span>
                        </h3>
                    </div>
                </div>
                <div class="flex items-center justify-center h-24 rounded-sm bg-gray-50 dark:bg-gray-800">
                    <div>
                        <h3 class="text-2xl text-slate-800 dark:text-slate-100">Customers
                            <span class="font-bold">{{ $customers->count() }}</span>
                        </h3>
                    </div>
                </div>
                <div class="flex items-center justify-center h-24 rounded-sm bg-gray-50 dark:bg-gray-800">
                    <div>
                        <h3 class="text-2xl text-slate-800 dark:text-slate-100">Orders
                            <span class="font-bold">{{ $orders->count() }}</span>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4 mb-4 rounded-sm bg-gray-50 dark:bg-gray-800">
            <div class="col-span-2">
                @include('dashboard.charts.line-chart')
            </div>
            <div class="">
                @include('dashboard.charts.pie-chart')
            </div>

        </div>
         <div class="grid grid-cols-1 gap-4 mb-4">
                <div class="flex items-center justify-center rounded-sm bg-gray-50  dark:bg-gray-800">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-xs w-full text-gray-50 uppercase  bg-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="bg-gray-900 border-b dark:bg-gray-900 dark:border-gray-700">
                                <th class="px-6 py-4">Order Number</th>
                                <td class="px-6 py-4">Product</td>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Payment Status</th>
                                <th class="px-6 py-4">Total</th>
                                <th class="px-6 py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a href="{{ route('orders.view', $order->id) }}"
                                            class="text-blue-600 hover:underline">{{ $order->order_number }}</a>
                                    </th>
                                    <td class=" py-4">
                                        @foreach ($order->items as $item)
                                            <span>{{ $item->product->title }}</span><br>
                                        @endforeach
                                    </td>

                                    <td class="px-6 py-4">

                                        @if ($order->status == 'pending')
                                            <span
                                                class="px-2 py-2 text-xs font-medium text-orange-100 bg-orange-500 rounded-md">
                                                Pending</span>
                                        @elseif($order->status == 'canceled')
                                            <span
                                                class="px-2 py-2 text-xs font-medium text-red-100 bg-red-500 rounded-md">
                                                Cancelled</span>
                                        @elseif($order->status == 'delivered')
                                            <span
                                                class="px-2 py-2 text-xs font-medium text-green-100 bg-green-500 rounded-md">
                                                Delivered</span>
                                        @elseif($order->status == 'shipped')
                                            <span
                                                class="px-2 py-2 text-xs font-medium text-blue-100 bg-blue-500 rounded-md">
                                                Shipped</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($order->payment_status == 'paid')
                                            <span
                                                class="px-2 py-2 text-xs font-medium text-green-100 bg-green-500 rounded-md">
                                                Paid</span>
                                        @else
                                            <span
                                                class="px-2 py-2 text-xs font-medium text-red-100 bg-red-500 rounded-md">
                                                Unpaid</span>
                                        @endif
                                    </td>

                                    <td>{{ $order->total }}</td>
                                    <td class="px-6 py-4 flex items-center justify-start gap-2">
                                        @if ($order->status == 'canceled' or $order->status == 'delivered')
                                            <button class="text-white bg-gray-500 p-2 rounded-md"
                                                disabled>Cancelled</button>
                                        @else
                                            <form action="{{ route('orders.cancel', $order->id) }}" method='post'>
                                                @csrf
                                                @method('PATCH')
                                                <x-primary-button>Cancel</x-primary-button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="w-full">
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <td colspan="6" class="px-6 py-4">
                                    {{ $orders->links() }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4 rounded-sm  dark:bg-gray-800 ">
                    <div class="col-span-2 bg-slate-200 p-4 rounded-md">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs w-full text-gray-50 uppercase  bg-gray-700 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="bg-gray-900 border-b dark:bg-gray-900 dark:border-gray-700">
                                    <td class="px-6 py-4">Product</td>
                                    <th class="px-6 py-4">Stock Quantiry</th>
                                    <th class="px-6 py-4">SKU</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">


                                        <td class="px-6 py-4">
                                            {{ $product->title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $product->inventory->stock_quantity }}
                                        </td>

                                        <td class="px-6 py-4 flex items-center justify-start gap-2">
                                            {{ $product->sku }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="bg-slate-200 p-4 rounded-md">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs w-full text-gray-50 uppercase  bg-gray-700 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="bg-gray-900 border-b dark:bg-gray-900 dark:border-gray-700">
                                    <td class="px-6 py-4">Image</td>
                                    <th class="px-6 py-4">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $user)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">


                                        <td class="px-6 py-4">
                                            @if ($user->avatar)
                                                <img src="{{ asset('avatar/' . $user->avatar) }}"
                                                    alt="{{ $user->name }}" class="w-12 rounded-full">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=random"
                                                    alt="Default Avatar" class="w-12 rounded-full ">
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-2xl">
                                            {{ $user->name }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
                <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                    </p>
                </div>
            </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                </p>
            </div>
            <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                </p>
            </div>
            <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                </p>
            </div>
            <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                </p>
            </div>
        </div>
        <div class="flex items-center justify-center h-48 mb-4 rounded-sm bg-gray-50 dark:bg-gray-800">
            <p class="text-2xl text-gray-400 dark:text-gray-500">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
            </p>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                </p>
            </div>
            <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                </p>
            </div>
            <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                </p>
            </div>
            <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                </p>
            </div>
        </div>
    </div>
    </div>
</x-dashboard-layout>
