<?php

namespace App\Http\Controllers\Front\MyProjects;

use App\Http\Controllers\Controller;
use App\Models\CompanyProject;
use Illuminate\Http\Request;

class MyProjectController extends Controller
{
    public function index($slug){



       $data['projects'] = CompanyProject::query()

        ->where('user_id',auth()->id())
            ->when($slug=='pennding',function ($q)use($slug)
            {

$q->where('status',1);
            })

            ->when($slug=='processing',function ($q)use($slug)
            {
$q->where('status',2);
            })


            ->when($slug=='completed',function ($q)use($slug)
            {
$q->where('status',3);
            })


            ->when($slug=='reject',function ($q)use($slug)
            {
$q->where('status',4);
            })


            ->when($slug=='ratting',function ($q)use($slug)
            {
$q->where('status',3)->wherehas('userRattings');
            })


            ->when($slug=='not-ratting',function ($q)use($slug)
            {
$q->where('status',3)->doesntHave('userRattings');
            })
                        ->orderby('created_at', 'desc')
            ->paginate(10);

        foreach ($data['projects'] as $item) {
            $item->short_description = getMaxWords($item->description, 40);
        }

        return view('front.myProjects.index',$data);
    }

    public function view($id){
        $data['project']=CompanyProject::query()->findOrFail($id);
        return view('front.myProjects.view',$data);


    }
}
