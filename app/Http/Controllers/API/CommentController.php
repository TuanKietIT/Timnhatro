<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $comments = Comment::with('post_motel')->orderBy('id','desc')->get();
        return response()->json($comments,200);
     }
     public function list(){
        return response()->json( Comment::get());
     }
     public function showId($id){
        $comment = Comment::find($id);
        return response()->json( $comment);
     }
     public function showByID(){
        $comment = DB::table('comments')->join('posts', 'comments.post_id' ,'posts.id')->get();
        if($comment){
            return response()->json([
                'status' => 200,
                'comment' => $comment,
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Not found ID',
            ],404);
        }
    }
     public function add(Request $request){
         $validator = Validator::make($request->all(),[
             'description' => 'required|max:255',
             'post_id' => 'required|max:255',
        ]);
        if($validator->fails()){
             return response()->json([
                 'status' => 422,
                 'errors' => $validator->messages(),
             ],422);
         }
         else{
             $comment= Comment::create([
                 'description' => $request->description,
                 'post_id' => $request->post_id,
             ]);
             if($comment){
                 return response()->json([
                     'status' => 200,
                     'message' => 'Comment create sucessfully',
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
         $comment = Comment::find($id);
         if($comment ){
             return response()->json([
                 'status' => 200,
                 'Comment' => $comment,
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
             'description' =>'required|max:255',
        ]);
        if($validator->fails()){
             return response()->json([
                 'status' => 422,
                 'errors' => $validator->messages(),
             ],422);
         }
         else{
             $comment = Comment::find($id);
             if($comment){
                 $comment->description = $request->description;
                 $comment->update();
                 return response()->json([
                     'status' => 200,
                     'message' => 'Comment update sucessfully',
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
         $comment = Comment::find($id);
         if($comment){
             $comment->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'Comment delete sucessfully',
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
