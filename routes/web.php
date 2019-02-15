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


//Route for Welcome Page ( Page with slideshow )
Route::get('/','GuestController@index');

//Route to clear cache of config data in .env file
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
});

//Authenticaion Routes
Auth::routes();

/*Route::get('/home', 'HomeController@index')->name('home');*/


//Route for user registration
Route::post('user-request','GuestController@userRequest');

//Routes for Admin Related Functionalities
//Middleware applied is 'admin' which is in App\Http\Middleware
Route::group(['prefix'=>'admin','middleware'=>'admin'],function (){
    //Dashboard Route
   Route::get('dashboard','Admin\DashboardController@index');

   //Route to get all users
    Route::get('/users','Admin\DashboardController@users');
    //Route to activate/deactivate user
    Route::get('/user-toggle/{id}','Admin\DashboardController@userToggle');

    //Route to get a single user details
    Route::get('/user/{id}','Admin\DashboardController@userView');

    //Route to change users password
    Route::post('/user/{id}','Admin\DashboardController@userUpdate');

    //Routes for auction related CRUD Operations

   Route::resource('auction','Admin\AuctionController');

   //Route to get bids of a particular auction
    Route::get('auction-bids/{id}','Admin\AuctionController@bids');

    //Select Winner Bid
    Route::get('auction-bid/{id}','Admin\AuctionController@chooseBid');

    //Remove the winner of a particular auction
    Route::get('auction-bid-remove/{id}','Admin\AuctionController@removeWinner');
});



//Client Routes with Client Middleware which is  in App\Http\Middleware
Route::group(['prefix'=>'client','middleware'=>'client'],function (){

    //Client Dashboard
    Route::get('dashboard','Client\DashboardController@index');

    //View Auctions
    Route::get('auction','Client\DashboardController@auctions');

    //View Cars
    Route::get('cars','Client\DashboardController@cars');
    Route::get('bikes','Client\DashboardController@bikes');

    //View One Auction Details
    Route::get('auction/{id}','Client\DashboardController@auction');
    //View Auction Bids
    Route::get('auction-bid/{id}','Client\DashboardController@getAuctionBid');

    //Post a bid for an auction
    Route::post('auction-bid/{id}','Client\DashboardController@postAuctionBid');

    //See all Client Bids
    Route::get('bid','Client\BidController@index');

    //Delete Bid
    Route::delete('bid/{id}','Client\BidController@destroy');
});


//Routes that for admin as well as client
Route::group(['prefix'=>'common','middleware'=>'auth'],function (){

    //Account Settings GET and Update
    Route::get('account-settings','Common\UserController@getAccountSettings');
    Route::post('account-settings','Common\UserController@postAccountSettings');

    //Profile Settings GET and Update
    Route::get('profile-settings','Common\UserController@getProfileSettings');
    Route::post('profile-settings','Common\UserController@postProfileSettings');

    //Mark Read All Notifications  (AJAX Calls)
    Route::get('/mark-all-read','Common\UserController@markAllRead');

});

