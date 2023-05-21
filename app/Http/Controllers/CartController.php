<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartItems = cache()->get('cart', []);
        // dd($cartItems);

        return view('user.cart', compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product = Product::findOrFail($id);

        $cart = Cache::get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        Cache::put('cart', $cart, 60);
        dd($cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $product = Product::findOrFail($id);
        $cartItems = cache()->get('cart', []);

        if (isset($cartItems[$product->id])) {
            $cartItems[$product->id]['quantity'] += 1;
        } else {
            if ($product->discount > 0) {
                $discountPercentage = $product->discount;
                $discountedPrice = $product->price - ($product->price * $discountPercentage / 100);

                $cartItems[$product->id] = [
                    'name' => $product->name,
                    'price' => $discountedPrice,
                    'image' => $product->image,
                    'quantity' => 1,
                    'discount' => $discountPercentage,
                ];
            } else {
                $cartItems[$product->id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity' => 1,
                ];
            }
        }

        cache()->put('cart', $cartItems);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cartItems = cache()->get('cart', []);

        if (isset($cartItems[$product->id])) {
            $cartItems[$product->id]['quantity'] = $request->input('quantity');
        } else {
            if ($product->discount > 0) {
                $discountPercentage = $product->discount;
                $discountedPrice = $product->price - ($product->price * $discountPercentage / 100);

                $cartItems[$product->id] = [
                    'name' => $product->name,
                    'price' => $discountedPrice,
                    'image' => $product->image,
                    'quantity' => $request->input('quantity'),
                    'discount' => $discountPercentage,
                ];
            } else {
                $cartItems[$product->id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity' => $request->input('quantity'),
                ];
            }
        }

        cache()->put('cart', $cartItems);

        return response()->json(['message' => 'Cart quantity updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cartItems = cache()->get('cart', []);

        if (isset($cartItems[$id])) {
            unset($cartItems[$id]);
            cache()->put('cart', $cartItems);

            return redirect()->back()->with('success', 'Product removed from cart successfully!');
        }

        return redirect()->back()->with('error', 'Product not found in cart.');

    }
}
