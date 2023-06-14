<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class MemberController extends Controller
{
    public function index()
    {
        
    }
    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|max:50|min:8',
                'password' => 'required|max:50|min:8'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'errors' => $validateUser->errors() 
                ], 422);
            }

            $user = Member::where('email', $request->email)->where('password', $request->password)->first();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json([
                'status' => true,
                'errors' => 'User Logged In Successfully',
                'success' => $success
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function create(Request $request){
        try {
            //Validated
            $validator = Validator::make($request->all(),[
                'name' => 'required|max:50',
                'email' => 'required||email|unique:members,email',
                'password' => 'required|min:8|max:16',
                'c_password' =>'required|same:password',
                'address' => 'required|max:255',
                'phone' => 'required|max:9|min:9',
                'description' => 'required',
                'image' => 'required|',
            ]);

            if($validator->fails()){
                $response = [
                    'status' => 422,
                    'errors' => $validator->errors()
                ];
                return response()->json($response, 422);
            }

            $input = $request->all();

            $input['password'] = bcrypt($input['password']);
            $user = Member::create($input);

            return response()->json([
                'status' => true,
                'message' => 'Tạo thành viên thành công',
                'token_member' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


}
