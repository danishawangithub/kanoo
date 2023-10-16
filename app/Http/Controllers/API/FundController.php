<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Fund;
class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funds = Fund::all();
        return response()->json(['funds' => $funds]);
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
            'card_type' => 'required',
            'description' => 'required',
            'file' => 'required',
            'amount' => 'required|between:0,99.99',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        
        $imgName = null;
        if ($request->hasFile('file')) {
            $img = $request->file('file');
            $imgName = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images/funds/'), $imgName);
        }

        $fund = new Fund;
        $fund->card_type = $request->card_type;
        $fund->description = $request->description;
        $fund->file = $imgName;
        $fund->amount = $request->amount;
        $fund->save();

        return response()->json(['message' => 'Fund added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fund = Fund::find($id);
        if (!$fund) {
            return response()->json(['error' => 'Fund not found'], 404);
        }
        return response()->json(['fund' => $fund]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fund = Fund::find($id);
        if (!$fund) {
            return response()->json(['error' => 'Fund not found'], 404);
        }
        return response()->json(['fund' => $fund]);
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
            'card_type' => 'required',
            'description' => 'required',
            'file' => 'required',
            'amount' => 'required|between:0,99.99',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $fund = Fund::find($id);

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imgName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/funds/'), $imgName);

            // Delete previous image if exists
            if ($product->file) {
                $previousPhotoPath = public_path('images/funds') . '/' . $product->file;
                if (file_exists($previousPhotoPath)) {
                    unlink($previousPhotoPath);
                }
            }
            $product->file = $imgName;
        }
        $fund->update($request->except('file'));
        return response()->json(['message' => 'File updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fund = Fund::find($id);
        if (!$fund) {
            return response()->json(['error' => 'Fund not found'], 404);
        }

        $fund->delete();
        return response()->json(['message' => 'Fund deleted successfully']);
    }
}
