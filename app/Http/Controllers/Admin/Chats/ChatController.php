<?php

namespace App\Http\Controllers\Admin\Chats;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Offer;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function view($key=null)
    {
        // dd($key);

          $data['chats'] = Chat::query()->orderby('id','desc')->get();
          $chat=Chat::query()->where('key',$key)->first();

          if($chat){
        $data['offer']=Offer::query()->where('project_id',$chat->project_id)->where('user_id',$chat->user_id)->first();
          }else{
            $data['offer']=null;
          }
        $data['chat']=$chat;
        return view('admin.chats.index', $data);
    }





    public function getData(Request $request)
    {


        $chat = Chat::query()->where('key',$request->chat_key)->first();

        $chat->update([
            'company_read'=>1,
        ]);
        $html = '';
        foreach($chat->comments as $value){

      if($value->company_id){
            $html .='<div class="d-flex flex-column mb-5 align-items-start">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-circle symbol-40 mr-3">
                    <img alt="Pic" src="'.$chat->company->getPhoto().'" />
                </div>
                <div>
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">'.$chat->company->name.'</a>
                </div>
            </div>
            <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">'.$value->message.'</div>
               </div>';

      }else{




               $html .='<div class="d-flex flex-column mb-5 align-items-end">
            <div class="d-flex align-items-center">
                <div>
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">'.$chat->users->name.'</a>
                </div>
                <div class="symbol symbol-circle symbol-40 ml-3">
                    <img alt="Pic" src="'.$chat->users->getPhoto().'" />
                </div>
            </div>
            <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">'
.$value->message.
            '</div>

            </div>
            ';
      }
        }
      $response['data'] = $html;
        return response_web(true, 'تم تفنيد العملية بنجاح', $response, 201);

}



}
