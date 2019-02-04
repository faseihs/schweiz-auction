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

Auth::routes();

/*Route::get('/home', 'HomeController@index')->name('home');*/


Route::group(['prefix'=>'admin','middleware'=>'admin'],function (){
   Route::get('dashboard','Admin\DashboardController@index');
   Route::resource('auction','Admin\AuctionController');
});


Route::group(['prefix'=>'client','middleware'=>'client'],function (){
    Route::get('dashboard','Client\DashboardController@index');
    Route::get('auction','Client\DashboardController@auctions');

    Route::get('auction/{id}','Client\DashboardController@auction');
    Route::get('auction-bid/{id}','Client\DashboardController@getAuctionBid');
    Route::post('auction-bid/{id}','Client\DashboardController@postAuctionBid');
    Route::get('bid','Client\BidController@index');
});

