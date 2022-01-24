<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customer;
use Validator;
use Hash;
use App\Services\UploadImage\UploadImageService;

class AuthCustomerController extends Controller
{
    private $uploadImageService;

    public function __construct(UploadImageService $uploadImageService) {
        $this->uploadImageService = $uploadImageService;
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    public function register(Request $request){
        	$validator = Validator::make($request->all(), [
                'user_name' => 'required',
                'password' => 'required|string|min:6',
            ]);
            $nameStorage = 'Image/customer/';

            if ($validator->fails()) {
                return response()->json(['message' => false,'data' => $validator->errors()], 422);
            } else {
                try {
                    $data = new User();
                    $data->name = $request->name;
                    $data->user_name = $request->user_name;
                    $data->password = Hash::make($request->password);
                    $data->role = 'customer';
                    $data->save();

                    if (!empty($data->id)) {
                        $dataCustomer = new Customer();
                        $dataCustomer->user_id = $data->id;
                        $dataCustomer->name = $request->name;
                        $dataCustomer->email = $request->email;
                        $dataCustomer->phone = $request->phone;
                        $dataCustomer->address = $request->address;
                        if (!empty($request->image) ) {
                            $nameImage = $this->uploadImageService->imageProcessingStore($nameStorage, $request->image);
                            $dataCustomer->image = $nameImage;
                        }
                        $dataCustomer->status = 'active';
                        $dataCustomer->save();
                    }
                    return response()->json(['message' => true, 'data' => 'has been registered customer'], 200);
                } catch(\Throwable $e){
                    return response()->json(['message' => false, 'data' => 'has been failed registered customer'], 401);
                }

            }

        }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

}
