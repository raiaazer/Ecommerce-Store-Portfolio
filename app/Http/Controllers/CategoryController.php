<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        // dd($categories);
        return view('admin.category.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $pro = $request->variation;
        // for ($i = 0; $i < count($pro); $i++) {
        //     $vari                = new Variation();
        //     $vari->name          = $pro[$i];
        //     $vari->save();
        // }

        $arr = $request->variation;
        $category                  = new Category();
        // $category->variation_id    = $vari->id;
        $category->variations      = json_encode($arr);

        $category->name            = $request->name;
        $category->description     = $request->description;

        $category->status          = $request->status;
        $category->tags            = $request->tags;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/categories', $filename);
            $category->image = $path;
        }

        $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $variation = json_decode($category->variations);

        return view('admin.category.edit', compact('category', 'variation'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $arr                       = $request->variation;
        $category->variations      = json_encode($arr);

        $category->name            = $request->name;
        $category->description     = $request->description;

        $category->status          = $request->status;
        $category->tags            = $request->tags;


        if ($request->hasFile('image')) {
            // delete the previous image if it exists
            if ($category->image) {
                Storage::delete($category->image);
            }
            // store the new image
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/categories', $filename);
            $category->image = $path;
        }

        $category->save();


        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        Storage::delete($category->image);

        $category->delete();

        return redirect()->route('category.index');
    }
}
