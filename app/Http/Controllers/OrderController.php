<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'order.index';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function checkoutForm()
    {
        $cart = Auth::user()->cart ?? null;
        $user= Auth::user();
        return view('frontend.checkout.index', ['cart' => $cart, 'user' => $user]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function placeOrder(Request $request)
    {
        $cart = Auth::user()->cart;
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . time(),
            'subtotal' => $cart->total(), 
            'shipping_cost' => 50,
            'total' => $cart->total() + 50,
            'status' => 'pending',
            
        ]);

        foreach($cart->items as $item){
            $order->items()->create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'unit_price' => $item->price,
                'total_price' => $item->price
            ]);
        }

        $order->addresses()->create([
            'order_id'=> $order->id,
           'user_id'=>  Auth::id(),
           'name'=> $request->name,
           'phone'=> $request->phone,
           'address'=> $request->address,
           'district'=> $request->district,
           'postal_code'=> $request->postal_code
           
        ]);

        $cart->items()->delete();

        flash()->success('Order placed successfully.');
        return view('frontend.order.show', [
            'order' => $order,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('frontend.order.show', [
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
