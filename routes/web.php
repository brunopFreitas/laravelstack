<?php

use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
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
    return redirect('/posts');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/people', UsersController::class)->middleware('check.user.admin')->name('index','people');
Route::resource('/posts', PostsController::class)->name('index','posts');
Route::resource('/themes',ThemeController::class)->middleware('check.theme.manager');

Route::get('/changetheme/{id}', function($id){
//    Set cookie with theme id
    return redirect()->back()->withCookie(cookie('theme', $id, 525600));
//    Redirect back to the previous page
})->name('changetheme');
