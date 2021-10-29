<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


    Route::namespace('API')->group(function () {
        Route::post('login', 'UserController@login');
        Route::post('user-signup', 'UserController@userSignup');
        Route::post('forgot-password', 'UserController@forgotPassword');
        Route::get('country-list', 'UserController@countryList');
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('service', 'HomeController@services')->name('service');
        Route::get('trending-prod', 'HomeController@trendingProd')->name('trending-prod');
        // Routes for contact
        Route::post('contact-us', 'HomeController@contactUs')->name('contact-us');
        Route::get('settings', 'HomeController@settings')->name('settings');
        // Product Public Path
        Route::post('product', 'ProductsController@index');
        Route::post('product/product-details', 'ProductsController@productDetails');
        Route::post('product/product-request', 'RequestController@productRequest');
        Route::get('product/categories', 'ProductsController@getCategories');
        Route::get('product/listing', 'ProductsController@listing');
        Route::post('product/best-offer', 'ProductsController@getBestofferByCategory');
        Route::post('product/trending-sale', 'ProductsController@getTrendingSalesByCategory');
        Route::get('product/get-trending-category', 'ProductsController@getTrendingCategoryWithProduct');

        // Messages paths
        Route::post('messages/index', 'MessagesController@index');
        Route::post('messages/initiate-conversation', 'MessagesController@initiateConversation');
        Route::post('messages/get-conversation', 'MessagesController@getConversation');
        Route::post('messages/send-message', 'MessagesController@sendMessage');




        Route::get('clients/categories', 'ClientsController@getCategories');
        Route::get('clients/listing', 'ClientsController@listing');
        Route::get('clients/details', 'ClientsController@details');
        Route::get('furniture', 'ProductsController@furniture');
        Route::group(['middleware' => 'auth:api'], function(){
            Route::get('user-details', 'UserController@details');
            Route::post('update-user', 'UserController@updateDetails');
            Route::post('change-password', 'UserController@updatePassword');
            Route::post('product-request', 'RequestController@index');
            Route::post('product-request/cancel-request', 'RequestController@cancelRequest');
            Route::post('product-request/all-product-request', 'RequestController@saveAllProdReq');
            //Routes for Appointment
            Route::get('appointments', 'AppointmentController@index');
            Route::get('appointments/dates', 'AppointmentController@appointmentDates');
            Route::post('appointments/slots', 'AppointmentController@appointmentSlots');
            Route::post('appointments/book', 'AppointmentController@book');
            Route::post('appointments/cancel', 'AppointmentController@cancel');
            //Routes for save favorite
            Route::get('favorites', 'FavoritesController@index');
            Route::post('favorites/mart-unmark', 'FavoritesController@saveFavorites');
            Route::post('favorites/destroy','FavoritesController@destroy');

        });
    });

//Route::group(['middleware' => 'auth:api'], function(){
//
//});

