<?php

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

Route::get('/','GuestController@index');
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');

    // return what you want
});

Auth::routes();

/*Route::get('/home', 'HomeController@index')->name('home');*/

Route::post('user-request','GuestController@userRequest');
Route::group(['prefix'=>'admin','middleware'=>'admin'],function (){
   Route::get('dashboard','Admin\DashboardController@index');
    Route::get('/users','Admin\DashboardController@users');
    Route::get('/user-toggle/{id}','Admin\DashboardController@userToggle');
   Route::resource('auction','Admin\AuctionController');
});


Route::group(['prefix'=>'client','middleware'=>'client'],function (){
    Route::get('dashboard','Client\DashboardController@index');
    Route::get('auction','Client\DashboardController@auctions');

    Route::get('cars','Client\DashboardController@cars');
    Route::get('bikes','Client\DashboardController@bikes');

    Route::get('auction/{id}','Client\DashboardController@auction');
    Route::get('auction-bid/{id}','Client\DashboardController@getAuctionBid');
    Route::post('auction-bid/{id}','Client\DashboardController@postAuctionBid');
    Route::get('bid','Client\BidController@index');
    Route::delete('bid/{id}','Client\BidController@destroy');
});

Route::group(['prefix'=>'common','middleware'=>'auth'],function (){
    Route::get('account-settings','Common\UserController@getAccountSettings');
    Route::post('account-settings','Common\UserController@postAccountSettings');
    Route::get('profile-settings','Common\UserController@getProfileSettings');
    Route::post('profile-settings','Common\UserController@postProfileSettings');

});

