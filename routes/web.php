<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ParseController;
use \App\Http\Controllers\SocialController;
use App\Http\Controllers\LocaleController;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', '\App\Http\Controllers\NewsController@index')
    ->name('main');

//Админка
Route::group([
    'prefix' => '/admin',
    'as' => 'admin::',
    'namespace' => '\App\Http\Controllers\Admin',
    'middleware' => ['auth', 'role:admin']
], function () {

//USERS
//    Route::resource('user', 'UserController');
    Route::get('/users', 'UserController@index')
        ->name('user');
    Route::match(['get','post'], '/users/create', 'UserController@createUser')
        ->name('createUser');

    Route::match(['post'], '/users/save', 'UserController@saveUser')
        ->name('saveUser');

    Route::get('/users/update/{id}', 'UserController@updateUser')
        ->name('updateUser');

    Route::get('/users/delete/{id}', 'UserController@deleteUser')
        ->name('deleteUser');

//NEWS
    Route::get('/news', 'NewsController@index')
        ->name('news');
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

    Route::get('/delete', 'NewsController@deleteAllNews')
        ->name('deleteAllNews');

//  Открытие формы и создание новостной категории
    Route::match(['GET', 'POST'], '/addcategory', 'NewsController@createCategory')
        ->name('createCategory');

    Route::match(['post'], '/saveCategory', 'NewsController@saveCategory')
        ->name('saveCategory');

    Route::get('/updateCategory/{id}', 'NewsController@updateCategory')
        ->name('updateCategory');

//    Parser
    Route::get('/loadnews', 'ParseController@loadYandexNews')
        ->name('loadYandexNews');
});


Route::group([
    'prefix' => '/news',
    'as' => 'news::',
    'namespace' => '\App\Http\Controllers'
], function () {
    Route::get('/', 'NewsController@index')
        ->name('news');
    Route::get('/categories', 'NewsController@showCategories')
        ->name('categories');
    Route::get('/category_{id}', 'NewsController@showNewsByCategory')
        ->name('categoryId');
    Route::get('/news_{id}', 'NewsController@showNews')
        ->name('newsId');
//    Route::match(['GET', 'POST'], '/upload', 'NewsController@upload')->name('upload');
});

Route::get('/locale/{lang}', [LocaleController::class, 'index'])
    ->where('lang', '\w+')
    ->name('locale');

Route::group([
    'prefix' => '/social',
    'as' => 'social::',
], function () {
    Route::get('/{provider}', [SocialController::class, 'login'])
        ->name('login');
    Route::get('/{provider}/response', [SocialController::class, 'response'])
        ->name('response');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\NewsController::class, 'index'])->name('home');
