<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Models\ApplyJob;
use App\Models\Offer;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $data['offers']=Offer::query()->wherehas('project',function($q){
            $q->where('company_id',auth('company')->id())->whereNull('deleted_at');;
        })->take(5)->get();
        $data['apply_Jobs']=ApplyJob::query()->wherehas('jobs',function($q){
            $q->where('company_id',auth('company')->id());
        })->take(5)->get();

        return view('companies.index',$data);
    }
}
