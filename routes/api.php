<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

Route::get("/test", function(Request $request) {
    return $request;
});

Route::middleware('auth:api')->group(function () {
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::post("/coffee/inc", [UserController::class, "incCoffeeCounter"]);
    Route::post("/coffee/dec", [UserController::class, "decCoffeeCounter"]);
    Route::get("/coffee", [UserController::class, "fetchCurrentCoffeeCounter"]);
    Route::get("/user", [UserController::class, "fetchAuthUser"]);
    Route::get("/user/all", [UserController::class, "fetchAllUser"]);
});

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);