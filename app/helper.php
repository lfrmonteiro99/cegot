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