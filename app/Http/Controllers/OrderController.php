<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ShippingAddress;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class OrderController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $user = Auth::user();
        $orders = Order::query()->where( 'user_id', $user->id )->get();
        return view( 'dashboard.orders.index', [ 'orders' => $orders ] );
    }

    /**
    * Display a Single Order.
    */

    public function showOrder( Order $order ) {
        return view( 'dashboard.orders.show', [ 'order' => $order ] );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function checkoutForm() {
        $cart = Auth::user()->cart ?? null;
        $user = Auth::user();
        $order = ShippingAddress::all()->where( 'user_id', $user->id )->first() ?? null;

        return view( 'frontend.checkout.index', [ 'cart' => $cart, 'user' => $user, 'order' => $order ] );

    }

     /**
    * Display the specified resource.
    */

    public function show( Order $order ) {
        return view( 'frontend.order.show', [
            'order' => $order,
        ] );
    }

    public function cancelOrder(string $id){

        $order = Order::query()->where('id', $id)->first();
        $order->status = 'cancelled';
        $order->save();

        // update product inventory
        foreach ($order->items() as $item) {
            $product = $item->product;
            $product->stock = $product->stock + $item->quantity;    
            $product->save();
        };

        flash()->success('Order cancelled successfully.');
        return redirect()->route('orders');
    }

    /**
    * Store a newly created resource in storage.
    */

    public function placeOrder( Request $request ) {
        $cart = Auth::user()->cart;
        $user = Auth::user();

        $order = Order::create( [
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . time(),
            'subtotal' => $cart->total(),
            'shipping_cost' => 50,
            'total' => $cart->total() + 50,
            'status' => 'pending',

        ] );

        foreach ( $cart->items as $item ) {

            $order->items()->create( [
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'unit_price' => $item->price,
                'total_price' => $item->price
            ] );
        }

        $order->addresses()->create( [
            'order_id'=> $order->id,
            'user_id'=>  Auth::id(),
            'name'=> $request->name,
            'phone'=> $request->phone,
            'address'=> $request->address,
            'district'=> $request->district,
            'postal_code'=> $request->postal_code

        ] );

        $lineItems = [];
        foreach ( $cart->items as $item ) {

            $price = round($item->price / 120);

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => $item->product->title ],
                    'unit_amount' => $price * 100, // amount in cents
                ],
                'quantity' => $item->quantity,      
                
            ];

            

        }

        

        Stripe::setApiKey( config( 'services.stripe.secret' ) );
        
        $session = StripeSession::create( [
            'payment_method_types' => [ 'card' ],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route( 'checkout.success' ) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route( 'checkout.cancel' ),
            'metadata' => [
                'order_id' => $order->id,
                'user_id' => $user->id,
            ],
        ] );

        
        $cart->items()->delete();

        flash()->success( 'Order placed successfully.' );
        return redirect($session->url);


    }

    public function success( Request $request ){
        $session_id = $request->input('session_id');

        if(!$session_id){
            flash()->error('Invalid session ID.');
            return redirect()->route('/');
        };

        Stripe::setApiKey( config( 'services.stripe.secret' ) );
        $checkoutSession = StripeSession::retrieve($session_id);
        
        $order = Order::find($checkoutSession->metadata->order_id);
        $order->payment_status = 'paid';
        $order->save();

        // Empty the user's cart
        Auth::user()->cart->items()->delete();

        return view('frontend.checkout.success', ['order' => $order]);
        
    }

    public function cancel(){
        return view('frontend.checkout.cancel');
    }

   

    // Invoice View
    public function invoice(string $id){
        $order = Order::findOrFail($id);
        $pdf = Pdf::loadView('dashboard.orders.invoice', ['order' => $order]);
        return $pdf->download();
    }
}
