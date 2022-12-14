<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\NoteController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::group(['middleware'=> ['auth:api']], function () {
    Route::get('/group/getAll', [GroupController::class, 'getGroups']);
    Route::post('/note/getByGroup', [NoteController::class, 'getNotesByGroup']);
    Route::post('/note/create', [NoteController::class, 'createNote']);
    Route::post('/note/getByDate', [NoteController::class, 'getNotesByDate']);
    Route::post('/note/getWithImage', [NoteController::class, 'getNotesWithImage']);
});
