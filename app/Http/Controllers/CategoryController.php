<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Str;
use App\Product;
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
        // Save category then go to category page
        return redirect(route('admin.category.show', Category::create(['name' => $request->category_name, 'description' => $request->category_description, 'slug' => Str::slug($request->category_name)])));
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
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource. Only Admins should be able to edit
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // Change name, edit description, add products or remove products
        $unclassifiedProducts = Product::doesntHave('category')->get();

        return view('admin.categories.edit', compact('category', 'unclassifiedProducts'));
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
        // update the category details
        $request->validate(['name' => 'required']);
        $category->update($request->all());
        return redirect()->back()->with('success', 'Category Details Updated');
    }

    /**
     * Remove the specified resource from storage. Only admins should be able to destroy
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // This route will not destroy a category if it has products assigned to it.
        if ($category->products->count() > 0) {
            return redirect()->back()->with('failure', 'Remove all Products before deleting this category');
        } else {
            $category->delete();
        }
        return redirect()->to(route('admin.categories.index'))->with('success', 'Category Deleted');
    }

    /**
     * Add a Product to the specified category
     */
    public function addProduct(Request $request, Category $category, Product $product)
    {
        // Use a PATCH route to add a product to the specified category
        // This is a parent -> child relationship so we will use the associate method
        $product->category()->associate($category);
        // must call save method after using the associate method
        $product->save();
        // send the admin back to the previous page with the category model
        return redirect()->back()->with('success', 'Product added to this category successfuly');
    }

    /**
     * Remove a product from the specified category
     */
    public function removeProduct(Request $request, Category $category, Product $product)
    {
        // Use a PATCH route to add a product to the specified category
        // This is a parent -> child relationship so we will use the associate method
        $product->category()->dissociate();
        // must call save method after using the associate method
        $product->save();
        // send the admin back to the previous page with the category model
        return redirect()->back()->with('success', 'Product removed from this category successfuly');
    }
}
