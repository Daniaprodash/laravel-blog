<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// الصفحة الرئيسية
Route::get('/',[AuthController::class, 'index'])->name('index');

//Routes للمصادقة
Route::controller(AuthController::class)->name('auth.')->group(function(){
    Route::get('/index','index')->name('index');
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/showUser', 'showUser')->name('showUser');
    Route::post('/userDelete/{id}','userDelete')->name('userDelete');
    Route::post('/updateUSer/{id}','updateUSer')->name('updateUSer');
    Route::get('/userDashboard', 'userDashboard')->name('userDashboard');
    Route::get('/article', 'showArticle')->name('article');
    Route::get('/welcome','welcome')->name('welcome');
    Route::middleware('auth')->group(function () {
        Route::get('/AdminDashboard', 'AdminDashboard')->name('dashboard');
    });
    Route::get('/showMore/{id}', 'showMore')->name('showMore');
    Route::get('/editArticle/{id}' , 'showUpdatePage')->name('editArticle');
    Route::post('/updateArticle/{id}' , 'updateArticle')->name('updateArticle');
    Route::get('/ArticleSearch', 'ArticleSearch')->name('ArticleSearch');
    Route::get('/whous', 'whous')->name('whous');
    Route::get('/show_userArticle' , 'show_userArticle')->name('show_userArticle');
    Route::get('/showPostPage' , 'showPostPage')->name('showPostPage');
    Route::post('/postArticle' , 'postArticle')->name('postArticle');
    Route::get('/cancel' , 'cancel')->name('cancel');
    Route::post('/deleteArticle/{id}' , 'deleteArticle')->name('deleteArticle');
    Route::post('/star/{id}','star')->name('star');
    Route::post('/comments' , 'postComment')->name('postComment');
});