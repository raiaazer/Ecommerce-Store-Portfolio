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

        // foreach ($categories as $category) {
        //     $vari = json_decode($category->variations);
        // }

        return view('admin.product.create', compact('categories'));
    }


    // public function variation(Request $request)
    // {
    //     echo "ali";
    // }
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

            // Store the file object in the session so we can retrieve it later
            session(['uploadedFile' => $file]);

            if ($path) {
                // File was successfully uploaded and stored in session
                return response()->json(['message' => 'File uploaded successfully.']);
            } else {
                // There was an error storing the file in session
                return response()->json(['message' => 'Error storing file in session.']);
            }
        } else {
            // No file was uploaded
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
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            // 'name' => 'required',
            // 'price' => 'required',
            // 'category_id' => 'required',
            // 'quantity' => 'required',
            // 'sku' => 'required|unique:products',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        // dump($request->all());
        // Define the source directory
        $source = storage_path('app/session/temp');

        // Define the destination directory
        $destination = public_path('storage/products');

        // Get all files in the source directory
        $files = File::files($source);
        $imageNames = [];
        // Loop through the files and move them to the destination directory
        foreach ($files as $file) {
            // Get the original file name
            $originalName = $file->getFilename();

            // Define the new file name
            $newName = 'pro_' . rand(10000, 99999) . '_' . $originalName;

            // Move the file to the destination directory
            File::move($file->getPathname(), $destination.'/'.$newName);
            $imageNames[] = $newName;
        }

        // dump('stored');

        $sessionDriver = Storage::disk('session');
        // Get all files in the session's temp directory
        $files = $sessionDriver->files('temp');
        // Loop through the files and delete any that don't match the specific name
        foreach ($files as $file) {
                $sessionDriver->delete($file);
        }
        // dd('deleted');

        // if (session()->has('uploadedFile')) {
        //     $uploadedFile = session('uploadedFile');

        //     // Generate a unique filename
        //     $newFilename = uniqid() . '_' . $uploadedFile->getClientOriginalName();

        //     // Move the file to the public folder
        //     $uploadedFile->move(public_path('images'), $newFilename);

        //     // Update the session with the new filename
        //     session(['imageFilename' => $newFilename]);

        //     // Remove the uploadedFile from the session
        //     session()->forget('uploadedFile');
        // }

        // FOR MORE IMAGES
        // if (session()->has('uploadedFile')) {
        //     $imagePath = session()->get('uploadedFile');
        //     foreach ($imagePath as $image) {
        //         $imagePath = $image->store('temp');
        //         $publicPath = Storage::disk('public')->put('products', $image);
        //         session()->push('images', $publicPath);
        //         $product->product_images = $imagePath;
        //     }
        //     session()->forget('file');
        // }
        $product->product_images = implode(',', $imageNames);
        $product->save();

        return redirect()->route('product.index');

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
        // dump($product);
        // dump($category);
        // dd($id);
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
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

        Storage::delete($product->image);
        Storage::delete($product->product_images);

        $product->delete();

        return redirect()->route('product.index');
    }
}
