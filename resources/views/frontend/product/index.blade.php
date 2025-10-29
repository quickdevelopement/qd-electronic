<x-app-layout>
    <x-slot:title>
        {{ __("Products") }}
    </x-slot:title>
     <div class="py-5">
        <div class="container mx-auto mt-10 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6 mt-5">
                 @foreach ($products as $product)
                    <x-frontend.Card.product :product="$product"></x-frontend.Card.product>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>