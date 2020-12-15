<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SectionController;
use App\Http\Controllers\TaskController;

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
Route::get('/sections/{id}/with-tasks',[SectionController::class,'showWithTasks']);

Route::delete('/tasks/delete',[TaskController::class,'delete']);
Route::put('/tasks/update',[TaskController::class,'update']);
Route::post('/tasks',[TaskController::class,'store']);

Route::delete('/sections/delete',[SectionController::class,'delete']);
Route::put('/sections/update',[SectionController::class,'update']);
Route::get('/sections/{id}',[SectionController::class,'show']);
Route::post('/sections',[SectionController::class,'store']);
Route::get('/sections',[SectionController::class,'index']);
