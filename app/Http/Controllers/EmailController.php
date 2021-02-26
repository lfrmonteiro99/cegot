<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {

        try {
            $to = $request->to;

            $template = $request->template;

            $details = [
                'title' => 'Mail from ItSolutionStuff.com',
                'body' => 'This is for testing email using smtp',
                'to' => $to,
                'template' => $template,
            ];

            \Mail::to($to)->send(new \App\Mail\SendEmail($details));

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
