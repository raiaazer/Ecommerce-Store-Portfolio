<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class UserCategoryController extends Controller
{
    public function category(){
        $categories = Category::withCount('products')->get();
        return view('user.category', compact('categories'));
    }
}
