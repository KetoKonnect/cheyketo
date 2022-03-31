<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['landing', 'ShopByCategory']);
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
        $categories = Category::all();
        return view('welcome', compact('products', 'unavailableProducts', 'availableProducts', 'categories'));
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

    public function updateAddress(Request $request, User $user)
    {
        $user->address->update(array_merge($request->validate([
            'street_address' => 'required|min:5',
            'city' => 'required|min:2',
            'island' => 'required'
        ]), ['country' => 'BS', 'delivery_notes' => $request->delivery_notes]));

        return redirect()->back()->with('success', 'Address Details Updated');
    }

    function viewOrder(Order $order)
    {
        return view('user.order', compact('order'));
    }

    public function ShopByCategory(Category $category)
    {
        $products = $category->products;
        $unavailableProducts = $products->where('status', 'unavailable');
        $availableProducts = $products->where('status', 'available');
        $categories = Category::all();
        return view('welcome', compact('products', 'unavailableProducts', 'availableProducts', 'categories'));
    }
}
