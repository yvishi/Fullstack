<?php

use App\Http\Controllers\API\APITaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('task',[App\Http\Controllers\API\APITaskController::class,'create']);
Route::get('task',[APITaskController::class,'getAll']);
Route::get('task/{id}',[APITaskController::class,'getTaskById']);
Route::put('task/{id}',[APITaskController::class,'update']);
Route::post('task/done/{id}',[APITaskController::class,'markAsDone']);
Route::delete('task/{id}',[APITaskController::class,'delete']);
