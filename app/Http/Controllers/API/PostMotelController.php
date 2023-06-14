<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Location;
use App\Models\PostMotel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class PostMotelController extends Controller
{
    public function index(){
        
        $post = PostMotel::with('category','location','user')->orderBy('id','desc')->paginate(5);
        return response()->json($post,200);
    }
    public function show(){
        $post = PostMotel::with('category','location','user')->where('choose','1')->orderBy('id','desc')->paginate(5);
        return response()->json($post,200);
    }
    public function showByID($id){
        $postMotel = PostMotel::with('category','location','user')->where('choose','1')->findOrFail($id);
        if($postMotel){
            return response()->json([
                'status' => 200,
                'post_motels' => $postMotel,
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Not found ID',
            ],404);
        }
    }
    public function search(Request $request){
        $queryString =  $request->queryString;
        $post_motel = PostMotel::where('title','like','%' .$queryString. '%')->orWhere('price','like','%' .$queryString. '%')->get();
       
        return response()->json($post_motel);
        
    }
    public function searchArea(Request $request){
        $queryString =  $request->queryString;
        $post_motel = PostMotel::where('area','like','%' .$queryString. '%')->orWhere('price','like','%' .$queryString. '%')->get();
       
        return response()->json($post_motel);
        
    }
    
    public function showCategoryID($id){
        $postMotel = PostMotel::where('category_id',$id)->where('choose','1')->get();
        if($postMotel){
            return response()->json([
                'status' => 200,
                'post_motels' => $postMotel,
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Not found ID',
            ],404);
        }
    }
    public function showLocationID($id){
        $postMotel = PostMotel::where('location_id',$id)->where('choose','1')->get();
        if($postMotel){
            return response()->json([
                'status' => 200,
                'post_motels' => $postMotel,
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Not found ID',
            ],404);
        }
    }
    public function create(Request $request)
    {   try{
            $validator = Validator::make($request->all(),[
                'title'=> 'required',
                'price'=> 'required',
                'purpose'=> 'required',
                'status'=> 'required',
                'deposit'=> 'required',
                'structure'=> 'required',
                'description'=> 'required',
                'area'=> 'required',
                'address_address'=> 'required',
                'address_latitude'=> 'required',
                'address_longitude'=> 'required',
                'user_id'=> 'required',
                'category_id'=> 'required',
                'location_id'=> 'required',
                'description' => 'required',
                'file1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'file2' => 'required',
                'file3' => 'required',
                'file4' => 'required',
                'file5' => 'required',
                'file6' => 'required',
                'choose' => 'required'
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
                $imageName2 = NULL;
                $imageName3 = NULL;
                $imageName4 = NULL;
                $imageName5 = NULL;
                $imageName6 = NULL;
                if ($image1 = $request->file('file1')) {
                    $destinationPath = 'img/';
                    $imageName1 = Str::random(40) . "." . $image1->guessExtension();
                    $image1->move($destinationPath, $imageName1);
                    $input['image1'] = $imageName1;
                }
                if ($image2 = $request->file('file2')) {
                    $destinationPath2 = 'img/';
                    $imageName2 = Str::random(40) . "." . $image2->guessExtension();
                    $image2->move($destinationPath2, $imageName2);
                    $input['image2'] = $imageName2;
                }
                if ($image3 = $request->file('file3')) {
                    $destinationPath = 'img/';
                    $imageName3 = Str::random(40) . "." . $image3->guessExtension();
                    $image3->move($destinationPath, $imageName3);
                    $input['image3'] = $imageName3;
                }
                if ($image4 = $request->file('file4')) {
                    $destinationPath = 'img/';
                    $imageName4 = Str::random(40) . "." . $image4->guessExtension();
                    $image4->move($destinationPath, $imageName4);
                    $input['image4'] = $imageName4;
                }
                if ($image5 = $request->file('file5')) {
                    $destinationPath = 'img/';
                    $imageName5 = Str::random(40) . "." . $image5->guessExtension();
                    $image5->move($destinationPath, $imageName5);
                    $input['image5'] = $imageName4;
                }
                if ($image6 = $request->file('file6')) {
                    $destinationPath = 'img/';
                    $imageName6 = Str::random(40) . "." . $image6->guessExtension();
                    $image6->move($destinationPath, $imageName6);
                    $input['image6'] = $imageName6;
                }
                
        
                PostMotel::create($input);
                return response()->json([
                    'status' => 200,
                    'message' => 'PostMotel create sucessfully',
                ],200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
        
    }
    public function update($id, Request $request)
    {
        $post = PostMotel::find($id);
        $validator = Validator::make($request->all(),[
            'choose' => 'required',
       ]);
       if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }
        else{
            $request->validate([
                'choose' => 'required',
            ]);

            $input = $request->all();
            
            $post->update($input);
            return response()->json([
                'status' => 200,
                'message' => 'cập nhật đăng tin thành công',
            ],200);
        }
        
    }
    public function updateSee($id, Request $request)
    {
        $post = PostMotel::find($id);
        $validator = Validator::make($request->all(),[
            'see' => 'required',
       ]);
       if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }
        else{
            $request->validate([
                'see' => 'required',
            ]);

            $input = $request->all();
            
            $post->update($input);
            return response()->json([
                'status' => 200,
                'message' => 'cập nhật đăng tin thành công',
            ],200);
        }
        
    }
    public function delete(Request $request,$id)
    {
        $postMotel = PostMotel::find($id);
         if($postMotel){
            $postMotel->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'Xóa Đăng tin thành công',
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
