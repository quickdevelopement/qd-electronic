<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $products = Product::with('inventory')->latest()->paginate(10);
         return view('frontend.product.index', [
            'products' => $products,
         ]);
    }
     /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $product = Product::with('inventory')->findOrFail($id);
         return view('frontend.product.show', [
            'product' => $product,
         ]);
    }

    public function productsdb(){
        $products = Product::with('inventory')->latest()->paginate(10);
        $total = Product::count();
        return view('dashboard.products.index', [
            'products' => $products,
            'total' => $total,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price'=> ['required', 'numeric', 'min:0'],
            'sku'=> ['nullable', 'string', 'max:100'],
        ]);

        $image = null;
        if (isset($request->image)) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $imageName =  time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/products'), $imageName);
            $image = $imageName;

        };

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount = $request->discount ?? 0;
        $product->sku = $request->sku;
        $product->status = $request->status ?? 'draft';
        $product->image = $image;
        $product->save();
            
        // inventory::create
        Inventory::create([
            'product_id' => $product->id,
            'stock_quantity' => $request->stock_quantity ?? 0,
            'low_stock_threshold' => $request->low_stock_threshold ?? 5,
            'reserved_quantity' => 0,
            'sku' => $product->sku,
        ]);
        
        flash()->success('Product created successfully.');
        return redirect()->route('dashboard.products');
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.products.edit', [
            'product' => $product,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price'=> ['required', 'numeric', 'min:0'],
            'discount'=> ['nullable', 'numeric', 'min:0'],
            'sku'=> ['nullable', 'string', 'max:100'],
            'status'=> 'required|in:draft,published'
        ]);

        $image = $product->image;
        if (isset($request->image)) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if($product->image && file_exists(public_path('images/products/' . $product->image))){
                unlink(public_path('images/products/' . $product->image));
            }

            $imageName =  time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/products'), $imageName);
            $image = $imageName;

        };

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount = $request->discount ?? 0;
        $product->sku = $request->sku;
        $product->status = $request->status ?? 'draft';
        $product->image = $image;
        $product->save();
            
    

        flash()->success('Product Updated Successfully.');
        return redirect()->route('dashboard.products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if($product->image && file_exists(public_path('images/products/' . $product->image))){
            unlink(public_path('images/products/'.$product->image));
        }
        $product->delete();
        flash()->success('Product Deleted Successfully.');
    
        return redirect()->route('dashboard.products');
        
    }
}
