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

Route::middleware(['auth:sanctum', 'verified'])->get('key', function () {
    return view('keys');
})->name('key.index');
Route::middleware(['auth:sanctum', 'verified'])->post('key/add', 'App\Http\Controllers\UserController@add_key')->name('key.create');
Route::middleware(['auth:sanctum', 'verified'])->post('key/verify', 'App\Http\Controllers\UserController@verify_key')->name('key.verify');

// Contact routes
Route::middleware(['auth:sanctum', 'verified'])->get('contact', function () {
    return view('contact');
})->name('contact.index');

Route::middleware(['auth:sanctum', 'verified'])->post('contact','App\Http\Controllers\MessageController@create')->name('contact.create');
Route::middleware(['auth:sanctum', 'verified'])->get('contact/{user}', 'App\Http\Controllers\MessageController@reply')->name('contact.reply');

// Messages routes
Route::middleware(['auth:sanctum', 'verified'])->get('messages/inbox', function () {
    return view('messages.index');
})->name('messages.index');
Route::middleware(['auth:sanctum', 'verified'])->get('messages/sent', function () {
    return view('messages.sent');
})->name('messages.sent');
Route::middleware(['auth:sanctum', 'verified'])->delete('messages/delete/{message}','App\Http\Controllers\MessageController@destroy')->name('messages.destroy');
Route::middleware(['auth:sanctum', 'verified'])->get('messages/{message}', 'App\Http\Controllers\MessageController@show')->name('messages.show');

// Admin routes
Route::middleware(['auth:sanctum', 'admin'])->get('admin', function () {
    return view('admin.index');
})->name('admin.index');
Route::middleware(['auth:sanctum', 'admin'])->get('admin/download', 'App\Http\Controllers\UserController@download')->name('admin.download');

Route::middleware(['auth:sanctum', 'admin'])->get('users/edit/{user}','App\Http\Controllers\UserController@edit')->name('users.edit');
Route::middleware(['auth:sanctum', 'admin'])->patch('users/update/{user}','App\Http\Controllers\UserController@update')->name('users.update');
Route::middleware(['auth:sanctum', 'admin'])->get('users', function () {
    return view('admin.users.index');
})->name('users.index');
Route::middleware(['auth:sanctum', 'admin'])->get('users/{user}', 'App\Http\Controllers\UserController@show')->name('users.show');
Route::middleware(['auth:sanctum', 'admin'])->delete('users/delete/{user}','App\Http\Controllers\UserController@destroy')->name('users.destroy');
