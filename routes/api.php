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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/allUser', [UserController::class, 'index']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Get all group chat
Route::get('/groupChat', [GroupchatController::class, 'index'])->name('groupChat');
// Get all member by id group
Route::get('/getMember/{id}', [GroupchatController::class, 'show'])->name('getMember');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/getBankAccount/{id}', [UserController::class, 'getBankAccount']);
    Route::post('/createGroupChat', [GroupchatController::class, 'store'])->name('createChat');
    Route::post('/invite', [GroupchatController::class, 'invite'])->name('invite');
});

// Edit Profile
Route::post('/editDataUser/{id}', [UserController::class, 'editDataUser']);
Route::post('/editProfileImage/{id}', [UserController::class, 'editProfileImage']);
Route::post('/registerBank/{id}', [UserController::class, 'registerBankAccount']);
Route::post('/idCardBank/{id}', [UserController::class, 'IdCardBank']);


