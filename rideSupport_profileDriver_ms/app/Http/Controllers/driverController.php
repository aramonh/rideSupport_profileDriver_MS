<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;

use App\Driver;
use App\Login;
class driverController extends Controller
{

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }
    public function getAuthenticatedUser()
    {
        try {
            if (!$drivers= JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
            }
            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                    return response()->json(['token_expired'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                    return response()->json(['token_invalid'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                    return response()->json(['token_absent'], $e->getStatusCode());
            }
            return response()->json(compact('drivers'));
    }
    
    public function register(Request $request)
        {
                $validator = Validator::make($request->all(), [
                
                'email' => 'required|string|email|max:255|unique:drivers',
                'password' => 'required|string',
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'age' => 'required|integer',
                'address' => 'required|string|max:255',
                'phone' => 'required|integer',
                'vehicle' => 'required|string|max:255',
            ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }
            $drivers = new Driver();
             
            $drivers["email"] = $request->input('email');
            $drivers["password"]=Hash::make($request->get('password'));
            $drivers["name"] = $request->input('name');
            $drivers["lastname"] = $request->input('lastname');
            $drivers["age"] = $request->input('age');
            $drivers["address"] = $request->input('address');
            $drivers["phone"] = $request->input('phone');
            $drivers["vehicle"] = $request->input('vehicle');
    
            $drivers->save();
           

            $token = JWTAuth::fromUser($drivers);

            return response()->json(compact('drivers','token'),201);
        }

        public function logout()
        {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Successfully logged out']);
        }
   

 
    public function getAll(){
        $drivers= Driver::all();
        return response()->json($drivers);
    }

  
    public function getById($id){
        $drivers= Driver::find($id);
        return response()->json($drivers);
    }

    public function updateById($id, Request $request){
        $drivers= Driver::find($id);
       
        
        if($request->input('email')){
            $drivers["email"] = $request->input('email');
        }
        if($request->input('password')){
            $drivers["password"] = $request->input('password');
        }
        if($request->input('name')){
            $drivers["name"] = $request->input('name');
        }
        if($request->input('lastname')){
            $drivers["lastname"] = $request->input('lastname');
        }
        if($request->input('age')){
            $drivers["age"] = $request->input('age');
        }
        if($request->input('address')){
            $drivers["address"] = $request->input('address');
        }
        if($request->input('phone')){
            $drivers["phone"] = $request->input('phone');
        }
        if($request->input('vehicle')){
            $drivers["vehicle"] = $request->input('vehicle');
        }
        
       
        
        
    
        $drivers->save();
        return response()->json($drivers);
    }



    public function deleteById($id, Request $request){
        $drivers= Driver::find($id);
        $drivers->delete();
        return response()->json($drivers);
    }
    
}
