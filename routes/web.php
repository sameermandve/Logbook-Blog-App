<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
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

    Route::get('/', [PostController::class, "index"])
        ->name("home");

    Route::prefix("search")->group(function () {
        Route::get('/', [SearchController::class, "searchForm"])
            ->name("search");

        Route::get('/user', [SearchController::class, "getSearchedUser"])
            ->name("search.get");
    });

    Route::prefix("profile")->group(function () {
        Route::get("/settings", [ProfileController::class, "profile"])
            ->name("profile.view");

        Route::patch("update", [ProfileController::class, "editUserInfo"])
            ->name("profile.update");

        Route::delete("delete", [ProfileController::class, "deleteUser"])
            ->name("profile.delete");

        Route::patch("edit/password", [ProfileController::class, "changeUserPassword"])
            ->name("password.change");

        Route::get("/show/{user:username}", [ProfileController::class, "showUserProfile"])
            ->name("profile.show");

        Route::get("/self", [ProfileController::class, "selfProfileShow"])
            ->name("self.profile.show");

        Route::get("avatar-delete", [ProfileController::class, "deleteAvatar"])
            ->name("profile.avatar.delete");
    });

    Route::prefix("post")->group(function () {
        Route::get("create", [PostController::class, "create"])
            ->name("post.form");

        Route::post("create", [PostController::class, "createPost"])
            ->name("post.create");

        Route::get("show/{post:slug}", [PostController::class, "show"])
            ->name("post.show");
    });
});
