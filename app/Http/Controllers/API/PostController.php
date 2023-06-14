<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    public function index(){
        
        $post = Post::orderBy('id','desc')->get();
        return response()->json($post,200);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'description' => 'required',
       ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }
        else{
            $input = $request->all();
            Post::create($input);
            return response()->json([
                'status' => 200,
                'message' => 'Post create sucessfully',
            ],200);
        }
    }
    public function showByID(){
        $comment = DB::table('posts')->join('comments', 'comments.post_id' ,'posts.id')->get();
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
    public function delete(Request $request,$id)
    {
        $post = Post::find($id);
        if($post){
            $post->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Post delete sucessfully',
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
