<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupchatRequest;
use App\Models\GroupChat;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Js;

class GroupchatController extends Controller
{
    /**
     * Get All group
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = GroupChat::all();
        return response()->json([
            'message' => 'Success get all group chat',
            'data' => $group
        ]);
    }

    /**
     * Create new group chat
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
                ->where('id_group', '=', $id)
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
            'phone_number' => 'required' 
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
            'Message' => 'Nomor yang anda masukkan belum terdaftar!',
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
            'id_group' => $id_group->id,
            'id_user' => $user->id
          ]);

          return response()->json([
            'message' => "Sukses Mengundang Teman",
            'data' => $phone_number
          ]);
        }
  
    }

}
