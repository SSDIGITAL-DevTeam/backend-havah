<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\GroupChat;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GroupchatController extends Controller
{
    /**
     * Get All group
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $id_user = Auth::user()->id;
        $group = DB::table('members')
        ->join('users', 'members.id_user', '=', 'users.id')
        ->join('group_chats', 'members.id_group', '=', 'group_chats.id')
        ->select('group_chats.id', 'group_chats.create_by', 'group_chats.name_group', 'members.role_id')
        ->where('members.id_user', '=', $id_user)
        ->get();
        
        return response()->json([
            'message' => 'Success get all group chat',
            'data' => $group,
        ]);
    }

    /**
     * Create new group chat
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createGroup(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name_group' => 'required' 
        ]);
        
        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors(),
                'success' => false
            ]);
        }
        
        $userId = Auth::user()->id;
        
        $groupChat = GroupChat::create([
            'create_by' => $userId,
            'name_group' => $request->name_group
        ]);

        $member = Member::Create([
            'id_group' => $groupChat->id,
            'id_user' => $userId,
            'role_id' => true
        ]);

        return response()->json([
            'Message' => "Success Membuat Group Chat",
            'Data' => $groupChat,
            'members' => $member
        ]);
    }

    // Get member group by id
    public function show($id)
    {   
        $member = DB::table('users')
                ->join('members', 'id_user', '=', 'users.id')
                ->select('id_user', 'name', 'email', 'phone_number')
                ->where('members.id_group', '=', $id)
                ->get();
        return response()->json([
            'Message' => 'Semua Member pada id '. $id,
            'Member' => $member
        ]);   
    }


    // Invite friend to group chat
    public function invite(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'phone_number' => 'required',
            'id_group' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors(),
                'success' => false
            ]);
        }
        
        $id = Auth::user()->id;        
        $id_group = GroupChat::where('create_by', $id)->first();
        $user = User::where('phone_number', $request->phone_number)->first();

        if ($user === null) {
          return response()->json([
            'message' => 'Nomor yang anda masukkan belum terdaftar!',
          ]);
        }

        if($id_group === null){
            return response()->json([
                'message' => 'Anda bukan seorang admin!'
            ]);
        }

        $checkGroup = Member::where([
          ['id_group','=' ,$id_group->id],
          ['id_user', '=' ,$user->id]
        ])->count() > 0;

        if ($checkGroup === true) {
            return response()->json([
                'message' => 'Nomor yang anda masukkan sudah di grup' 
            ]);
        }else{
          $phone_number = Member::create([
            'id_group' => $request->id_group,
            'id_user' => $user->id
          ]);

          return response()->json([
            'message' => "Sukses Mengundang Teman",
            'data' => $phone_number
          ]);
        }
  
    }

}
