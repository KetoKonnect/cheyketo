<?php

namespace App\Http\Controllers;

use App\Product;
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
            return redirect(route('admin.home'));
        }
    }

    public function showlogin()
    {
        return view('admin.login');
    }


    public function index()
    {
        // We dont have anything to summerize yet send to products
        return redirect(route('admin.product.create'));
    }
}
