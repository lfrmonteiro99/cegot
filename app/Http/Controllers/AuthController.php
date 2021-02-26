<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Throwable;

class AuthController extends Controller
{
    public function verifyLogin(Request $request)
    {
        try {

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();


                return redirect()->route('home');
            }

            Session::flash('message', 'As credenciais não estão corretas.');
            return redirect()->back();
        } catch (\Throwable $e) {
            Session::flash('message', 'As credenciais não estão corretas.');
            report($e);

            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function recoverPasswordPage($code)
    {
        $user = User::whereRecoveryCode($code)->first();
        $data = [];
        $data['user'] = $user;

        return view('auth.recovery', $data);
    }

    public function recoverPassword(Request $request)
    {
        $user = User::whereRecoveryCode($request->input('code'))->first();

        $user->password = Hash::make($request->input('password'));

        $user->save();

        return view('auth.recoverySucess');
    }

    public function passwordRecoveryPage()
    {
        return view('auth.recoverEmail');
    }

    public function submitEmailRecovery(Request $request)
    {
        try {
            $user = User::whereEmail($request->email)->firstOrFail();

            $user->recovery_code = GENERATE_RANDOM_STRING(10);

            $user->save();

            $request->request->add(['to' => $user->email]);
            $request->request->add(['template' => 'recovery']);


            app('App\Http\Controllers\EmailController')->sendEmail($request);

            return view('auth.sendRecoveryPasswordSuccess');
        } catch (Throwable $t) {
            dd($t->getMessage());
            Session::flash('message', "O email não está registado na plataforma.");
            return redirect()->back();
        }
    }
}
