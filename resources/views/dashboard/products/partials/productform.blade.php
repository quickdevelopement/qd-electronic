{{-- Post Create and Edit Form --}}
<h1 class="text-2xl font-bold mb-4 dark:text-white text-black">{{ isset($product) ? 'Edit Product' : 'Add Product' }}
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

<form
    action="{{ isset($product) ? route('dashboard.products.update', $product->id) : route('dashboard.products.store') }}"
    method="POST" class="space-y-4" enctype="multipart/form-data">
    @csrf
    @if (isset($product))
    @method('PATCH')
    @endif
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div class="mb-4">
            <x-input-label class="block py-4">Title</x-input-label>
            <x-text-input type="text" name="title" class="w-full border p-2 rounded" required
                value="{{ old('title', $product->title ?? '') }}" />
        </div>
        <div class="mb-4 grid-cols-2 grid gap-4">
            <div class="mb-4">
                <x-input-label class="block py-4">Stock Keeping Unit (SKU)</x-input-label>
                <x-text-input type="text" name="sku" class="w-full border p-2 rounded" required
                    value="{{ old('sku', $product->sku ?? '') }}" />
            </div>
            <div class="mb-4">
                <x-input-label class="block py-4">Price</x-input-label>
                <x-text-input type="number" name="price" step="0.01" class="w-full border p-2 rounded" required
                    value="{{ old('price', $product->price ?? '') }}" />
            </div>
        </div>
    </div>

    @if (isset($product))
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="mb-4">
            <x-input-label class="block py-4">Status</x-input-label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="draft" {{ (old('status', $product->status) ?? '') === 'draft' ? 'selected' : '' }}>Draft
                </option>
                <option value="published"
                    {{ (old('status', $product->status) ?? '') === 'published' ? 'selected' : '' }}>
                    Published</option>
            </select>
        </div>
        <div class="mb-4">
            <x-input-label class="block py-4">Discount Price</x-input-label>
            <x-text-input type="number" name="discount" class="w-full border p-2 rounded" min="0" max="100"
                value="{{ old('discount', $product->discount ?? '') }}" />
        </div>
    </div>
    @endif

    <div class="mb-4">
        <x-input-label class="block py-4">Product Image</x-input-label>
        <x-upload-image />
    </div>
    <div class="mb-4">
        <x-input-label class="block py-4">Description</x-input-label>
        <x-textarea name="description" class="w-full h-32 border p-2 rounded">
            {{ old('description', $product->description ?? '') }}</x-textarea>
    </div>
    <x-primary-button class="bg-blue-600 text-white px-4 py-2 rounded">{{ isset($product) ? 'Update' : 'Save' }}
    </x-primary-button>
</form>