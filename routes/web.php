<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//イベント作成
Route::get('/events/event/create', 'EventController@create')->middleware('auth');
Route::post('/events/event/create', 'EventController@store')->middleware('auth');

//イベント一覧
Route::get('/events', 'EventController@showEvents')->middleware('auth');
//イベント詳細
Route::get('/events/{id}', 'EventController@confirmEvent')->middleware('auth');

//イベント回答
Route::group(['prefix' => '/questions/{hashed_id}', 'as' => 'answer.'], function () {
    Route::get('/', 'AnswerController@showTop')->name('showTop');
    Route::post('/{current_q}', 'AnswerController@showQuestions')->name('showQuestions');
    Route::post('/answers/confirm', 'AnswerController@confirm')->name('confirm');
    Route::post('/answers/store', 'AnswerController@store')->name('store');
});
