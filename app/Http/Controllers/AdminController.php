<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function login(Request $request)
    {
        if (Auth::guard('admin')->attempt(
            ['email' => $request->email, 'password' => $request->password]
        )) {
            return redirect()->intended(route('admin.home'));
        } else {
            return redirect()->back()->with('error', 'Invalid login credentials');
        }
    }

    public function showlogin()
    {
        return view('admin.login');
    }


    public function index()
    {
        $ordersCount = Order::all()->count();
        $newOrders = Order::where('status', '=', 'new')->get()->count();
        return view('admin.home', compact('ordersCount', 'newOrders'));
    }

    public function viewOrder($order)
    {
        # code...
        $order = Order::find($order);
        return view('admin.orders.view', compact('order'));
    }

    function allOrders()
    {
        $orders = Order::all();
        return view('admin.orders.all', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $order->updateStatus($request->status);
        return redirect()->back()->with('success', 'Order has been updated, and the customer has been notified');
    }

    public function allProducts()
    {
        $products = Product::all();
        return view('admin.products.all', compact('products'));
    }

    public function getProduct(Product $product)
    {
        return view('admin.products.view', compact('product'));
    }

    public function editProduct(Request $request, Product $product)
    {
        $product = $product->update($request->validate([
            'name' => 'required|min:5',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'description' => 'required|min:10',
            'thumbnail' => 'image'
        ]));
        # code...
        return redirect(route('admin.products.edit', $product->id))->with('success', 'Product Updated');
    }
}
