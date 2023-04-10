<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->get();

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function variationType(Request $request)
    {

        $cid = $request->post('cid');
        $vartype = Category::select('variations')->where('id', $cid)->get();
        $array = json_decode($vartype[0]->variations);
        $html = '<option value="" class="form-control p-2 my-2">Select</option>';
        foreach($array as $item){
            if ($item !== null) {
            $html.='<option value="'.$item.'" class="form-control p-2 my-2">'.$item.'</option>';
            }
        }
        echo $html;
    }

    public function upload(){
        $file = request()->file('file');

        if ($file) {
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('temp', $filename, 'session');

            session()->put('uploadedFile', [
                'filename' => $filename,
                'path' => $path,
            ]);

            if ($path) {
                return response()->json(['message' => 'File uploaded successfully.']);
            } else {
                return response()->json(['message' => 'Error storing file in session.']);
            }
        } else {
            return response()->json(['message' => 'No file uploaded.']);
        }

    }

    public function uploadRemove(){
        $filename = request()->input('filename');

        if ($filename) {
            Storage::disk('session')->delete('temp/' . $filename);
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function deleteImage(Request $request)
    {
        $productId = $request->input('id');
        $image = $request->input('image');
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found']);
        }

        $a = $product->product_images;
        $b = explode(',', $a);
        $images = $b;
        $index = array_search($image, $images);

        if ($index === false) {
            return response()->json(['success' => false, 'message' => 'Image not found']);
        }

        Storage::delete('public/products/'.$image);

        unset($images[$index]);

        $product->product_images = implode(',', $images);
        $product->save();

        return response()->json(['success' => true]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'quantity' => 'required',
            'sku' => 'required|unique:products',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product                    = new Product;
        $product->name              = $request->name;
        $product->price             = $request->price;
        $product->description       = $request->description;
        $product->category_id       = $request->category_id;
        $product->quantity          = $request->quantity;
        $product->sku               = $request->sku;
        $product->status            = $request->status;
        $product->tags              = $request->tags;
        $product->discount          = $request->discount;
        $product->coupon            = $request->coupon;
        $product->discounted_price  = $request->discounted_price;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('public/products', $image, $filename);
            $product->image = $filename;
        }

        $product->variation_type   = $request->variation_type;
        $product->variation        = $request->variation;

        $source = storage_path('app/session/temp');
        $destination = public_path('storage/products');

        $files = File::files($source);
        $imageNames = [];
        foreach ($files as $file) {
            $originalName = $file->getFilename();
            $newName = 'pro_' . rand(10000, 99999) . '_' . $originalName;

            File::move($file->getPathname(), $destination.'/'.$newName);
            $imageNames[] = $newName;
        }
        // dd($files);

        $sessionDriver = Storage::disk('session');
        $files = $sessionDriver->files('temp');
        foreach ($files as $file) {
                $sessionDriver->delete($file);
        }

        $product->product_images = implode(',', $imageNames);
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $images = explode(',', $product->product_images);

        return view('admin.product.edit', compact('product', 'categories','images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'quantity' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // dump($product);
        // dd($request->all());
        $product->name              = $request->name;
        $product->price             = $request->price;
        $product->description       = $request->description;
        $product->category_id       = $request->category_id;
        $product->quantity          = $request->quantity;
        $product->sku               = $request->sku;
        $product->status            = $request->status;
        $product->tags              = $request->tags;
        $product->discount          = $request->discount;
        $product->coupon            = $request->coupon;
        $product->discounted_price  = $request->discounted_price;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('public/products', $image, $filename);
            $product->image = $filename;
        }

        $product->variation_type   = $request->variation_type;
        $product->variation        = $request->variation;

        $source = storage_path('app/session/temp');
        $destination = public_path('storage/products');

        $files = File::files($source);
        $imageNames = [];

        foreach ($files as $file) {
            $originalName = $file->getFilename();

            $newName = 'pro_' . rand(10000, 99999) . '_' . $originalName;

            File::move($file->getPathname(), $destination.'/'.$newName);
            $imageNames[] = $newName;
        }

        $oldImageNames = explode(',', $product->product_images);

        $imageNames = array_merge($oldImageNames, $imageNames);

        $product->product_images = implode(',', $imageNames);

        $sessionDriver = Storage::disk('session');
        $files = $sessionDriver->files('temp');
        foreach ($files as $file) {
            $sessionDriver->delete($file);
        }

        $product->save();
        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        Storage::delete('public/products/' .$product->image);

        $images = explode(',', $product->product_images);
        foreach ($images as $image) {
            Storage::delete('public/products/' .$image);
        }
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }
}
