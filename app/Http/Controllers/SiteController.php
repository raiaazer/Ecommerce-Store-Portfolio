<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(){
        $categories = Category::withCount('products')->get();
        $products = Product::all();
        return view('user.index', compact('categories', 'products'));
    }

    public function siteDetails(){
        return view('admin.site.details');
    }
}
