<?php

namespace App\Http\Controllers\API\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json(['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $validator = Validator::make($request->all(), [
            'product_type' => 'required|max:255',
            'name' => 'required',
            'price' => 'required|between:0,99.99',
            'konnect_category_id' => 'required',
            'category_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $imgName = null;
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgName = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images/store/product/'), $imgName);
        }

        $product = new Product;
        $product->product_type = $request->product_type;
        $product->name = $request->name;
        $product->image = $imgName;
        $product->feature = $request->feature;
        $product->rank = $request->rank;
        $product->price = $request->price;
        $product->upc = $request->upc;
        $product->description = $request->description;
        $product->discount = $request->discount;
        $product->price_after_disc = $request->price_after_disc;
        $product->instore = $request->instore;
        $product->stock_qantity = $request->stock_qantity;
        $product->points_redeemable = $request->points_redeemable;
        $product->no_of_points = $request->no_of_points;
        $product->points_earned = $request->points_earned;
        $product->have_tax = $request->have_tax;
        $product->terms_conditions = $request->terms_conditions;
        $product->konnect_category_id = $request->konnect_category_id;
        $product->category_id = $request->category_id;
        $product->tags = $request->tags;
        $product->cross_selling_products = $request->cross_selling_products;

        if ($product->product_type == 'simple') {
            $product->product_options = $request->option;
        }else{
            $product->custom_attribute = $request->custom_attribute;
            $product->available_attribute = $request->available_attribute;
            $product->variation = $request->variation;
            $product->variation_all_attribute = $request->variation_all_attribute;
        }

        $product->creation_cost = $request->creation_cost;
        $product->save();

        return response()->json(['message' => 'Product added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json(['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json(['product' => $product]);
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

        $validator = Validator::make($request->all(), [
            'product_type' => 'required|max:255',
            'name' => 'required',
            'price' => 'required|between:0,99.99',
            'konnect_category_id' => 'required',
            'category_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $product = Product::find($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imgName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/store/product/'), $imgName);

            // Delete previous image if exists
            if ($product->image) {
                $previousPhotoPath = public_path('images/store/product') . '/' . $product->image;
                if (file_exists($previousPhotoPath)) {
                    unlink($previousPhotoPath);
                }
            }
            $product->image = $imgName;
        }
        $product->update($request->except('image'));
        
        return response()->json(['message' => 'Product updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
