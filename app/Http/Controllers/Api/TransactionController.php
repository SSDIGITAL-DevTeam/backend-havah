<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReimburseResource;
use App\Models\GroupChat;
use App\Models\HavahAdmin;
use App\Models\Member;
use App\Models\Reimburse;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class TransactionController extends ApiController
{

    // Menampilkan no rek perusahaan HAVAH BCA
    public function rekeningPerusahaan()
    {
      $havah = HavahAdmin::get('no_rekening');
      return response()->json($havah);
    }

    // Transfer to havah
    public function addFundHavah(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nominal' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors(),
                'success' => false
            ]);
        }

				$id_user = Auth::user()->id;
        $id_group = Member::where('id_user', $id_user)->first();
				$rekeningHavah = HavahAdmin::first();

				$transaction = Transaction::create([
						'id_group' => $id_group->id_group,
						'id_user' => $id_user,
						'nominal' => $request->nominal,
						'transfer_to' => $rekeningHavah->no_rekening,
				]);

				return response()->json([
					'message' => 'Sukses Melakukan Transfer ke Havah',
					'Data' => $transaction
				]);
    }

    // Get no rekening admin group
    public function addFundAdmin()
    {
      $id_user = Auth::user();
			$member = Member::where('id_user', $id_user->id)->first();
      $groupid = GroupChat::where('id', $member->id_group)->first();
      $adminId = User::where('id', $groupid->create_by)->first();

      return response()->json($adminId);
    }


    // Transfer to admin
    public function executeFundAdmin(Request $request)
    {
			$validator = Validator::make($request->all(),[
					'nominal' => 'required',
					'bukti_transaksi' => 'required|image|mimes:jpeg,jpg,png,gif,svg'
			]);

			if($validator->fails()){
					return response()->json([
							'message' => $validator->errors(),
							'success' => false
					]);
			}

      $id_user = Auth::user();
			$member = Member::where('id_user', $id_user->id)->first();
      $groupid = GroupChat::where('id', $member->id_group)->first();
      $adminId = User::where('id', $groupid->create_by)->first();

      // return response()->json($adminId);


      if($member->role_id === 1) {
        return response()->json([
          'message' => 'Transaksi tidak dapat di proses karena anda adalah seorang admin !'
        ]);
      }
      

			$bukti_transaksi = $request->file('bukti_transaksi');
			$fileName = hexdec(uniqid()).'.'.$bukti_transaksi->getClientOriginalExtension();
			Image::make($bukti_transaksi)->resize(720, 500)->save('images/transaksi/'.$fileName);
			
			// $path = 'images/'.$fileName;
			$path = $fileName;

			$transaction = Transaction::create([
					'id_group' => $member->id_group,
					'id_user' => $id_user->id,
					'nominal' => $request->nominal,
					'transfer_to' => $adminId->no_rekening,
					'bukti_transaksi' => $path
			]);

			return response()->json([
				'message' => 'Sukses Melakukan transfer ke Admin',
				'Data' => $transaction
			]);
    }

    public function reimburse(Request $request) {
      try {
        $user_auth   = Auth::user();
        $member_exist = Member::where('id_group',$request->group_id)->where('id', $request->transfer_destination)->first();
        // dd($member_exist);
        $group = GroupChat::where('id', $request->group_id)->first();
        $group_admin = $group->create_by;
        // dd($group_admin);
        
        if ($user_auth->id == $group_admin) {

          $validator = Validator::make($request->all(),[
              'approval_rate'         => 'required|integer',
              // 'transfer_destination'  => 'required|exists:members,id',
              'transfer_destination'  => ['required',Rule::exists('members', 'id')
              ->where('id_group',$request->group_id),
              ],
              'transfer_amount'       => 'required',
              'description'           => 'required',
              'approval_due_date'     => 'required',
              'group_id'              => 'required',
            ]);

          if($validator->fails()){
              return response()->json($validator->errors());       
          }

          $reimburse = Reimburse::create([
            'approval_rate'         => $request->approval_rate,
            'transfer_destination'  => $member_exist->id_user,
            'transfer_amount'       => $request->transfer_amount,
            'description'           => $request->description,
            'approval_due_date'     => $request->approval_due_date,
            'group_id'              => $request->group_id,
        ]);

        return $this->respondSuccess('Succed', new ReimburseResource($reimburse));


        }
        else {
          return $this->respondInternalError('Kamu Bukan Admin');
        }
      } catch (\Throwable $th) {
        return $this->respondInternalError($th->getMessage());
      }

      
    }




}
