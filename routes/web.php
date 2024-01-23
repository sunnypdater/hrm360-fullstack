<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('v1', function () {
    return response()->json(['message' => 'Post request successful']);
});
Route::post('v1/register',[UserAuthController::class,'register']);
Route::post('v1/login',[UserAuthController::class,'login']);
Route::post('v1/logout',[UserAuthController::class,'logout'])
  ->middleware('auth:sanctum');


Route::get('{any?}', function() {
    return view('application');
})->where('any', '.*');