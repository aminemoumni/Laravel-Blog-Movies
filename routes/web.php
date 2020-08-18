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



Auth::routes();
Route::get('post/{slug}', 'HomeController@post' )->name('post.home');
Route::get('post/category/{id}', 'HomeController@postByCategory' )->name('post.category');
Route::get('/', 'HomeController@index')->name('home');
Route::POST('/comments', 'PostCommentsController@store')->name('comments.store')->middleware(['auth']);

Route::POST('/comment/replies', 'CommentRepliesController@store')->name('replies.store')->middleware(['auth']);

Route::group(['middleware' => ['auth', 'authororadmin']], function() { 

    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::resource('admin/users', 'AdminUsersController')->middleware(['admin']);

    Route::resource('admin/posts', 'AdminPostsController');

    Route::resource('admin/categories', 'AdminCategoriesController');
    //Route::post('savedata', 'AdminCategoriesController@store'); add category with ajax
    Route::resource('admin/media', 'MediaController');
    Route::delete('admin/deletemedia', 'MediaController@deletemedia')->name('media.deleteall');

    
    Route::resource('admin/comments', 'PostCommentsController', ['except' => ['store']]);
    Route::POST('admin/comments/approve/{id}', 'PostCommentsController@approve')->name('comments.approve');
    Route::POST('admin/comments/unapprove/{id}', 'PostCommentsController@unapprove')->name('comments.unapprove');

    Route::resource('admin/comment/replies', 'CommentRepliesController', ['except' => ['store']]);
    Route::POST('admin/comments/reply/approve/{id}', 'CommentRepliesController@approve')->name('replies.approve');
    Route::POST('admin/comments/reply/unapprove/{id}', 'CommentRepliesController@unapprove')->name('replies.unapprove');


});


