<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\UserProfileResource;
use App\Models\Admin;
use App\Models\GeneratorSubscription;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function Login(LoginRequest $request)
    {

        try {

            $user = Admin::where('email', $request->email)->first();



            $user->plainTextToken = $user->createToken('user-token')->plainTextToken;

            $response['data'] = new UserProfileResource($user);

            return response_api(true, __('lang.Process_Successfull'), $response, 201);
        } catch (\Exception $exception) {
            $response['data'] = [];
            return response_api(false, __('lang.Process_Error'), $response, 500);
        }
    }
}
