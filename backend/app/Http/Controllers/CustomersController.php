<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Illuminate\Support\Facades\Hash;

class CustomersController extends Controller
{
    public function signUp(Request $req){
        $found = Customers::where('user_id','=',$req->userId)->first();
        if($found){
            $result['status']='failed';
            $result['message']='email already exists';
            return $result;
        }else{
            $validated = $req->validate([
                'user_name'=>'required',
                'user_id'=>'required',
                'password'=>'required|min:8',
                'phone'=>'required|max:8',
                'address'=>'required'
            ]);
            $customers = new Customers;
            $customers->name = $validated['name'];
            $customers->user_id = $validated['userId'];
            $customers->phone = $validated['phone'];
            $customers->address = $validated['address'];
            $customers->password = Hash::make($validated['password']);
            $customers->save();

            $result['status']='success';
            $result['message']='account created';

            return $result;
            
        }
        public function login(Request $req){
            $found = User::where('email','=',$req->email)->first();
            if(!$found){
                $result['status']='failed';
                $result['message']='account not found';
                return $result;
            }else{
                if(Hash::check($req->password,$found->password)){
                    $token= $found->createToken($found->email);
                    
                    $result['status']='success';
                    $result['token']=$token->plainTextToken;
                    return $result;
                }else{
                    $result['status']='success';
                    $result['message']= 'email or password incorrect';
    
                    return $result;
                }
            }
        }
}
