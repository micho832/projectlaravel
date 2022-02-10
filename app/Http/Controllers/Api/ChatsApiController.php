<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatsApiController extends Controller
{
    public function getChats(Request $request)
    {
        $apiToken = $request->get('api_token');

        $rules = [
            'api_token' => 'required|max:125',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $reply = [
                'failed' => true,
                'errors' => $validator->errors()->toArray(),
                'data' => null,
            ];
            return response()->json($reply);
        }

        $user = User::where('api_token', '=', $apiToken)->first();

        if ($user) {
            // CHATs
            $data = [];

            $sentMessages = $user->sentMessages;
            $sendUserIDs = $sentMessages->pluck('second_user_id')->unique()->toArray();
            $sendUsers = User::find($sendUserIDs);
            foreach ($sendUsers as $sendUser) {
                $lastMessage = Chat::where('first_user_id', '=', $user->id)
                    ->where('second_user_id', '=', $sendUser->id)
                    ->orderBy('created_at', 'DESC')->first();

                array_push($data, [
                    "uID" => $sendUser->id,
                    "fullName" => $sendUser->first_name . " " . $sendUser->last_name,
                    "imageUrl" => $sendUser->image->path,
                    "lastMsgContent" => $lastMessage->message,
                    "lastMsgIsSeen" => $lastMessage->is_seen,
                    "lastMsgIsForward" => $lastMessage->is_forward,
                    "lastMsgTimestamp" => $lastMessage->created_at,
                ]);
            }

            $recMessages = $user->receivedMessages;
            $recUserIDs = $recMessages->pluck('first_user_id')->unique()->toArray();
            $recUsers = User::find($recUserIDs);
            foreach ($recUsers as $recUser) {
                $lastMessage = Chat::where('second_user_id', '=', $user->id)
                    ->where('first_user_id', '=', $recUser->id)
                    ->orderBy('created_at', 'DESC')->first();

                array_push($data, [
                    "uID" => $recUser->id,
                    "fullName" => $recUser->first_name . " " . $recUser->last_name,
                    "imageUrl" => $recUser->image->path,
                    "lastMsgContent" => $lastMessage->message,
                    "lastMsgIsSeen" => $lastMessage->is_seen,
                    "lastMsgIsForward" => $lastMessage->is_forward,
                    "lastMsgTimestamp" => $lastMessage->created_at,
                ]);
            }

            $reply = [
                'failed' => false,
                'errors' => null,
                'data' => $data,
            ];
            return response()->json($reply);

        } else {
            $reply = [
                'failed' => true,
                'errors' => ['Wrong API token.'],
                'data' => null,
            ];
            return response()->json($reply);
        }
    }

    public function getMessages(Request $request , $uid){
        $apiToken = $request->get('api_token');

        $rules = [
            'api_token' => 'required|max:125',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $reply = [
                'failed' => true,
                'errors' => $validator->errors()->toArray(),
                'data' => null,
            ];
            return response()->json($reply);
        }

        $user = User::where('api_token', '=', $apiToken)->first();

        if ($user) {
            // CHATs
            $messages=Chat::where(function ($query) use ($user,$uid){
                $query->where('first_user_id',$user->id)->where('second_user_id',$uid);

            })->orWhere(function ($query) use($user,$uid){
                $query->where('second_user_id',$user->id)->where('first_user_id',$uid);
            })->orderBy('created_at','DESC')->get();
            $reply = [
                'failed' => false,
                'errors' => [''],
                'data' => $messages,
            ];
            return response()->json($reply);


        } else {
            $reply = [
                'failed' => true,
                'errors' => ['Wrong API token.'],
                'data' => null,
            ];
            return response()->json($reply);
        }
    }

    public function sendMessages(Request $request,$uid){
        $apiToken = $request->get('api_token');

        $rules = [
            'api_token' => 'required|max:125',
            //'message'=>'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $reply = [
                'failed' => true,
                'errors' => $validator->errors()->toArray(),
                'data' => null,
            ];
            return response()->json($reply);
        }

        $user = User::where('api_token', '=', $apiToken)->first();
        if($user){
            $newMessage=new Chat();
            $newMessage->first_user_id=$user->id;
            $newMessage->second_user_id=$uid;
            $newMessage->is_seen=false;
            $newMessage->is_forward=false;
            $newMessage->message=$request->get('message');
            $newMessage->save();

            $reply = [
                'failed' => false,
                'errors' => null,
                'data' => $newMessage,
            ];
            return response()->json($reply);
        }else{
            $reply = [
                'failed' => true,
                'errors' => ['wrong api token'],
                'data' => null,
            ];
            return response()->json($reply);
        }


    }
}
