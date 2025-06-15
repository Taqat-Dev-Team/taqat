<?php

namespace App\Http\Controllers\Companies\Comments;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Comment;
use App\Models\Offer;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Pusher\Pusher;

class CommentsController extends Controller
{

    public function view($key=null)
    {

          $data['chats'] = Chat::query()->where('company_id', auth()->id())->orderby('id','desc')->get();
          $chat=Chat::query()->where('key',$key)->first();

          if($chat){
        $data['offer']=Offer::query()->where('project_id',$chat->project_id)->where('user_id',$chat->user_id)->first();
          }else{
            $data['offer']=null;
          }
        $data['chat']=$chat;
        return view('companies.chats.index', $data);
    }





    public function store(Request $request){
     $key_chat=null;


     if($request->job_id){

        $key_chat.='job-'.$request->job_id;
        }

        if($request->project_id){
            $key_chat.='project-'.$request->project_id;

        }




        // dd($key_chat);
        $key=$key_chat.'-'.auth('company')->id() .'-'.$request->user_id ;

        $chat=Chat::query()->where('key',$key)

        ->where('company_id',auth('company')->id())->first();

        if($chat){
            $respnse['data']=route('companies.chats.view',$chat->key);
            return response_web(true,'تم تنفيد العملية بنجاح',$respnse,201);
        }

    $chat=Chat::query()->create([
            'user_id'=>$request->user_id,
            'key'=>$key,
            'project_id'=>$request->project_id,
            'job_id'=>$request->job_id,
            'company_id'=>auth('company')->id(),
            // ''
                ]);
        $respnse['data']=route('companies.chats.view',$chat->key);
        return response_web(true,'تم تنفيد العملية بنجاح',$respnse,201);

    }

    public function getData(Request $request)
    {


        $chat = Chat::query()->where('key',$request->chat_key)->first();

        $chat->update([
            'company_read'=>1,
        ]);
        $html = '';
        foreach($chat->comments as $value){

      if($value->company_id==auth('company')->id()){
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

public function saveMessage(Request $request)
{
    // Find the chat by key
    $chat = Chat::where('key', $request->chat_key)->first();

    if (!$chat) {
        return response_web(false, 'Chat not found', [], 404);
    }

    // Update the chat's user_read status
    $chat->update(['user_read' => null]);

    // Create a new comment
    $comment = Comment::create([
        'chat_id' => $chat->id,
        'company_id' => auth('company')->id(),
        'message' => $request->message,
        'project_id' => $chat->project_id,
    ]);

    // Send notifications to users
//    Notification::send($chat->users, new NewMessageNotification($comment, $request->message));

    // Count the number of unread chats for the user
//    $count_not_read = Chat::where('user_id', $chat->user_id)->whereNull('user_read')->count();
//    broadcast(new MessageSent($count_not_read, $chat->id))->toOthers();

    // Return success response
    return response_web(true, 'Operation completed successfully', ['data' => null], 201);
}
}
