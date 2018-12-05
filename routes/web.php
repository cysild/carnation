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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix'=>'admin'], function(){

//Make 
Route::get('/make','MakeController@index');
Route::get('/make/list','MakeController@table_list');
Route::get('/make/json','MakeController@MakeJson');
Route::get('/make/{id}','MakeController@show');
Route::post('/make/save','MakeController@store');
Route::get('/make/drop/{id}','MakeController@drop');
//end

//Model 
Route::get('/model','ModelController@index');
Route::get('/model/list','ModelController@table_list');
Route::get('/model/json','ModelController@MakeJson');
Route::get('/model/{id}','ModelController@show');
Route::post('/model/save','ModelController@store');
Route::get('/model/drop/{id}','ModelController@drop');


//Car Type
Route::get('/cartype','CarTypeController@index');
Route::get('/cartype/list','CarTypeController@table_list');
Route::get('/cartype/json','CarTypeController@MakeJson');
Route::get('/cartype/{id}','CarTypeController@show');
Route::post('/cartype/save','CarTypeController@store');
Route::get('/cartype/drop/{id}','CarTypeController@drop');



//car Features 
//Route::get('/','FeaturesController@index');
Route::get('/features','FeaturesController@index');
Route::get('/features/json','FeaturesController@featuresJson');
Route::get('/features/list','FeaturesController@table_list');
Route::get('/features/{id}','FeaturesController@show');
Route::post('/features/save','FeaturesController@store');
Route::get('/features/drop/{id}','FeaturesController@drop');



//Car Listing
Route::get('/','ListingController@index');
Route::get('/listing','ListingController@index');
Route::post('/listing/save','ListingController@store');
Route::get('/listing/list','ListingController@table_list');
Route::get('/listing/{id}','ListingController@show');




//Listing json
Route::get('/transmission','ListingController@transmissionJson');
Route::get('/fuel','ListingController@fuelJson');




		Route::get('/client','ClientController@ClientListing');
		Route::get('/clientcontent','ClientController@clientcontent');
	/*	Route::get('/state/list', 'ClientController@StateList');*/
		Route::get('/city/list/{id}', 'ClientController@CityList');
		Route::post('/client/store', 'ClientController@store');
		Route::get('/client/get/{id}', 'ClientController@ClientGet');
		Route::get('/client/del/{id}', 'ClientController@clientdel');

		Route::get('/enquiry','ClientController@EnquiryListing');
		Route::get('/enquirycontent','ClientController@enquirycontent');
		Route::get('/enquiry/get/{id}', 'ClientController@EnquiryGet');
		Route::get('/enquiry/del/{id}', 'ClientController@enquirydel');
		Route::get('/request/list','ClientController@requestListing');
		Route::get('/request','ClientController@request');


});

		Route::post('/enquiry/store', 'ClientController@enquirystore');


Route::post('/request/store', 'ClientController@requeststore');

Route::get('/','IndexController@index');

Route::get('/collection','IndexController@collection');

Route::get('/search','SearchContoller@search');
		



Route::get('/collection/{id}/{make}','IndexController@make');
Route::get('/collection/{id}/{make}/{mid}/{model}','IndexController@make');
Route::get('/{type}','IndexController@type');
Route::get('/{type}/{make}','IndexController@type');
Route::get('/{type}/{id}/{title}','IndexController@show');


