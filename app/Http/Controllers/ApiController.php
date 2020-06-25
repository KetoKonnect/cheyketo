<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

use App\Product;

use App\Http\Resources\Products as ProductsResource;
use App\Http\Resources\Order as OrderResource;

class ApiController extends Controller
{
    //
    public function updateOrderStatus(Request $request, Order $order)
    {
        $order->updateStatus($request->status);
        return response()->json($order);
    }

    public function apiAllProducts(Request $request)
    {
        return ProductsResource::collection(Product::all());
    }

    public function deleteProduct(Product $product)
    {
        # code...
        $product->delete();
        return response()->json(['message' => 'Product Deleted']);
    }
}
