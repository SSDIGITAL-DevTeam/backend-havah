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

    public function show($id)
    {
        $user = User::find($id);
        return response()->json([
            'message' => 'Success menampilkan data',
            'data' => $user
        ]);  
    }

    public function editProfileImage(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'image' => 'required|image|mimes:jpeg,png,gif,svg' 
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors(),
                'success' => false
            ]);
        }

		$image = $request->file('image');
		$generate_id = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
		Image::make($image)->resize(720, 500)->save('images/'.$generate_id);

		$last_img = 'images/'.$generate_id;
        
        $user = User::find($id);
        $user->update([
            'image' => $last_img
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


}


