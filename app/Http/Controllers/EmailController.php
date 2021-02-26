<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendEmail(Request $request){

try{
$to = $request->to;

$details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp',
	'to' => $to,
    ];

    \Mail::to($to)->send(new \App\Mail\SendEmail($details));
   
    dd("Email is Sent.");
}catch(\Exception $e){
dd($e->getMessage());
}
}
}
