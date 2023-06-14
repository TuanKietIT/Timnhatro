<?php

namespace App\Http\Controllers\API;
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::orderBy('id','desc')->paginate(10);
        return response()->json($contact,200);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'title' => 'required|max:255',
            'email'=> 'required|email',
            'phone'=> 'required|numeric|digits:10',
            'desc' => 'required|max:255',

       ]);
       if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }
        else{
            $contact = Contact::create([
                'name' => $request->name,
                'title' => $request->title,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'desc' => $request->desc,
            ]);
            if($contact ){
                return response()->json([
                    'status' => 200,
                    'message' => 'Chúng tôi đã nhận được liên hệ và sớm phản hồi lại cho quý khách!',
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
         $contact = Contact::find($id);
         if($contact){
             $contact->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'Xóa Contact thành công',
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
