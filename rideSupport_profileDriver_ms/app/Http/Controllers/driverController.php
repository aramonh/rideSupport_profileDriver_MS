<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver;
class driverController extends Controller
{

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $drivers= Driver::where('email',$email)->first();

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

        $drivers["name"] = $request->input('name');
        $drivers["email"] = $request->input('email');
        $drivers["password"] = $request->input('password');
    
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

        $drivers["name"] = $request->input('name');
        $drivers["email"] = $request->input('email');
        $drivers["password"] = $request->input('password');
    
        $drivers->save();
        return response()->json($drivers);
    }



    public function deleteById($id, Request $request){
        $drivers= Driver::find($id);
        $drivers->delete();
        return response()->json($drivers);
    }
    
}
