<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Validator;
class LikeController extends Controller
{
    public function index(){
        
        $like = Like::with('postMotel','user')->orderBy('id','desc')->get();
        return response()->json($like,200);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'post_id' => 'required',
            'user_id' => 'required'
       ]);
       if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }
        else{
            $like= Like::create([
                'post_id' => $request->post_id,
                'user_id' => $request->user_id,
            ]);
            if($like){
                return response()->json([
                    'status' => 200,
                    'message' => 'Thêm yêu thích thành công',
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
    public function delete(Request $request,$id)
     {
         $like = Like::find($id);
         if($like){
             $like->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'Xóa thành công',
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
