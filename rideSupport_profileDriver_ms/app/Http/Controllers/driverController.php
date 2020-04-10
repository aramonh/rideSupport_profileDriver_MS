<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver;
use App\Login;
class driverController extends Controller
{

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $drivers= Login::where('email',$email)->first();

            if($drivers==""){
                return response("Username/Email does not exist, please register.");
            }else{
                if($drivers["password"]!=$password) {
                    return response("The password is wrong, try again with another one.");
                }else{
                    //TODO Devolver TOKENs
                    return response("Authorizated");
                    //return response()->json($drivers);
                }
            }
            return 0;
    }

    public function create(Request $request){
        $drivers = new Driver();
             
        $drivers["email"] = $request->input('email');
        $drivers["password"] = $request->input('password');
        $drivers["name"] = $request->input('name');
        $drivers["lastname"] = $request->input('lastname');
        $drivers["age"] = $request->input('age');
        $drivers["address"] = $request->input('address');
        $drivers["phone"] = $request->input('phone');
        $drivers["vehicle"] = $request->input('vehicle');

        $drivers->save();
        return response()->json($drivers);
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
