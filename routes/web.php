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

Route::get('/', 'HomeController@loadHomePage');
/*Route::get('/home', 'HomeController@loadHomePage')->name('home');*/

/* Pages */
Route::get('/@{username}', 'ProfileController@loadProfilePage');
Route::get('/@{username}/edit', 'ProfileController@loadEditProfilePage')->middleware(['auth']);
Route::get('/@{username}/followers', 'ProfileController@loadFollowersPage')->middleware(['auth']);
Route::get('/@{username}/following', 'ProfileController@loadFollowingPage')->middleware(['auth']);

Route::get('/wall', 'WallController@loadWallPage')->middleware(['auth']);

/* Controller actions */
Route::get('/@{username}/follow', 'ProfileController@followProfile')->middleware(['auth']);
Route::get('/@{username}/unfollow', 'ProfileController@unfollowProfile')->middleware(['auth']);
Route::post('/profile/edit/submit', 'ProfileController@submitEditProfile')->middleware(['auth']);
Route::post('/wall/create', 'WallController@createPost')->middleware(['auth']);

/* Getting images */
Route::get('/profile/img/{id}', 'ProfileController@loadProfileAvatar');


Route::get('/logout', 'Auth\LoginController@logout')->middleware(['auth']);
Auth::routes();
