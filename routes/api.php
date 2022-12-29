<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserContactController;
use App\Http\Controllers\User\ExperienceController;
use App\Http\Controllers\User\JobDeskController;
use App\Http\Controllers\User\SkillController;
use App\Http\Controllers\User\ResumeController;
use App\Http\Controllers\User\CourseController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Project\ProjectPathController;
use App\Http\Controllers\Project\ProjectTechnologieController;

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
    Route::get('user/all', [UserController::class, 'index']);
    Route::get('user', [UserController::class, 'profile']);
    Route::get('user/{id}', [UserController::class, 'getUser']);
    Route::put('user/detail/{id}', [UserController::class, 'updateUserDetail']);

    // Create & Update User Contact
    Route::get('contact/all', [UserContactController::class, 'index']);
    Route::get('contact', [UserContactController::class, 'get']);
    Route::post('contact', [UserContactController::class, 'add']);
    Route::put('contact/{id}', [UserContactController::class, 'update']);
    Route::delete('contact/{id}', [UserContactController::class, 'deleteContact']);

    // User Experience
    Route::get('experience/all', [ExperienceController::class, 'index']);
    Route::get('experience', [ExperienceController::class, 'get']);
    Route::post('experience', [ExperienceController::class, 'add']);
    Route::put('experience/{id}', [ExperienceController::class, 'update']);
    Route::delete('experience/{id}', [ExperienceController::class, 'delete']);

    // Experience Jobdesk
    Route::get('jobdesk/{expId}', [JobDeskController::class, 'get']);
    Route::post('jobdesk/{expId}', [JobDeskController::class, 'add']);
    Route::put('jobdesk/{id}', [JobDeskController::class, 'update']);
    Route::delete('jobdesk/{id}', [JobDeskController::class, 'delete']);

    // Skill
    Route::get('skill/all', [SkillController::class, 'index']);
    Route::get('skill', [SkillController::class, 'get']);
    Route::post('skill', [SkillController::class, 'add']);
    Route::put('skill/{id}', [SkillController::class, 'update']);
    Route::delete('skill/{id}', [SkillController::class, 'delete']);

    // Courses
    Route::get('courses/all', [CourseController::class, 'index']);
    Route::get('courses', [CourseController::class, 'get']);
    Route::post('courses', [CourseController::class, 'add']);
    Route::put('courses/{id}', [CourseController::class, 'update']);
    Route::delete('courses/{id}', [CourseController::class, 'delete']);

    // Resume
    Route::get('resume/all', [ResumeController::class, 'index']);
    Route::get('resume', [ResumeController::class, 'get']);
    Route::post('resume', [ResumeController::class, 'add']);
    Route::delete('resume/{id}', [ResumeController::class, 'delete']);

    // Project
    Route::prefix('project')->group(function () {
        Route::get('all', [ProjectController::class, 'index']);
        Route::get('/', [ProjectController::class, 'get']);
        Route::post('/', [ProjectController::class, 'add']);
        Route::put('{id}', [ProjectController::class, 'update']);
        Route::delete('{id}', [ProjectController::class, 'delete']);

        // Technologies
        Route::get('technologie/all', [ProjectTechnologieController::class, 'index']);
        Route::get('technologie/{projectId}', [ProjectTechnologieController::class, 'get']);
        Route::post('technologie', [ProjectTechnologieController::class, 'add']);
        Route::put('technologie/{id}', [ProjectTechnologieController::class, 'update']);
        Route::delete('technologie/{id}', [ProjectTechnologieController::class, 'delete']);

        // Paths
        Route::get('path/all', [ProjectPathController::class, 'index']);
        Route::get('path/{projectId}', [ProjectPathController::class, 'get']);
        Route::post('path', [ProjectPathController::class, 'add']);
        Route::put('path/{id}', [ProjectPathController::class, 'update']);
        Route::delete('path/{id}', [ProjectPathController::class, 'delete']);
    });
});
