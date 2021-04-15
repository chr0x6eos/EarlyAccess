<?php

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

Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('forum', function () {
    return view('forum');
})->name('forum');

Route::middleware(['auth:sanctum', 'verified'])->get('notes', function () {
    return view('notes');
})->name('notes');

// Contact routes
Route::middleware(['auth:sanctum', 'verified'])->get('contact', function () {
    return view('contact');
})->name('contact.index');

Route::middleware(['auth:sanctum', 'verified'])->get('contact/{user}', 'App\Http\Controllers\MessageController@contact')->name('contact.name');
Route::middleware(['auth:sanctum', 'verified'])->post('contact','App\Http\Controllers\MessageController@create')->name('contact.create');

// Messages routes
Route::middleware(['auth:sanctum', 'verified'])->get('messages', function () {
    return view('messages.index');
})->name('messages.index');
Route::middleware(['auth:sanctum', 'verified'])->delete('messages/delete/{message}','App\Http\Controllers\MessageController@destroy')->name('messages.destroy');
Route::middleware(['auth:sanctum', 'verified'])->get('messages/{message}', 'App\Http\Controllers\MessageController@show')->name('messages.show');
