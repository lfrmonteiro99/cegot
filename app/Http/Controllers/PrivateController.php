<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivateController extends Controller
{
    public function index(){
        return view('private._layout.index');
    }
}
