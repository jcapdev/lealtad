<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthContoller extends Controller
{
    public function getLogin(){
        return view('admin.auth.login');
    }

    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $validated=auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'is_admin'=>1
        ],$request->password);
        
        $validateduser=auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'is_admin'=>0
        ],$request->password);

       

        if($validated){
            return redirect()->route('dashboard')->with('success','Login Successfull');
        }else if ($validateduser) {
            return redirect()->route('dashboard')->with('success','Login UserSuccessfull');
        }
        else{
            return redirect()->back()->with('error','Invalid credentials');
        }
    }
}
