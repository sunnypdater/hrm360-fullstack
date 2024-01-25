<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\EmployeeController;

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

Route::group(['prefix'=>'v1'], function(){
  Route::get('/', function () {
      return response()->json(['message' => 'Post request successful']);
  });
  Route::post('/register',[UserAuthController::class,'register']);
  Route::post('/login',[UserAuthController::class,'login']);
  Route::post('/logout',[UserAuthController::class,'logout'])
    ->middleware('auth:sanctum');

  Route::group(['prefix'=>'employee'], function(){
    Route::get('/', [EmployeeController::class, 'index']);
    Route::post('/', [EmployeeController::class, 'create']);
    Route::get('/{employee}', [EmployeeController::class, 'show']);
    Route::put('/{employee}', [EmployeeController::class, 'edit']);
    Route::delete('/{employee}', [EmployeeController::class, 'destroy']);
  });
});

Route::get('{any?}', function() {
    return view('application');
})->where('any', '.*');