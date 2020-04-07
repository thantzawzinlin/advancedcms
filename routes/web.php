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
// Route::get('/posts/trashed', function () {
//     return view('admin.posts.trashed');
// });

//Route::get('/posts/trashed','PostsController@trashed');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','middleware'=>'auth'], function(){
    Route::resource('categories','CategoriesController');
    Route::get('posts/trashed',[ 'uses'=>'PostsController@trashed',
    'as'=>'posts.trashed'
    ]);// if you want to add more route ,put it before resource route
     Route::get('posts/restore/{id}',[ 'uses'=>'PostsController@restore',
    'as'=>'posts.restore'
    ]);
    Route::resource('posts','PostsController');
    Route::resource('tags','TagController');
    
   
   
});

