<?php

use Illuminate\Support\Facades\Auth;

function ola(){
    dd(Auth::user());
}

function IS_ADMIN(){
    if(!empty(Auth::user())){
        return Auth::user()->role == 'admin';
    }

    return false;
    
}

function GET_USER_NAME(){
    if(!empty(Auth::user())){
        return Auth::user()->name;
    }

    return "";
}

function GENERATE_RANDOM_STRING($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}