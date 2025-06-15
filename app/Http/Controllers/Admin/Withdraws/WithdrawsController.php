<?php

namespace App\Http\Controllers\Admin\Withdraws;

use App\Http\Controllers\Controller;
use App\Models\MyStone;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WithdrawsController extends Controller
{
    public function index(){

        $data['withdraws_count']=Withdraw::query()->count();
        $data['total_withdraws']=Withdraw::query()->sum('amount');
        $data['count_withdraws']=Withdraw::query()->sum('amount');
        $data['paid_withdraws']=Withdraw::query()->where('status',2)->sum('amount');
        $data['not_paid_withdraws']=Withdraw::query()->where('status',1)->sum('amount');

        return view('admin.withdraws.index',$data);
    }


    public function getIndex(Request $request){

        $data=Withdraw::query()->orderby('id','desc');
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
        ->addColumn('user_name', function ($data) {
            return '<a href='.route('admin.users.views',$data->user_id).' class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">' . $data->user->name . '</a>' .
                   '<div><a class="text-muted font-weight-bold text-hover-primary" href="#">' . $data->mobile ?? '-' . '</a></div>';
        })
        ->addColumn('account_number', fn($data) => $data->account_number)

        ->addColumn('message', fn($data) => $data->message)

        ->addColumn('iban', fn($data) => $data->iban)
        ->addColumn('bank_name', fn($data) => $data->bank_name)
        ->addColumn('status', fn($data) =>

        $data->getStatus()
        )


        ->addColumn('action', function ($data) {

            if($data->status==1){

                return view('admin.withdraws.partials.actions', compact('data'));
            }
                })
        ->rawColumns([ 'action', 'user_name','status','photo'])
        ->make(true);

    }

    public function update(Request $request){

        $withdraw=   Withdraw::query()->where('id',$request->withdraw_id)->first();

        $photo=null;

        if($request->photo){
         $photo=   upload($request->photo);
        }
        $withdraw->update([
            'status'=>$request->status,
            'message'=>$request->message,
            'photo'=>$photo,

        ]);

        MyStone::query()->where('id',$withdraw->my_stone_id)->update([
            'status'=>5
        ]);
        activity()
        ->performedOn($withdraw)
        ->causedBy(auth()->user()) // Ensure you have the correct user context
        ->withProperties([
            'old_status' => $withdraw->status,
            'new_status' => $request->status,
            'old_message' => $withdraw->message,
            'new_message' => $request->message,
            'old_photo' => $withdraw->photo,
            'new_photo' => $photo,
        ])
        ->log('Updated withdraw request');

        $response['data']=null;
        return response_web(true,__('label.successful_process'),$response,201);

    }
}
