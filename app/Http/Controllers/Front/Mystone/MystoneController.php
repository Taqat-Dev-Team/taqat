<?php

namespace App\Http\Controllers\Front\Mystone;

use App\Http\Controllers\Controller;
use App\Models\CompanyProject;
use App\Models\MyStone;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
// use Yajra\DataTables\Html\Button;

class MystoneController extends Controller
{
    public function index()
    {
    $mystone=MyStone::query()
        ->whereHas('project')
        ->where('user_id', auth()->id());
        $data['mystone_count']=$mystone->count();
        $data['mystone_amount']=$mystone->sum('amount');
        $data['mystone_payment']=$mystone->wherestatus(2)->count();
         $data['mystone_no_payment']=$mystone->wherestatus(1)->sum('amount');
         return view('front.mystones.index',$data);
    }
//IPv4: ? 213.6.253.43
    public function getIndex(Request $request){

        $data = MyStone::query()
            ->wherehas('project')

            ->orderby('id','desc')
        ->with('project')
        ->where('user_id', auth()->id());
        return DataTables::of($data)
        ->addColumn('status', function ($data) {
            return $data->getStatus();
        })



        ->addColumn('project_title', function ($data) {
            return '<a href="'.route('companies.projects.views',$data->project_id).'">'. $data->project->title.'</a>';

        })

        ->addColumn('action',function($data){

            if($data->status==2||$data->status==5){
       return     '<button class="btn btn-success withdraw" data-my_stone_id="'.$data->id.'">طلب سحب </button>';
            }



        })

        ->rawColumns(['project_title', 'action','status'])
        ->make(true);



    }

    public function store(Request $request){
        $project = CompanyProject::query()->findOrFail($request->project_id);
      $mystone=  MyStone::query()->create([
        'order_number'=>get_order_number(),
            'project_id'=>$project->id,
            'user_id'=>$project->user_id,
            'company_id'=>$project->company_id,
            'title'=>$request->title,
            'amount'=>$request->amount,
            'date'=>Carbon::parse($request->date)->format('Y-m-d'),
            'status'=>1,
        ]);

        $response['data']=$mystone;
        return response_web(true, __('label.success_full_process'), $response, 201);

    }
    public function withdraws(Request $request){

   $mystone=     MyStone::query()->where('id',$request->my_stone_id)->first();
        $withdraw=Withdraw::query()->where('my_stone_id',$mystone->my_stone_id)->first();
        if($withdraw){
            $response['data']=null;
            return response_web(false, __('label.success_full_process'), $response, 422);

    }

    $mystone->update([
        'status'=>3
    ]);

    Withdraw::query()->create([
        'withdraw_transaction'=>get_order_number(),
        'my_stone_id'=>$request->my_stone_id,
        'bank_name'=>$request->bank_name,
        'amount'=>$mystone->amount,
        'iban'=>$request->iban,
        'mobile'=>$request->mobile,
        'name'=>$request->name,
        'user_id'=>auth()->id(),
        'account_number'=>$request->account_number,
    ]);



        $response['data']=null;
        return response_web(true, __('label.success_full_process'), $response, 201);

    }


}
