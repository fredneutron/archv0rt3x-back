<?php

use App\Http\Controllers\ArchV0rt3xController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/biography', [ArchV0rt3xController::class, 'biography']);
    Route::get('/educations', [ArchV0rt3xController::class, 'education']);
    Route::get('/hobbies', [ArchV0rt3xController::class, 'hobbies']);
    Route::get('/professions', [ArchV0rt3xController::class, 'profession']);
    Route::get('/projects', [ArchV0rt3xController::class, 'projects']);
    Route::get('/socials', [ArchV0rt3xController::class, 'socials']);
    Route::get('/skills', [ArchV0rt3xController::class, 'skill']);
    Route::get('/works', [ArchV0rt3xController::class, 'work']);
    Route::post('/mail', [ArchV0rt3xController::class, 'mail']);
});