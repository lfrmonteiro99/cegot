<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function verifyLogin(Request $request){
        try{
            
            $credentials = $request->only('email', 'password');
            
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
    
    
                return redirect()->route('home');
            }
            

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);

        }catch(\Throwable $e){
            dd($e->getMessage());
            report($e);

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function logout(){
        Auth::logout();

        return redirect('/');
    }
}
