<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use MongoDB\BSON\ObjectId;

class AuthController extends Controller{
    public function showLoginForm(){
        // echo bcrypt('123456');
        // print_r(session()->all());
        
        if (Session::has('user')) {
            return redirect('/recipe');
        }else{
            return view('auth.login');
        }
        
        
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $user=DB::connection('mongodb')
            ->table('users')
            ->where('email',$request->input('email'))
            ->first();
    
        if (!Hash::check($request->input('password'), $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password']);
        }
        $id = isset($user->_id) ? (string)$user->_id : (string)$user->id;

        Session::put('user',[
            'id'=>$id,
            'name'=>$user->name,
            'email'=>$user->email
        ]);

        return redirect('/recipe')->with('success','You logged in successfully!');
    }
    public function logout(){
        Session::forget('user');
        return redirect('/login')->with('success','You have successfully logged out!');
    }
}
