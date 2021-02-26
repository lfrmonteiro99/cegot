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

            Session::flash('message', 'The provided credentials do not match our records.');
            return redirect()->back();
        } catch (\Throwable $e) {
            Session::flash('message', 'The provided credentials do not match our records.');
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

    public function recoverPassword(Request $request, $code)
    {
dd(2);
        $user = User::whereRecoveryCode($code)->first();

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
            return view('auth.sendRecoveryPasswordSuccess');
        } catch (Throwable $t) {
            Session::flash('message', "Email doesn't exists in our records.");
            return redirect()->back();
        }
    }
}
