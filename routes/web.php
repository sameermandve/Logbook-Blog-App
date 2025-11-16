<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// Routes for Authentication (Login and Registration)
Route::controller(AuthController::class)
    ->group(function () {

        // Route for Login
        Route::get("/login", "login")
            ->name("login");

        // Route for Login Post
        Route::post("/login", "loginPost")
            ->name("login.post");

        // Route for Register Form
        Route::get("/register", "register")
            ->name("register");

        // Route for Register Post
        Route::post("/register", "registerPost")
            ->name("register.post");
    });

Route::middleware("auth")->group(function () {

    // Route for Logout
    Route::get("/logout", [AuthController::class, "logout"])
        ->name("logout");

    // Home Route
    Route::get('/', [PostController::class, "index"])
        ->name("home");

    // Routes for Search Functionality
    Route::controller(SearchController::class)
        ->prefix("search")
        ->group(function () {

            // Route to Search Form Route
            Route::get('/', "searchForm")
                ->name("search");

            // Route to Get Searched User Route
            Route::get('/user', "getSearchedUser")
                ->name("search.get");
        });

    // Routes for Profile Management
    Route::controller(ProfileController::class)
        ->prefix("profile")
        ->group(function () {

            // Route to View Profile Settings
            Route::get("/settings", "profile")
                ->name("profile.view");

            // Route to Update User Information including avatar
            Route::patch("update", "editUserInfo")
                ->name("profile.update");

            // Route to Delete User Account
            Route::delete("delete", "deleteUser")
                ->name("profile.delete");

            // Route to Change User Password
            Route::patch("edit/password", "changeUserPassword")
                ->name("password.change");

            // Route to show searched user profile
            Route::get("/show/{user:username}", "showUserProfile")
                ->name("profile.show");

            // Route to show self profile
            Route::get("/self", "selfProfileShow")
                ->name("self.profile.show");

            // Route to Delete Avatar
            Route::get("avatar-delete", "deleteAvatar")
                ->name("profile.avatar.delete");
        });

    // Routes for Post Management
    Route::controller(PostController::class)
        ->prefix("post")
        ->group(function () {

        // Route to show create post form
        Route::get("create", [PostController::class, "create"])
            ->name("post.form");

        // Route to handle post creation
        Route::post("create", [PostController::class, "createPost"])
            ->name("post.create");

        // Route to show a specific post
        Route::get("show/{post:slug}", [PostController::class, "show"])
            ->name("post.show");
    });
});
