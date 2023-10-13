<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order_rule;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('active', true)->get();
        $categories = Category::where('active', true)->get();
        return view('products.index')
                ->with(compact('products', 'categories'));
    }

    public function productcat()
    {
        $products = Product::where('active', true)->get();
        $categories = Category::where('active', true, 'category_id')->get();
        return view('products.categories')
                ->with(compact('products', 'categories'));
    }
    
    public function show(Product $product)
    {
        return view('products.show')
                ->with(compact('product'));
    }

    public function order(Product $product, Request $request)
    {
        $rule = new Order_rule();
        $rule->product = $product;
        $rule->type = $request->type;
        $rule->size = $request->size;

        $request->session()->push('cart', $rule);
        return redirect()->route('cart');
    }
}
