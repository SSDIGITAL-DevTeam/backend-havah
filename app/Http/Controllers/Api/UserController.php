<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function index()
    {
        $user = User::all();
        return response()->json([
            'message' => 'Sukses Menampilkan semua data',
            'data' => $user
        ]);  
    }

    public function editProfileImage(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg' 
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors(),
                'success' => false
            ]);
        }

		$image = $request->file('image');
		$fileName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
		Image::make($image)->resize(720, 500)->save('images/'.$fileName);

		// $path = 'images/'.$fileName;
		$path = $fileName;
        
        $user = User::find($id);
        $user->update([
            'image' => $path
        ]);

        return response()->json([
            'message' => 'Success Ubah Gambar',
            'data' => $user
        ]);
    }

    public function editDataUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'birth' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
        ]);
        
        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors(),
                'success' => false
            ]);
        }
        
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'birth' => $request->birth,
            'phone_number' => $request->phone_number,
            'email' => $request->email
        ]);

        return response()->json([
            'Data' => $user,
            'message' => "Success mengubah data",
            'success' => true
        ]);
    }

    public function registerBankAccount(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'bank_name' => 'required',
            'no_rekening' => 'required',
            'name_account' => 'required',     
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors(),
                'success' => false
            ]);
        }
        
        $user = User::find($id);
        $user->update([
            'bank_name' => $request->bank_name,
            'no_rekening' => $request->no_rekening,
            'name_account' => $request->name_account,
        ]);

        return response()->json([
            'Data' => $user,
            'message' => "Success menambahkan data Bank",
            'success' => true
        ]);
    }

    public function IdCardBank(Request $request, $id){
        
        $validator = Validator::make($request->all(),[
            'id_card' => 'required|image|mimes:jpeg,jpg,png,gif,svg',
            'selfie' => 'required|image|mimes:jpeg,jpg,png,gif,svg'   
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors(),
                'success' => false
            ]);
        }

        $idCard = $request->file('id_card');
		$idCardName = hexdec(uniqid()).'.'.$idCard->getClientOriginalExtension();
		Image::make($idCard)->resize(720, 500)->save('images/id_card/'.$idCardName);

        $selfie = $request->file('selfie');
        $selfieName = hexdec(uniqid()).'.'.$idCard->getClientOriginalExtension();
        Image::make($selfie)->resize(550, 720)->save('images/selfie/'.$selfieName);

        
		// $selfiePath = 'images/selfie/'.$selfieName;
		$selfiePath = $selfieName;
		// $cardIdPath = 'images/id_card/'.$idCardName;
		$cardIdPath = $idCardName;
        
        $user = User::find($id);
        $user->update([
            'id_card' => $cardIdPath,
            'selfie' => $selfiePath
        ]);

        return response()->json([
            'message' => 'Sukses menambahkan Id Card',
            'data' => $user
        ]);
    }


    public function getBankAccount($id)
    {
        {
            $user = User::select('bank_name','no_rekening','name_account')->get($id);
            return response()->json([
                'message' => 'Success Menampilkan Data Bank User',
                'data' => $user
            ]);  
        }
    }

}


