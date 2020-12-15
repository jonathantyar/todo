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
//Filter task by its state
Route::get('/tasks/state/{state}',[TaskController::class,'filterByState']);
//Update State of tasks
Route::put('/tasks/update/state',[TaskController::class,'updateState']);
//Section with task
Route::get('/sections/{id}/with-tasks',[SectionController::class,'showWithTasks']);
//CUD TASK
Route::delete('/tasks/delete',[TaskController::class,'delete']);
Route::put('/tasks/update',[TaskController::class,'update']);
Route::post('/tasks',[TaskController::class,'store']);
//CRUD SECTION
Route::delete('/sections/delete',[SectionController::class,'delete']);
Route::put('/sections/update',[SectionController::class,'update']);
Route::get('/sections/{id}',[SectionController::class,'show']);
Route::post('/sections',[SectionController::class,'store']);
Route::get('/sections',[SectionController::class,'index']);
