<?php

namespace App\Http\Controllers\Front\Withdraws;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WithdrawsController extends Controller
{
    public function index(){

        $data['withdraws_count']=Withdraw::query()->where('user_id',auth()->id())->count();
        $data['total_withdraws']=Withdraw::query()->where('user_id',auth()->id())->sum('amount');
        $data['count_withdraws']=Withdraw::query()->where('user_id',auth()->id())->sum('amount');
        $data['paid_withdraws']=Withdraw::query()->where('user_id',auth()->id())->where('status',2)->sum('amount');
        $data['not_paid_withdraws']=Withdraw::query()->where('user_id',auth()->id())->where('status',1)->sum('amount');

        return view('front.withdraws.index',$data);
    }


    public function getIndex(Request $request){

        $data=Withdraw::query()->where('user_id',auth()->id());
        return DataTables::of($data)
        ->addColumn('photo', function ($data) {
            $attachments = $data->getAttachment();
            $extension = pathinfo($attachments, PATHINFO_EXTENSION);

            if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                return '<a href="' . $attachments . '" target="_blank"><img src="' . $attachments . '" class="" style="object-fit:contain;width:70px;height:70px;border-radius:50%;" alt=""></a>';
            }

            if ($extension === 'pdf') {
                return '<a href="' . $attachments . '" target="_blank"><i class="fa fa-file-pdf" style="width:70px;height:70px;border-radius:50%;font-size:70px;color:red;"></i></a>';
            }

            return '<img src="' . asset('assets/default.png') . '" class="" style="object-fit:contain;width:70px;height:70px;border-radius:50%;" alt="">';
        })

        ->addColumn('status', fn($data) =>

        $data->getStatus()
        )


        ->addColumn('action', function ($data) {

            if($data->status==1){
            return '&nbsp;&nbsp;&nbsp;&nbsp;' .
                   '<a href="#" class="edit_withdraw" data-withdraw_id="'.$data->id.'"><i style="color:blue" class="fas fa-edit"></i></a>';

            }
                })
        ->rawColumns([ 'action', 'user_name','status','photo'])
        ->make(true);

    }
}
