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

Route::get('login/kakao', 'Auth\LoginController@redirectToProvider');
Route::get('login/kakao/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/select/{subject}', 'StudentController@selectTest');
Route::get('/solve/{subject}/{test}/{question}', 'StudentController@solveQuestion');    // 제거 요망
Route::get('/try_test/{subject}/{test}/{time}', 'StudentController@tryTest');
Route::post('/test_result/{subject}/{test}', 'StudentController@testResult');

Route::get('/api/get-question', 'ApiController@getQuestion');
Route::get('/api/{question_id}/meta-data', 'ApiController@getMetaData');
Route::get("/api/try_test/{test}", "ApiController@tryTest");
Route::get("/api/answers/{test}", "ApiController@answers");
Route::get("/api/solutions/{test}", "ApiController@solutions");

Route::post("/api/diagnose/chapters", "ApiController@diagnoseChapter");
Route::post("/api/diagnose/answer_data", "ApiController@diagnoseAnswer");

//Route::get('/register_question', 'RegisterQuestionController@index')->name('register_question');
//Route::post('/upload_question', 'RegisterQuestionController@upload')->name('upload_question');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
