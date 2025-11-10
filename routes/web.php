<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)
    ->group(function () {

        Route::get("/login", "login")
            ->name("login");

        Route::post("/login", "loginPost")
            ->name("login.post");

        Route::get("/register", "register")
            ->name("register");

        Route::post("/register", "registerPost")
            ->name("register.post");
    });

Route::middleware("auth")->group(function () {

    Route::get("/logout", [AuthController::class, "logout"])
        ->name("logout");

    Route::get('/', function () {
        return view('home');
    })->name("home");

    Route::prefix("profile")->group(function () {
        Route::get("/", [ProfileController::class, "profile"])
            ->name("profile.view");

        Route::patch("update", [ProfileController::class, "editUserInfo"])
            ->name("profile.update");

        Route::delete("delete", [ProfileController::class, "deleteUser"])
            ->name("profile.delete");

        Route::patch("edit/password", [ProfileController::class, "changeUserPassword"])
            ->name("password.change");
    });
});
