<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index(){
        
        $news = News::orderBy('id','desc')->paginate(6);
        return response()->json($news,200);
    }
    public function showNews(){
        
        $latestNews = News::orderBy('id','desc')->paginate(3);
        return response()->json($latestNews,200);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }
        else{
            $input = $request->all();
            $imageName = NULL;
            if ($image = $request->file('file')) {
                $destinationPath = 'img/';
                $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imageName);
                $input['image'] = $imageName;
            }
    
            News::create($input);
            return response()->json([
                'status' => 200,
                'message' => 'News create sucessfully',
            ],200);
        }
    }
    public function showNewID($id){
        $news = News::findOrFail($id);
        if($news){
            return response()->json([
                'status' => 200,
                'news' => $news,
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Not found ID',
            ],404);
        }
    }

    public function edit($id)
    {
        $post = Posts::find($id);
        return response()->json($post);
    }

    public function update($id, Request $request)
    {
        $news = News::find($id);
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
       if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }
        else{
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);

            $input = $request->all();
            $imageName = NULL;
            if ($image = $request->file('file')) {
                $destinationPath = 'img/';
                $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imageName);
                $input['image'] = $imageName;
                unlink('img/'.$news->image);
            }
            
            $news->update($input);
            return response()->json([
                'status' => 200,
                'message' => 'News update sucessfully',
            ],200);
        }
        
    }

    public function delete(Request $request,$id)
     {
         $news = News::find($id);
         if($news){
             $news->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'news delete sucessfully',
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
