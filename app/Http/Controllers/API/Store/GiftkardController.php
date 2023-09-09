<?php

namespace App\Http\Controllers\API\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Giftkard;

class GiftkardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $giftkards = Giftkard::all();
        return response()->json(['giftkards' => $giftkards]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'giftkardname' => 'required|max:255',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $imgName = null;
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgName = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images/store/giftkard/'), $imgName);
        }

        $giftkard = new Giftkard;
        $giftkard->name = $request->giftkardname;
        $giftkard->image = $imgName;
        $giftkard->amount_type = $request->amountType;
        if ($giftkard->amount_type == 'singleValue') {
            $giftkard->amount = $request->amount;
        }else{
            $giftkard->amount_start = $request->amount_start;
            $giftkard->amount_end = $request->amount_end;
        }
        $giftkard->description = $request->description;
        $giftkard->location = $request->location;
        $giftkard->promote_wallet = $request->promote_wallet;
        $giftkard->redeemable_points = $request->redeemable_points;
        $giftkard->number_points = $request->number_points;
        $giftkard->redeemable_points = $request->redeemable_points;
        $giftkard->creation_cost = $request->creation_cost;
        $giftkard->save();

        return response()->json(['message' => 'Giftkard added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $giftkard = Giftkard::find($id);
        if (!$giftkard) {
            return response()->json(['error' => 'Giftkard not found'], 404);
        }
        return response()->json(['giftkard' => $giftkard]);
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
        $validator = Validator::make($request->all(), [
            'giftkardname' => 'required|max:255',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $giftkard = Giftkard::find($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imgName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/store/giftkard/'), $imgName);

            // Delete previous image if exists
            if ($giftkard->image) {
                $previousPhotoPath = public_path('images/store/giftkard') . '/' . $giftkard->image;
                if (file_exists($previousPhotoPath)) {
                    unlink($previousPhotoPath);
                }
            }
            $giftkard->image = $imgName;
        }
        $giftkard->update($request->except('image'));
        return response()->json(['message' => 'Giftkard updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $giftkard = Giftkard::find($id);
        if (!$giftkard) {
            return response()->json(['error' => 'Giftkard not found'], 404);
        }

        $giftkard->delete();

        return response()->json(['message' => 'Giftkard deleted successfully']);
    }
}
