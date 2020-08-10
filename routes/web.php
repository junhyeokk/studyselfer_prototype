<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'StudentController@selectSubject');
Route::get('/home', 'StudentController@selectSubject')->name('home');

Route::get('/select/{subject}', 'StudentController@selectTest');
Route::get('/solve/{subject}/{test}/{question}', 'StudentController@solveQuestion');    // 제거 요망
Route::get('/try_test/{subject}/{test}/{time}', 'StudentController@tryTest');
Route::post('/test_result/{subject}/{test}', 'StudentController@testResult');

Auth::routes();

Route::get('/register_question', 'RegisterQuestionController@index')->name('register_question');
Route::post('/upload_question', 'RegisterQuestionController@upload')->name('upload_question');
