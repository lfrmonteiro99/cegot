<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PublicController extends Controller
{
    public function index(){
        return view('home.home');
    }

    public function login(){
        return view('auth.login');
    }
}
