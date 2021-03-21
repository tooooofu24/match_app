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

use App\Http\Controllers\EventController;
use App\Http\Controllers\ResultController;
use Dotenv\Regex\Result;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//テスト用--------------------------------------------------------------------------------------------------
Route::get('/test', 'EventController@test');

//イベント（要ログイン）---------------------------------------------------------------------------------------
Route::group(['prefix' => '/events', 'as' => 'event.', 'middleware' => ['auth']], function () {
    //イベント一覧
    Route::get('/', 'EventController@showEvents')->name('show');
    //イベント作成
    Route::get('/event/create', 'EventController@create')->name('create');
    Route::post('/event/create', 'EventController@store')->name('store');
    //イベント詳細
    Route::get('/{id}', 'EventController@confirmEvent')->name('confirm');
    //イベントのマッチ結果の出力
    Route::get('/{id}/getResult', 'EventController@getResult')->name('getResult');
});





//回答（ログイン不要部分）-------------------------------------------------------------------------------------
Route::group(['prefix' => '/questions/{hashed_id}', 'as' => 'answer.'], function () {
    Route::get('/', 'AnswerController@showTop')->name('showTop');
    Route::post('/{current_page}', 'AnswerController@showQuestions')->name('showQuestions');
    //回答の保存
    Route::post('/answers/confirm', 'AnswerController@confirm')->name('confirm');
    Route::post('/answers/store', 'AnswerController@store')->name('store');
    //マッチの結果
    Route::get('/results/show', 'AnswerController@showAllResults')->name('showAllResults');
    Route::get('/results/show/{id}', 'AnswerController@showPersonalResults')->name('showPersonalResults');
});
