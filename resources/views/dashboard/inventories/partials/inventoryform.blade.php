{{-- Post Create and Edit Form --}}
<h1 class="text-2xl font-bold mb-4 dark:text-white text-black">{{ isset($inventory) ? 'Edit Inventory' : 'Add Inventory' }}
</h1>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ isset($inventory) ? route('dashboard.inventories.update', $inventory->id) : route('dashboard.inventories.store') }}"
    method="POST" class="space-y-4" enctype="multipart/form-data">
    @csrf
    @if (isset($inventory))
    @method('PATCH')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="mb-4">
            <x-input-label class="block py-4">Product</x-input-label>
            <select name="product_id" class="w-full border p-2 rounded" required>
                <option value="">Select a product</option>
                @foreach ($products as $product)
                    <option class="text-gray-700 dark:text-gray-300" value="{{ $product->id }}" {{ (old('product_id', $inventory->product_id ?? '') == $product->id) ? 'selected' : '' }}>
                        {{ $product->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <x-input-label class="block py-4">Reserved Quantity</x-input-label>
            <x-text-input type="text" name="reserved_quantity" class="w-full border p-2 rounded" required
                value="{{ old('reserved_quantity', $inventory->reserved_quantity ?? '0') }}" />
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div class="mb-4">
            <x-input-label class="block py-4">Stock Quantity</x-input-label>
            <x-text-input type="text" name="stock_quantity" class="w-full border p-2 rounded" required
                value="{{ old('stock_quantity', $inventory->stock_quantity ?? '') }}" />
        </div>
        <div class="mb-4">
            <x-input-label class="block py-4">Low Stock Threshold</x-input-label>
            <x-text-input type="number" name="low_stock_threshold" class="w-full border p-2 rounded" required
                value="{{ old('low_stock_threshold', $inventory->low_stock_threshold ?? '5') }}" />
        </div>

    </div>
   
    <x-primary-button class="bg-blue-600 text-white px-4 py-2 rounded">{{ isset($inventory) ? 'Update' : 'Save' }}
    </x-primary-button>
</form>