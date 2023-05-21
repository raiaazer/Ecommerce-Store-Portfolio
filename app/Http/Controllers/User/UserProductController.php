<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function product(){
        $categories = Category::withCount('products')->get();
        $products = Product::paginate(12);
        return view('user.products', compact('categories', 'products'));
    }


    public function filterByPrice(Request $request)
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $filterproducts = Product::whereBetween('price', [$minPrice, $maxPrice])->get();
        return view('user.productsfilter', ['filterproducts' => $filterproducts]);

    }
}
