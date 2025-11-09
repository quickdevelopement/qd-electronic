<x-app-layout>
    <x-slot:title>
        {{ __('Checkout') }}
    </x-slot:title>
    <div class="max-w-3xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Checkout</h2>
        <form method="POST" action="{{ route('checkout.create') }}" class="space-y-4">
            @csrf
            <div>
                <x-input-label for="name" :value="__('Full Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                    :value="old('name', $user->name)" autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            
            <div>
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full"
                    :value="old('phone', $user->phone)"  />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>
            <div>
                <x-input-label for="address" :value="__('Shipping Address')" />
                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                    :value="old('address', $user->address)"  />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>
            <div>
                <x-input-label for="district" :value="__('District')" />
                <x-text-input id="district" name="district" type="text" class="mt-1 block w-full"
                    :value="old('district', $user->district)"  />
                <x-input-error class="mt-2" :messages="$errors->get('district')" />
            </div>
            <div>
                <x-input-label for="postal_code" :value="__('Postal Code')" />
                <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full"
                    :value="old('postal_code', $user->postal_code)"  />
                <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
            </div>
            <x-primary-button class="bg-green-600 text-white px-4 py-2 rounded">Place Order</x-primary-button>
        </form>
    </div>
</x-app-layout>