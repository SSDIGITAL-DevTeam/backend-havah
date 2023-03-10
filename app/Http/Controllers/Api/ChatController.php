<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\GroupChat;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function index() 
    {      
        
        $message = DB::table('users')
                ->join('chats', 'users.id', '=', 'chats.id_user')
                ->join('group_chats', 'group_chats.id', '=', 'chats.id_group')
                ->select('chats.id_group','group_chats.name_group', 'chats.id_user', 'users.name', 'chats.message')
                ->get();

        // $message = Chat::select('id_user','id_group', 'message')->get();
        return response()->json($message);
    }

    public function message(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'message' => 'required|string' ,
            'id_group' => 'required'
        ]);
        
        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors(),
                'success' => false
            ]);
        }
        
        $user_id = Auth::user()->id;
        // $member = Member::where('id_user', $user_id)->first();
        // return response()->json([
        //     'group_id' => $member->id_group,
        //     'id_user' => $user_id
        // ]);

        $chatMessage = Chat::create([
            'id_group' => $request->id_group,
            'id_user' => $user_id,
            'message' => $request->message
        ]);

        return response()->json([
            'message' => 'Sukses mengirim pesan',
            'data' => $chatMessage
        ]);



        


    }


}
