<?php

namespace App\Http\Controllers;

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
        return view('welcome', compact('products'));
    }
}
