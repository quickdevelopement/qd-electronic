<x-app-layout>
    <x-slot:title>
        {{ __('Home') }}
        </x-slot:title>


@include('frontend.banner')

<div class="py-5">
    <div class="container mx-auto mt-10 max-w-7xl">
    <h2 class="text-2xl text-center font-bold dark:text-white">Latest Products</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6 mt-5">
            @foreach ($products as $product)
            <div class=" relative w-full bg-gradient-to-t p-4 rounded-md from-green-500 via-green-200 to-indigo-500">
                <span class="w-20 shadow-lg shadow-black absolute top-2 left-2 font-bold uppercase h-20 flex text-3xl rounded-full items-center justify-center bg-green-200 text-orange-500">New</span>
                <a href="{{ route('product.show', $product->id) }}">
                    <img src="{{ asset('images/products/'.$product->image) }}" alt="{{ $product->title }}"
                        class="w-full object-cover rounded-lg mb-4">
                    <h2 class="text-lg font-bold text-blue-800 dark:text-white">{{ $product->title }}</h2>
                    <p class="text-whte text-right font-bold dark:text-gray-300 text-3xl "><span class="text-2xl ">৳</span>{{ number_format($product->price, 2) }}</p>
                </a>
            </div>
        @endforeach
    </div>
</div>
</div>


</x-app-layout>