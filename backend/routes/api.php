<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/content', [ContentController::class, 'index']);


Route::group(['middleware' => 'custom'], function () {
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::get('/profile', [AuthController::class, 'profile']);

  // Content
  Route::prefix('content')->group(function () {
    Route::post('/', [ContentController::class, 'store']);
    Route::get('/user/{content}', [ContentController::class, 'showByUserId']);
    Route::get('/{content}', [ContentController::class, 'show']);
    Route::put('/{content}', [ContentController::class, 'update']);
    Route::post('/{content}', [ContentController::class, 'destroy']);
  });
});
