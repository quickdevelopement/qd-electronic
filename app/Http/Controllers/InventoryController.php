<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::with('product')->paginate(10);
        return view('dashboard.inventories.index', [
            'inventories' => $inventories]);
            
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('dashboard.inventories.create', [
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'stock_quantity' => 'required|integer|min:0',
            'reserved_quantity' => 'nullable|integer|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
        ]);

        $product = Product::find($request->product_id);
        $sku = $product->sku;

        $request->merge(['sku'=> $sku]);

        Inventory::create($request->all());

        flash()->success('Inventory created successfully.');
        return redirect()->route('dashboard.inventories');

    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::all();
        $inventory = Inventory::findOrFail($id);
        return view('dashboard.inventories.edit', [
            'inventory' => $inventory,
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    
    {
        $inventory = Inventory::findOrFail($id);

        $request->validate([
            'stock_quantity' => 'required|integer|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'reserved_quantity' => 'nullable|integer|min:0',
        ]);

        $inventory ->update($request->all());
        flash()->success('Inverntory updated successfully.');
        return redirect()->route('dashboard.inventories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        flash()->success('Inventory deleted successfully!');
        return redirect()->route('dashboard.inventories');
    }
}
