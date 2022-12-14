<?php

use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\TweetLikeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function(){
    // Tweet
    Route::get('tweets', [TweetController::class,'index'])->name('home');
    Route::post('tweets',[TweetController::class,'store']);
    // Tweet Like
    Route::post('/tweets/{tweet}/like',[TweetLikeController::class,'store']);
    Route::delete('/tweets/{tweet}/like',[TweetLikeController::class,'destroy']);
    // Follow
    Route::post('/profiles/{user:username}/follow',[FollowController::class,'store'])->name('follow');
    // Profile
    Route::get('/profiles/{user:username}/edit',[ProfileController::class,'edit'])->middleware('can:edit,user');
    Route::patch('/profiles/{user:username}',[ProfileController::class,'update'])->middleware('can:edit,user');
    // Explore
    Route::get('/explore', [ExploreController::class,'index']);
});

Route::get('/profiles/{user:username}',[ProfileController::class,'show'])->name('profile');
Auth::routes();
