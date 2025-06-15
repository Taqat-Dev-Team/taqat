<?php

namespace App\Http\Controllers\Companies\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\Auth\LoginRequest;
use App\Http\Requests\Companies\Auth\RegisterRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getLogin()
    {

        return view('companies.auth.login');
    }

    public function postLogin(LoginRequest $request)
    {




        $credentials = $request->only('email', 'password');

        if (Auth::guard('company')->attempt($credentials)) {

            return response_web(true,__('label.success_full_process'),[],201);

        }

        else{

            return response_web(false,__('label.data_incorrect'),[],422);

        }
    }

    public function getRegister(){

        return view('companies.auth.register');

    }

    public function postRegister(RegisterRequest $request){

        try {

            $photo = "";
            if ($request->hasFile('photo')) {
                $photo =   upload($request->photo);

            }
       $company=Company::query()->create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'user_name'=>$request->user_name,
                'password'=>Hash::make($request->password),
                'photo'=>$photo,
            ]);


            Auth::guard('company')->login($company);
            return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);
        } catch (\Exception $exception) {
            return response_web(false, 'هناك خطا ما يرجى المحاولة لاحقا', [], 500);
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('companies.login');
    }
}
