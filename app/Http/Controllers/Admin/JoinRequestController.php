<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JoinRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class JoinRequestController extends Controller
{
    public function index(){
        return view('admin.joinRequests.index');
    }

    public function getIndex(Request $request){
        $data = JoinRequest::query()
        ->orderBy('id', 'desc');
    return DataTables::of($data)




    ->addColumn('photo', function ($data) {
        return '<img src="'.$data->getPhoto().'" class="circle" style="object-fit:contain;width:70px;height:70px;border-radius: 50%;">';

    })

        ->addColumn('action', function ($data) {
            $button = '';


            $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

            $button .= '<a  data-join_request-id="' . $data->id . '"  class="add_users "><span><i  style="color: green" class="fa fa-plus"></i></span></button>';

            $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';



            $button .= '<a href="' . route('admin.joinRequests.edit', $data->id) . '"><span><i style="color:bule" class="fas fa-edit"></i></span></a>';

            $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

            $button .= '<a  id="' . $data->id . '" name_delete="' . $data->name . '" class="delete "><span><i  style="color: red" class="fa fa-trash"></i></span></button>';




            return $button;

        })->rawColumns(['action','photo'])
        ->make(true);
    }

    public function edit($id){

        $data['joinRequest']=JoinRequest::query()->findOrFail($id);
        return view('admin.joinRequests.edit',$data);
    }
    public function update(Request $request){


        $joinRequest=JoinRequest::query()->where('id',$request->join_request_id)->first();
        $joinRequest->update([
'name'=>$request->name,
'whatsapp'=>$request->whatsapp,
'email'=>$request->email,
'phone'=>$request->phone,
'old_city'=>$request->old_city,
'current_city'=>$request->current_city,
'job'=>$request->job,


]);
        return response_web(true,'نجاح العملية',[],201);

    }

 public function delete(Request $request){

    JoinRequest::query()->where('id',$request->id)->delete();

    return response_web(true,'نجاح العملية',[],201);
 }


 public function acceptAll(Request $request){



    $joinRequests=JoinRequest::query()->get();

    foreach( $joinRequests as $value){
        User::create([
            'name'=>$value->name,
            'mobile'=>$value->phone,
            'whatsapp'=>$value->whatsapp,
            'email'=>$value->email,
            'job'=>$value->job,
            'displacement_place'=>$value->current_city,
            'original_place'=>$value->old_city,
            'status'=>3,
            'photo'=>$value->photo,
            'password'=>Hash::make('123456'),
            ]);
    }
    $joinRequests=JoinRequest::query()->delete();

    return response_web(true,'نجاح العملية',[],201);

}



}
