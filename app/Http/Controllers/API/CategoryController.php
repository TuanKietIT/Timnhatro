<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    public function index(){
        return response()->json( Category::get());
    }
    public function show(){
        return response()->json( Category::get());
    }
    public function showId($id){
        $category = Category::find($id);
        return response()->json( $category);
    }
    public function create(Request $request){
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
             $catagory = Category::create([
                 'name' => $request->name,
                 'desc' => $request->desc,
             ]);
             if($catagory ){
                 return response()->json([
                     'status' => 200,
                     'message' => 'Category create sucessfully',
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
         $category = Category::find($id);
         if($category ){
             return response()->json([
                 'status' => 200,
                 'category' => $category,
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
             $category = Category::find($id);
             if($category){
                 $category->name = $request->input('name');
                 $category->desc = $request->input('desc');
                 $category->update();
                 return response()->json([
                     'status' => 200,
                     'message' => 'category update sucessfully',
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
         $category = Category::find($id);
         if($category){
             $category->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'category delete sucessfully',
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
