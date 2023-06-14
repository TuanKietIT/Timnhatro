<?php

namespace App\Http\Controllers\API;

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accuracy;
use Illuminate\Support\Facades\Validator;

class AccuracyController extends Controller
{
    public function index(){
        return response()->json( Accuracy::get());
     }
     public function list(){
        return response()->json( Accuracy::get());
     }
     public function showId($id){
        $Accuracy = Accuracy::find($id);
        return response()->json( $Accuracy);
     }
     public function add(Request $request){
         $validator = Validator::make($request->all(),[
             'name' => 'required',
             'desc' => 'required|max:255',
        ]);
        if($validator->fails()){
             return response()->json([
                 'status' => 422,
                 'errors' => $validator->messages(),
             ],422);
         }
         else{
             $accuracy= Accuracy::create([
                 'name' => $request->name,
                 'desc' => $request->desc,
             ]);
             if($accuracy){
                 return response()->json([
                     'status' => 200,
                     'message' => 'Accuracy create sucessfully',
                 ],200);
             }
             else{
                 return response()->json([
                     'status' => 500,
                     'message' => 'Something Went Wrong',
                 ],500);
             }
         }
     }
     public function edit($id){
         $Accuracy = Accuracy::find($id);
         if($Accuracy ){
             return response()->json([
                 'status' => 200,
                 'Accuracy' => $Accuracy,
             ],200);
         }
         else{
             return response()->json([
                 'status' => 404,
                 'message' => 'Not found ID',
             ],404);
         }
     }
     public function update(Request $request,$id){
         $validator = Validator::make($request->all(),[
             'name' => 'required',
             'desc' => 'required|max:255',
        ]);
        if($validator->fails()){
             return response()->json([
                 'status' => 422,
                 'errors' => $validator->messages(),
             ],422);
         }
         else{
             $Accuracy = Accuracy::find($id);
             if($Accuracy){
                 $Accuracy->name = $request->input('name');
                 $Accuracy->desc = $request->input('desc');
                 $Accuracy->update();
                 return response()->json([
                     'status' => 200,
                     'message' => 'Accuracy update sucessfully',
                 ],200);
             }
             else{
                 return response()->json([
                     'status' => 404,
                     'message' => 'Something Went Wrong',
                 ],404);
             }
         }
     }
     public function delete(Request $request,$id)
     {
         $Accuracy = Accuracy::find($id);
         if($Accuracy){
             $Accuracy->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'Accuracy delete sucessfully',
             ],200);
         }
         else{
             return response()->json([
                 'status' => 404,
                 'message' => 'Something Went Wrong',
             ],404);
         }
     }
}
