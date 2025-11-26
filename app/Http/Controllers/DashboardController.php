<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index () {
        $products = Product::with('inventory')->get();
        $orders = Order::paginate(5);
        $customers = User::where('role', 'user')->get();
        return view('dashboard.index', [
            'products' => $products,
            'orders' => $orders,
            'customers' => $customers,
        ]);
    }
}