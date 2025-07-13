<?php
use App\Http\Controllers\API\APITaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks',function(){
    return view('task.index');
});