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

//Админка
Route::group([
    'prefix' => '/admin',
    'as' => 'admin::news::',
    'namespace' => '\App\Http\Controllers\Admin\News'
], function () {
    Route::get('/', 'NewsController@index')
        ->name('index');

//Страница результата добавления новости
    Route::match(['get','post'], '/create', 'NewsController@createNews')
        ->name('createNews');

    Route::match(['post'], '/save', 'NewsController@saveNews')
        ->name('saveNews');

    Route::get('/update/{id}', 'NewsController@updateNews')
        ->name('updateNews');

//Страница удаления новости
    Route::get('/delete/{id}', 'NewsController@deleteNews')
        ->name('deleteNews');

//  Открытие формы и создание новостной категории
    Route::match(['GET', 'POST'], '/addcategory', 'NewsController@createCategory')
        ->name('createCategory');

});

Route::get('/news', '\App\Http\Controllers\NewsController@index')->name('news');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
