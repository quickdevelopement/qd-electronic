<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Auth::user()->cart ?? null;
        return view('frontend.cart.index', [
            'cart' => $cart,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add( Request $request, string $productId){
        $cart = Auth::user()->cart ?? Cart::create(['user_id' =>Auth::id()]);
        $cartItem = $cart->items()->where('product_id', $productId)->first();
        $product = Product::findOrFail($productId);

        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
           
        } else {
            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => $request->input('quantity', 1),
                'price' => $product->price,
            ]);

        }

        // update invetory
        if($product && $product->inventory){
            $product->inventory->decrement('stock_quantity', $request->input('quantity', 1));
            $product->inventory->save();
        }

        flash()->success('Product added to cart successfully.');
        return back();

    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function remove(string $itemId)
    {
         $cart = Auth::user()->cart ?? null;
         $cartItem = $cart->items()->findOrFail($itemId);

         if($cart){
            $cart->items()->where('id', $itemId)->delete();

         }

         // update invetory
         if($cartItem && $cartItem->product && $cartItem->product->inventory){
            $cartItem->product->inventory->increment('stock_quantity', $cartItem->quantity);
            $cartItem->product->inventory->save();
         }

         flash()->success('Product removed from cart successfully.');
         return back();
    }
}
