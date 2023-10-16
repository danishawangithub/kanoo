<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use Validator;
use Session;
 

class CampaignController extends Controller
{
     
    public function create_compaign(Request $request){ 

        

         $validator = Validator::make($request->all(), [
           'promotionName' => 'required',
           'cover_image' => 'required',
            //'video' => 'required',
           'description' => 'required',
           'address' => 'required',
           'gender' => 'required',
           'age' => 'required',
           'date' => 'required',
           
       ]);
        
       if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
       }
     
    
       if ($request->hasFile('cover_image')) {
            $img = $request->file('cover_image');
            $imgName = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('compaign_img'), $imgName);
        } 


        //  if ($request->hasFile('video')) {
        //     $img = $request->file('cover_image');
        //     $imgName = time() . '.' . $img->getClientOriginalExtension();
        //     $img->move(public_path('compaign_img'), $imgName);
        // }
   
 
       $data = [

                'promotion_name' => $request->promotionName,
                'cover_image' => $request->cover_image,
                'promotional_video' => $request->cover_image,
                'description' => $request->description,
                'address' => $request->address,
                'gender' => $request->gender,
                'age' => $request->age,
                'start_end_dates' => $request->date,
   
 
                ];

         

        $compaign_submit = Campaign::insert($data);

        if ($compaign_submit) {

             return response()->json(['message' => 'Compaign Submit Successfully'], 200);
        }else{

             return response()->json(['error' => 'Something wrong'], 500);
        }
 
    }


    public function get_compaign(){

          $all_compaign = Campaign::all();
          
          return response()->json(['all_compaign' =>$all_compaign], 200);
    }


}
