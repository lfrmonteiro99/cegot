<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Auth;

class PublicController extends Controller
{
    public function index(){
        if(Auth::user() == NULL){
            return redirect()->route('login');
        }
        return view('home.home');
    }

    public function login(){
        return view('auth.login');
    }
}
