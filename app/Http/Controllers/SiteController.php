<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{
    public function index(){
        $categories = Category::withCount('products')->get();
        $products = Product::all();
        return view('user.index', compact('categories', 'products'));
    }

    public function SiteSettings(){
        $settings = Site::first();
        // dd($settings);
        return view('admin.site.settings', compact('settings'));
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'country_id' => 'nullable|exists:countries,id',
            'banner_images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'shop_description' => 'required',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // dd($request->all());


        $site = new Site();
        $site->country_id = $request->country_id;

        // Store multiple banner images
        if ($request->hasFile('banner_images')) {
            $bannerImages = $request->file('banner_images');
            $imageNames = [];
            foreach ($bannerImages as $bannerImage) {
                $filename = time() . '_' . $bannerImage->getClientOriginalName();
                Storage::putFileAs('public/sites', $bannerImage, $filename);
                $imageNames[] = $filename;
            }
            $site->banner_images = implode(',', $imageNames);
        }

        // Save logo image
        $logoImage = $request->file('logo');
        $logoImageName = time() . '_' . $logoImage->getClientOriginalName();
        Storage::putFileAs('public/sites', $logoImage, $logoImageName);
        $site->logo = $logoImageName;

        $site->name = $request->name;
        $site->address = $request->address;
        $site->phone = $request->phone;
        $site->email = $request->email;
        $site->shop_description = $request->shop_description;
        $site->facebook = $request->facebook;
        $site->twitter = $request->twitter;
        $site->instagram = $request->instagram;

        $site->save();
        return redirect()->route('site.settings')->with('success', 'Settings created successfully!');
    }

    public function deleteBannerImage(Request $request, $filename)
    {
        $site = Site::first();

        // Remove the file from storage
        Storage::delete('public/sites/' . $filename);

        // Remove the file name from the banner images list in the database
        $bannerImages = explode(',', $site->banner_images);
        $key = array_search($filename, $bannerImages);
        if ($key !== false) {
            unset($bannerImages[$key]);
            $site->banner_images = implode(',', $bannerImages);
            $site->save();
        }

        return response()->json(['message' => 'Banner image deleted successfully.']);
    }

    public function update(Request $request, $id)
    {
        // dump($id);
        // dd($request->all());
        $validator = \Validator::make($request->all(), [
            'country_id' => 'nullable|exists:countries,id',
            'banner_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'shop_description' => 'required',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $site = Site::findOrFail($id);
        $site->country_id = $request->country_id;

        // Delete banner images if necessary
        // if ($request->has('delete_banner_images')) {
        //     $bannerImagesToDelete = $request->input('delete_banner_images');
        //     foreach ($bannerImagesToDelete as $imageId) {
        //         $this->deleteBannerImage($site, $imageId);
        //     }
        // }

        // Store multiple banner images
        if ($request->hasFile('banner_images')) {
            $bannerImages = $request->file('banner_images');
            $imageNames = [];
            foreach ($bannerImages as $bannerImage) {
                $filename = time() . '_' . $bannerImage->getClientOriginalName();
                Storage::putFileAs('public/sites', $bannerImage, $filename);
                $imageNames[] = $filename;
            }
            if ($site->banner_images) {
                $currentImages = explode(',', $site->banner_images);
                $imageNames = array_merge($currentImages, $imageNames);
            }
            $site->banner_images = implode(',', $imageNames);
        }

        // Save logo image
        if ($request->hasFile('logo')) {
            $logoImage = $request->file('logo');
            $logoImageName = time() . '_' . $logoImage->getClientOriginalName();
            Storage::putFileAs('public/sites', $logoImage, $logoImageName);
            $site->logo = $logoImageName;
        }

        $site->name = $request->name;
        $site->address = $request->address;
        $site->phone = $request->phone;
        $site->email = $request->email;
        $site->shop_description = $request->shop_description;
        $site->facebook = $request->facebook;
        $site->twitter = $request->twitter;
        $site->instagram = $request->instagram;

        $site->save();

        return redirect()->route('site.settings')->with('success', 'Settings updated successfully!');
    }



}
