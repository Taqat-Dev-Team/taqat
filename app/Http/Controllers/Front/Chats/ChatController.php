<?php

namespace App\Http\Controllers\Front\Chats;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Comment;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function view($key = null)
    {
        $data['chats'] = Chat::query()->orderby('id', 'desc')->where('user_id', auth()->id())->get();

        $data['chat'] = Chat::query()->where('key', $key)->first();

        return view('front.chats.index', $data);
    }





    public function store(Request $request)
    {

        $chat = Chat::query()->where('project_id', $request->project_id)
            ->where('user_id', $request->user_id)
            ->where('company_id', $request->company_id)->first();

        if ($chat) {
            $respnse['data'] = route('front.chats.view', $chat->key);
            return response_web(true, 'تم تنفيد العملية بنجاح', $respnse, 201);
        }
        $key = $request->project_id . '-' . $request->company_id . '-' . $request->user_id;
        $chat = Chat::query()->create([
            'user_id' => $request->user_id,
            'key' => $key,
            'project_id' => $request->project_id,
            'company_id' => $request->company_id
        ]);
        $respnse['data'] = route('front.chats.view', $chat->key);
        return response_web(true, 'تم تنفيد العملية بنجاح', $respnse, 201);
    }

    public function getData(Request $request)
    {


        $chat = Chat::query()->where('key', $request->chat_key)->first();
        $chat->update([
            'user_read' => 1,
        ]);
        $html = '';
        foreach ($chat->comments as $value) {

            if ($value->user_id == auth()->id()) {
                $html .= '<div class="d-flex flex-column mb-5 align-items-start">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-circle symbol-40 mr-3">
                    <img alt="Pic" src="' . $chat->users->getPhoto() . '" />
                </div>
                <div>
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">' . $chat->users->name . '</a>
                </div>
            </div>
            <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">' . $value->message . '</div>
               </div>';
            } else {




                $html .= '<div class="d-flex flex-column mb-5 align-items-end">
            <div class="d-flex align-items-center">
                <div>
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">' . $chat->company->name . '</a>
                </div>
                <div class="symbol symbol-circle symbol-40 ml-3">
                    <img alt="Pic" src="' . $chat->company->getPhoto() . '" />
                </div>
            </div>
            <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">'
                    . $value->message .
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

        $chat = Chat::query()->where('key', $request->chat_key)->first();

        $comment = Comment::query()->create([
            'chat_id' => $chat->id,
            'user_id' => auth()->id(),
            'message' => $request->message,
            'project_id' => $chat->project_id,

        ]);

        $response['data'] = null;;
        return response_web(true, 'تم تفنيد العملية بنجاح', $response, 201);
    }
}
