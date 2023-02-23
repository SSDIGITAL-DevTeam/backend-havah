<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function(){
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/userList', [AdminController::class,'index'])->name('userList');

// Route::get('/userList', function(){
//     return view('admin.user.index');
// });