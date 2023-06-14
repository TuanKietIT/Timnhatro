<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    public function index(){
        $location = Location::orderBy('id','desc')->paginate(10);
        return response()->json($location,200);
    }
    public function show(){
        return response()->json( Location::get());
    }
    public function showId($id){
        $location = Location::find($id);
        return response()->json( $location);
    }
    public function create(Request $request){
         $validator = Validator::make($request->all(),[
             'name' => 'required',
        ]);
        if($validator->fails()){
             return response()->json([
                 'status' => 422,
                 'errors' => $validator->messages(),
             ],422);
         }
         else{
             $location= Location::create([
                 'name' => $request->name,
             ]);
             if($location){
                 return response()->json([
                     'status' => 200,
                     'message' => 'Tạo khu vực thành công',
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
         $location = Location::find($id);
         if($location ){
             return response()->json([
                 'status' => 200,
                 'Location' => $location,
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
        ]);
        if($validator->fails()){
             return response()->json([
                 'status' => 422,
                 'errors' => $validator->messages(),
             ],422);
         }
         else{
             $location = Location::find($id);
             if($location){
                 $location->name = $request->input('name');
                 $location->update();
                 return response()->json([
                     'status' => 200,
                     'message' => 'Cập nhật khu vực thành công!',
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
         $location = Location::find($id);
         if($location){
             $location->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'Xóa Khu vực thành công',
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
