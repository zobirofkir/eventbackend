<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post("login", [AuthController::class, "login"]);

Route::middleware("auth:api")->group(function ()  {
    Route::apiResource("users", UserController::class);

    Route::get("logout", [AuthController::class, "logout"]);
    Route::post("current", [AuthController::class, "current"]);
});