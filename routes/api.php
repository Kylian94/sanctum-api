<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users', 'UserController@index');
    Route::get('/notes', 'NoteController@index');
    Route::get('/note/{id}', 'NoteController@show');

    Route::post('/notes', 'NoteController@store');
    Route::post('/notes/{id}', 'NoteController@edit');

    Route::delete('/notes/{id}', 'NoteController@delete');
    Route::delete('/reset', 'NoteController@destroy');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
