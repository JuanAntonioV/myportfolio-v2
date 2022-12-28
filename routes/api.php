<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserContactController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/', function () {
    return response()->json([
        'status' => true,
        'message' => 'Welcome to my portfolio API',
        'version' => '2.0.0',
        'author' => 'Juan Antonio Vivaldy Saragih',
        'email' => 'juananthonio23@gmail.com',
        'app' => [
            'name' => 'My Full Stack Portfolio v2.0.0',
            'laravel' => '^9.19',
            'php' => '^8.0.2',
            'react' => '^18.2.0',
            'npm' => '^8.19.2',
            'node' => '^18.12.1',
        ]
    ], 200);
});


Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('user', [UserController::class, 'index']);
    Route::get('user/{id}', [UserController::class, 'getUser']);
    Route::put('user/detail/{id}', [UserController::class, 'updateUserDetail']);

    // Create & Update User Contact
    Route::get('user/contact/{id}', [UserContactController::class, 'getContact']);
    Route::post('user/contact', [UserContactController::class, 'contact']);
    Route::delete('user/contact/{id}', [UserContactController::class, 'deleteContact']);
});
