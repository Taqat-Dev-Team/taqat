<?php

namespace App\Http\Controllers\Front\Offers;

use App\Http\Controllers\Controller;
use App\Models\CompanyProject;
use App\Models\Offer;
use App\Models\Project;
use App\Notifications\ApplyOfferToProjectNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Stichoza\GoogleTranslate\GoogleTranslate;

class OffersController extends Controller
{

    public function store(Request $request){




        $offer=  Offer::query()->where('user_id',auth()->id())->where('project_id',$request->project_id)->first();


//        $project=$offer->project;
//         if(!$offer){
     $offer=   Offer::query()->updateOrCreate([
            'user_id'=>auth()->id(),
         'project_id'=>$request->project_id,

     ],[
            'cost'=>$request->cost,
            'duration'=>$request->duration,
            'description'=>$request->description,
        ]);
//        dd('asas');

    // }

//        $project=CompanyProject::query()->findOrFail($request->project_id);
//    Notification::send($project->Company, new ApplyOfferToProjectNotification($offer));

        return response_web(true, 'تم تنفيد العملية بنجاح', [], 201);

    }
}
