<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\ActionController;

Auth::routes();

/*TODO REMOVE THIS*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("/profile/getSelfInfo",[UserController::class, "getSelfInfo"]);
Route::get("/user/getUserInfoById",[UserController::class,"getUserInfoById"]);
Route::get("/posts/getById",[PostController::class,"getById"]);
Route::get("/posts/get",[PostController::class,"get"]);
Route::get("/user/getFriends",[UserController::class,"getFriends"]);
Route::get("/user/getPosts",[SubscribeController::class,"getSubcribedPost"]);

Route::middleware(["auth:sanctum"])->group(function(){
    /*TODO REMOVE THIS*/
    Route::get('posts/', [PostController::class,"index"]);
    /*TODO REMOVE THIS*/
    Route::get("/posts/list",[PostController::class,"list"]);

    Route::post('/posts/create', [PostController::class,"create"]);
    Route::post("/posts/like", [ActionController::class,"likePost"]);

    Route::post("/user/update",[UserController::class,"update"]);
    Route::post("/user/addFriend",[UserController::class,"addFriend"]);
    Route::get("/user/settings", [UserController::class, "settings"]);
    /*TODO REMOVE THIS*/
    Route::get("/user/getSelfSubscribers",[UserController::class, "getSelfSubscribers"]);
});

Route::get('/{vue_capture?}', function () {
    return view('app');
})->where('vue_capture', '[\/\w\.-]*');
