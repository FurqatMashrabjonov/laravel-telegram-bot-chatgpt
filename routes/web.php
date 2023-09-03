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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reply', function (){
//   $chat = \DefStudio\Telegraph\Models\TelegraphChat::query()->first();
   //forward message id is 436
//    $chat->copyMessage(config('telegraph.admin_chat_ids')[1], '')->send();
//    $chat->copyMessage(config('telegraph.admin_chat_ids')[2], '453')->send();
});
