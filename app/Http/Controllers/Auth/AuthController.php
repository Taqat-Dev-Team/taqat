<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthController extends Controller
{



    public function getLogin()
    {

        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {

        $input = $request->input('email');
        $password = $request->input('password');


        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            // Login using email
            $credentials = ['email' => $input, 'password' => $password];
        } else {
            // Login using mobile
            $credentials = ['mobile' => $input, 'password' => $password];
        }

        // Attempt authentication
        if (Auth::attempt($credentials)) {
            return response()->json(["status" => 201, 'message' => 'تم الدخول  بنجاح', 'redirect_url' => route('admin.users.index')]);
        }


        // Authentication failed
        return response()->json(["status" => 422, 'message' => 'ادخل البيانات بشكل صحيح']);
    }




    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }
}
