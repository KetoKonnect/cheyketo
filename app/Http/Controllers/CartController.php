<?php

namespace App\Http\Controllers;

use App\Notifications\OrderReceived;
use App\Notifications\OrderSubmitted;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

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
        $items = \Cart::session(Auth::user()->id)->getContent();
        return view('user.cart', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCheckout()
    {
        //
        $items = \Cart::session(Auth::user()->id)->getContent();
        return view('user.checkout', compact('items'));
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
        $cart = \Cart::session($user->id);

        if ($cart->get($product->id)) {
            $quantity_incart = $cart->get($product->id)->quantity;
        } else {
            $quantity_incart = 0;
        }


        if ($product->qtyavailable(1) && ($quantity_incart < 3)) {
            \Cart::session($user->id)->add([
                'id' => $product->id,
                'price' => $product->price,
                'quantity' => 1,
                'name' => $product->name,
                'associatedModel' => $product
            ]);
            return redirect()->back()->with('cart_updated', '\'' . $product->name . '\' has been added to your cart');
        } else {
            return redirect()->back()->with('fail', '\'' . $product->name . '\' - max allowed quantity reached');
        }
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
        if (\Cart::session(Auth::user()->id)->getContent()->count() <= 0) {
            \Cart::session(Auth::user()->id)->clearCartConditions();
        }

        return redirect()->back()->with('success', 'This item was removed from your cart');
    }

    function addOne($id)
    {
        // dd($item->quantity + 1);
        // see if we have reached the max avail
        $cart = \Cart::session(Auth::user()->id);

        $item = $cart->get($id);
        if ($item->associatedModel->qtyAvailable($item->quantity) && ($item->quantity < 3)) {
            \Cart::session(Auth::user()->id)->update($id, [
                'quantity' => 1
            ]);
        } else {
            return redirect()->back()->with('fail', 'Max reached for ' . $item->name);
        }


        return redirect()->back()->with('success', 'This item was updated');
    }

    function removeOne($id)
    {
        \Cart::session(Auth::user()->id)->update($id, ['quantity' => -1]);

        if (\Cart::session(Auth::user()->id)->getContent()->count() <= 0) {
            \Cart::session(Auth::user()->id)->clearCartConditions();
        }

        return redirect()->back()->with('success', 'This item was updated');
    }

    function checkout(Request $request)
    {
        // validate request
        $request->validate(['payment_method' => 'required']);
        // get cart contents
        $cart = \Cart::session(Auth::user()->id);
        $items = $cart->getContent();
        // create line items
        $lineItems = [];
        foreach ($items as $index => $item) {
            if ($item->associatedModel->destock($item->quantity)) {
                array_push($lineItems, [
                    'id' => $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'description' => $item->associatedModel->description
                ]);
            } else {
                return redirect(route('cart.view'))->with('fail', 'Quantity requested for ' . $item->name . ' is not available');
            }
        }
        // create order and assign it to the user
        $order = Auth::user()->orders()->create([
            'line_items' => $lineItems,
            'payment_method' => $request->payment_method,
            'subtotal' => $cart->getSubTotal(),
            'total' => $cart->getTotal(),
            'status' => 'new'
        ]);

        // notify customer and admin

        // 1 - notify customer via email
        Auth::user()->notify(new OrderSubmitted($order));

        // 2 - notify sales via email
        Notification::route('mail', env('SALES_EMAIL', 'ketokonnect242@gmail.com'))
            ->notify(new OrderReceived($order));

        $cart->clear();
        return redirect(route('user.orders'))->with('success', 'Order Placed');
    }
}
