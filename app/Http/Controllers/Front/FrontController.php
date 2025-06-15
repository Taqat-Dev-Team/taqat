<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Attachment;
use App\Models\City;
use App\Models\Country;
use App\Models\Institution;
use App\Models\Interest;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){

        return view('front.index');
    }

    public function addUsers(Request $request){

        try{


        if($request->hasFile('photo')){
         $photo=   upload($request->photo);
        }

        $user=User::query()->where('email',$request->email)->first();

        if(!$user){
            return response()->json(["status" => 422, 'message' => 'الايميل غير موجود لدينا الرجاء تواصل مع الادارة']);


    }else{

        $user->update([
            'name'=>$request->name,
            'mobile'=>$request->mobile,
            'whatsapp'=>$request->whatsapp,
            // 'email'=>$request->email,
            'job'=>$request->job,
            'sallary'=>$request->sallary,
            'company_name'=>$request->company_name,
            'marital_status'=>$request->marital_status,
            'photo'=>$photo,
            'original_place'=>$request->original_place,
            'displacement_place'=>$request->displacement_place,

        ]);
    }

        return response()->json(["status" => 201, 'message' => 'تم تسجيل بالحاظنة بنجاح',]);
    } catch (\Exception $ex) {
        return response()->json(["status" => 422, 'message' => 'لم يتم التنفيد العملية بنجاح']);
    }


}

public function checkUsers(Request $request){
try{
    $user=User::query()->where('email',$request->email)->first();

    if(!$user){
        return response()->json(["status" => 422, 'message' => 'غير موجود في سجلتنا']);

    }
    return response()->json(["status" => 201, 'message' => 'تم التفيد بنجاح','data'=>$user]);
} catch (\Exception $ex) {
    return response()->json(["status" => 500, 'message' => 'لم يتم التنفيد العملية بنجاح']);
}
}




}
