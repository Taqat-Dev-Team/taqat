<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{

    use ResetsPasswords;
    // protected $redirectTo = RouteServiceProvider::HOME;
    // public function showResetForm(Request $request, $token = null)
    // {
    //     return view('front.auth.reset')->with([
    //         'token' => $token,
    //         'email' => $request->email
    //     ]);
    // }

    // Handle the password reset request
    // public function reset(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'required|email',
    //         'password' => 'required|confirmed|min:8',
    //     ]);

    //     return $this->resetPassword($request);
    // }

}
