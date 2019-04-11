<?php

Route::group(['prefix' => 'admin'], function() {
    //
});

Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

	Auth::routes();
  Route::get('addwallet', 'SmsController@addwallet');

  Route::get('profile', function() {
    return view('auth/profile');
  })->name('profile');

	// country
	Route::get('/country', 'RechargeController@show');
	Route::get('/allcountry', 'RechargeController@getallcuntry');
	Route::get('/country/{id}', 'RechargeController@getcuntry');

	// operators
	Route::get('/alloperators/{id}', 'RechargeController@getallalloperators');
	Route::get('/product/{id}', 'ProductController@index');

	// all test here
	Route::get('/test', 'HomeController@test');// for insert product into table
	Route::get('/dolorphonetest', 'HomeController@dolorphonetest');
	Route::get('/operator', 'HomeController@operator');// for insert product into table
	Route::post('/operators', 'RechargeController@test')->name('operators');
	Route::post('/instoperators', 'HomeController@insertOprator')->name('instoperators');
	Route::post('/insproduct', 'HomeController@insertproduct')->name('insproduct');
  Route::get('/recharge/confirms',"RechargeController@rechargeconfirms" );

	// recherge confirm
	Route::get('/recharge', 'RechargeController@index');
	Route::get('/recharge/confirm', 'RechargeController@edits');
	Route::post('/recharge/confirms', 'RechargeController@edit');


	// payment 
	Route::get('paypal/express-checkout', 'PaypalController@expressCheckout')->name('paypal.express-checkout');
	Route::get('paypal/express-checkout-success', 'PaypalController@expressCheckoutSuccess');
	Route::post('paypal/notify', 'PaypalController@notify');


  // twillo sms
  Route::get('sms','SmsController@index');
  Route::post('/sendmessage','SmsController@sendmessage');

  //Dingrecharge
  Route::get('/','DingrechargeController@index');
  Route::get('/allcountry','DingrechargeController@allcountry');
  Route::get('/rechargefin/dingrecharges', 'DingrechargeController@dingrecharges');
  Route::post('number','DingrechargeController@phoneNumber')->name('number');

  // vart 
  Route::get('/cart',"CartController@index");
  Route::get('/cart/send',"CartController@send");
  Route::get('/cart/remove/{rowid}',"CartController@remove");
  Route::get('/cart/destroy',"CartController@destroy");

});




