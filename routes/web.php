<?php

use App\Models\Fashion;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FashionController;
use App\Http\Controllers\BookmarkController;
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
Route::group(['middleware' => ['auth']], function (){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/fashions', FashionController::class);
    // ブックマークルート
    Route::post('/fashions/{fashion}/bookmark', [BookmarkController::class, 'store'])->name('bookmark.store');
    Route::delete('/fashions/{fashion}/unbookmark', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');
    Route::get('/bookmarks', [FashionController::class, 'bookmark_fashions'])->name('bookmarks');
});
Route::get('/api/calendarevent', [FashionController::class, 'calendar_event_fetch'])->middleware('auth');
