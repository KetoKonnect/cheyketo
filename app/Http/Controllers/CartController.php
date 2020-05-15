<?php

namespace App\Http\Controllers;

use App\Product;
use Darryldecode\Cart\CartCondition;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //create VAT condition
        $condition = new CartCondition([
            'name' => 'VAT 12%',
            'type' => 'tax',
            'target' => 'total',
            'value' => '12.00%',
            'attributes' => [
                'description' => 'Value added tax'
            ]
        ]);
        // Show the items in the cart
        \Cart::session(Auth::user()->id)->condition($condition);
        $items = \Cart::session(Auth::user()->id)->getContent();
        return view('user.cart', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {
        // add product to cart
        $user = Auth::user();

        $product = Product::find($product_id);

        \Cart::session($user->id)->add([
            'id' => $product->id,
            'price' => $product->price,
            'quantity' => 1,
            'name' => $product->name,
            'associatedModel' => $product
        ]);

        return redirect()->back()->with('cart_updated', '\'' . $product->name . '\' has been added to your cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // remove item
        \Cart::session(Auth::user()->id)->remove($id);

        return redirect()->back()->with('success', 'This item was removed from your cart');
    }

    function addOne($id)
    {
        // dd($item->quantity + 1);
        \Cart::session(Auth::user()->id)->update($id, [
            'quantity' => 1
        ]);

        return redirect()->back()->with('success', 'This item was updated');
    }

    function removeOne($id)
    {
        \Cart::session(Auth::user()->id)->update($id, ['quantity' => -1]);

        return redirect()->back()->with('success', 'This item was updated');
    }
}
