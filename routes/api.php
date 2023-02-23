<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\GroupchatController;
use App\Http\Controllers\api\MemberController;
use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Authentication
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/AllUser', [UserController::class, 'index'])->name('allUser');

// Ambil semua grup yang sudah dibuat
Route::get('/groupChat', [GroupchatController::class, 'index'])->name('groupChat');

// Mengambil semua member grup pada id tertentu
Route::get('/getMember/{id}', [GroupchatController::class, 'show'])->name('getMember');

// Edit Profile
Route::post('/editDataUser/{id}', [UserController::class, 'editDataUser'])->name('editUser');
Route::post('/editProfileImage/{id}', [UserController::class, 'editProfileImage'])->name('editImageProfile');
Route::post('/registerBank/{id}', [UserController::class, 'registerBankAccount'])->name('registerBank');
Route::post('/idCardBank/{id}', [UserController::class, 'IdCardBank'])->name('createIdCard');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function(Request $request){
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/getBankAccount', [UserController::class, 'getBankAccount'])->name('getBankAccount');
    Route::post('/createGroupChat', [GroupchatController::class, 'store'])->name('createChat');
    Route::post('/invite', [GroupchatController::class, 'invite'])->name('invite');
});




