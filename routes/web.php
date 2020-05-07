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
Route::get('/@{username}/followings', 'ProfileController@loadFollowingsPage')->middleware(['auth']);

Route::get('/wall', 'WallController@loadWallPage')->middleware(['auth']);
Route::get('/post/details/{id}', 'WallController@loadPostDetailsPage')->middleware(['auth']);
Route::get('/explore', 'ExploreController@loadExplorePage')->middleware(['auth']);

/* Controller actions */
Route::get('/@{username}/follow', 'ProfileController@followProfile')->middleware(['auth']);
Route::get('/@{username}/unfollow', 'ProfileController@unfollowProfile')->middleware(['auth']);
Route::post('/profile/edit/submit', 'ProfileController@submitEditProfile')->middleware(['auth']);
Route::post('/wall/create', 'WallController@createPost')->middleware(['auth']);
Route::post('/comment/create', 'CommentController@createComment')->middleware(['auth']);
Route::post('/search/username', 'ExploreController@searchByUsername');/*->middleware(['auth']);*/

/* Liking and unliking posts */
Route::post('/post/like', 'Wallcontroller@likePost')->middleware(['auth']);
Route::post('/post/unlike', 'Wallcontroller@unlikePost')->middleware(['auth']);

/* Getting images */
Route::get('/profile/img/{id}', 'ProfileController@loadProfileAvatar');
Route::get('/post/img/{id}', 'WallController@loadPostImage');


Route::get('/logout', 'Auth\LoginController@logout')->middleware(['auth']);
Auth::routes();
