<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//list article
Route::get('articles', ['uses' => 'ArticleController@index']);
Route::get('articles/{id}', ['uses' => 'ArticleController@show']);
Route::post('articles', ['uses' => 'ArticleController@store']);
Route::put('articles/{id}', ['uses' => 'ArticleController@update']);
Route::delete('articles/{id}', ['uses' => 'ArticleController@destroy']);

Route::get('users', ['uses' => 'UserController@index']);
Route::delete('user/{id}', ['uses' => 'UserController@delete']);

//POST FILE

Route::post('files', ['uses' => 'StaticsController@storeFile']);