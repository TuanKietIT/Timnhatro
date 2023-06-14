<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function index(){
        
        $user = User::orderBy('id','desc')->get();
        return response()->json($user,200);
    }
    public function login(Request $request){
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

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'errors' => 'Email & Password does not match with our record.',
                ], 422);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'errors' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function sigin(Request $request){
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

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'errors' => 'Email & Password does not match with our record.',
                ], 422);
            }

            $user = User::where('email', $request->email)->orWhere('status', 1)->first();

            return response()->json([
                'status' => true,
                'errors' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
    }
    public function sigup(Request $request)
    {
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
            $user = User::create($input);

            return response()->json([
                'status' => true,
                'message' => 'Tạo thành viên thành công',
                
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
