<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);

    Route::post('add-user',[App\Http\Controllers\Modules\UserController::class,'store']);
    Route::put('edit-user/{id}',[App\Http\Controllers\Modules\UserController::class,'update']);
    Route::delete('delete-user/{id}',[App\Http\Controllers\Modules\UserController::class,'destroy']);
    Route::get('all-user',[App\Http\Controllers\Modules\UserController::class,'index']);
    Route::get('show-user/{id}',[App\Http\Controllers\Modules\UserController::class,'show']);
});

Route::get('all-company',[App\Http\Controllers\Modules\CompanyController::class,'index']);
Route::get('show-company/{id}',[App\Http\Controllers\Modules\CompanyController::class,'show']);
Route::post('add-company',[App\Http\Controllers\Modules\CompanyController::class,'store']);
Route::put('edit-company/{id}',[App\Http\Controllers\Modules\CompanyController::class,'update']);
Route::delete('delete-company/{id}',[App\Http\Controllers\Modules\CompanyController::class,'destroy']);

Route::get('all-employee',[App\Http\Controllers\Modules\EmployeeController::class,'index']);
Route::get('show-employee/{id}',[App\Http\Controllers\Modules\EmployeeController::class,'show']);
Route::post('add-employee',[App\Http\Controllers\Modules\EmployeeController::class,'store']);
Route::put('edit-employee/{id}',[App\Http\Controllers\Modules\EmployeeController::class,'update']);
Route::delete('delete-employee/{id}',[App\Http\Controllers\Modules\EmployeeController::class,'destroy']);






