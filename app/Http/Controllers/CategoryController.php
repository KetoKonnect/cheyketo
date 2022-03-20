<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * 
     * Adding controller guard because this resources is only to be controlled by the Admin
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * Display a listing of the resource. Admin Only
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show a table of all Categorys and a link to the form to create a category
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource. Only Admins can create Categories
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Just show the form for creating a new category (name, description (optional))
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage. Only Admin can store
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource. Only Admin should be able to view details of Category
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // Display a category and its contents
    }

    /**
     * Show the form for editing the specified resource. Only Admins should be able to edit
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage. Only admins should be able to update
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage. Only admins should be able to destroy
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
