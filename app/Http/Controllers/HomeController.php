<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('landing');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function userOrders()
    {
        # code...
        $orders = Auth::user()->orders;
        return view('user.orders', compact('orders'));
    }

    public function landing()
    {
        $products = Product::all();
        $unavailableProducts = $products->where('status', 'unavailable');
        $availableProducts = $products->where('status', 'available');
        return view('welcome', compact('products', 'unavailableProducts', 'availableProducts'));
    }

    function createAddress(Request $request)
    {
        $data = $request->validate([
            'street_address' => 'required|min:5',
            'city' => 'required|min:2',
            'island' => 'required',
        ]);
        $data = array_merge($data, ['country' => 'BS', 'delivery_notes' => $request->delivery_notes]);
        Auth::user()->address()->create($data);

        return redirect()->back()->with('success', 'Address Details confirmed');
    }

    function viewOrder(Order $order)
    {
        return view('user.order', compact('order'));
    }
}
