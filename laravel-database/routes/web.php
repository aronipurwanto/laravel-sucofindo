<?php

use Illuminate\Support\Facades\Route;

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

/**
Route::get('/', function () {
    return view('welcome');
});
 */
Route::get('/', [\App\Http\Controllers\HomeController::class,'home']);

Route::get('/template',function (){
    return view('template');
});

/**
Route::get('/login',[\App\Http\Controllers\UserController::class,'login']);
Route::post('/login',[\App\Http\Controllers\UserController::class,'doLogin']);
Route::post('/login',[\App\Http\Controllers\UserController::class,'logout']);
 */

Route::controller(\App\Http\Controllers\UserController::class)
    ->group(function (){
        Route::get('/login','login')->middleware([\App\Http\Middleware\GuestMiddleware::class]);
        Route::post('/login','doLogin')->middleware([\App\Http\Middleware\GuestMiddleware::class]);
        Route::post('/logout','logout')->middleware([\App\Http\Middleware\MemberMiddleware::class]);
    });

Route::controller(\App\Http\Controllers\TodolistController::class)
    ->middleware([\App\Http\Middleware\MemberMiddleware::class])
    ->group(function (){
        Route::get('/todolist','getTodo');
        Route::post('/todolist','addTodo');
        Route::post('/todolist/{id}/delete','removeTodo');
    });
