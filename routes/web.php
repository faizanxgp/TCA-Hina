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

//Route::get('/', function () {
//    return view('welcome');
//});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

#
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->group(function() {
    Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin.main');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::get('/profile', 'AdminController@getProfile')->name('admin.profile');
    Route::post('/profile', 'AdminController@postProfile')->name('admin.profile-post');

    Route::get('/admins', 'AdminController@getAdmins')->name('admin.admins');
    Route::get('/admin/{id?}', 'AdminController@getAdmin')->name('admin.get-admin');
    Route::post('/post-ad,om', 'AdminController@postAdmin')->name('admin.post-admin');

    Route::get('/users', 'AdminController@getUsers')->name('admin.users');
    Route::get('/user/{id?}', 'AdminController@getUser')->name('admin.get-user');
    Route::post('/post-user', 'AdminController@postUser')->name('admin.post-user');
    Route::get('/user-package/{id}', 'AdminController@getUserPackage')->name('admin.get-user-package');
    Route::post('/post-user-package', 'AdminController@postUserPackage')->name('admin.post-user-package');
    Route::get('/view-user/{id?}', 'AdminController@getViewUser')->name('admin.view-user');

    Route::get('/partner-status/{id}', 'AdminController@getPartnerStatus')->name('admin.partner-status');
    Route::get('/complain-status/{id}', 'AdminController@getComplainStatus')->name('admin.complain-status');

    Route::get('/packages', 'AdminController@getPackages')->name('admin.packages');
    Route::get('/package/{id?}', 'AdminController@getPackage')->name('admin.get-package');
    Route::post('/post-package', 'AdminController@postPackage')->name('admin.post-package');

    Route::get('/countries', 'AdminController@getCountries')->name('admin.countries');
    Route::get('/country/{id?}', 'AdminController@getCountry')->name('admin.get-country');
    Route::post('/post-country', 'AdminController@postCountry')->name('admin.post-country');

    Route::get('/sectors', 'AdminController@getCategories')->name('admin.categories');
    Route::get('/sector/{id?}', 'AdminController@getCategory')->name('admin.get-category');
    Route::post('/post-sector', 'AdminController@postCategory')->name('admin.post-category');

    Route::get('/etypes', 'AdminController@getEtypes')->name('admin.etypes');
    Route::get('/etype/{id?}', 'AdminController@getEtype')->name('admin.get-etype');
    Route::post('/post-etype', 'AdminController@postEtype')->name('admin.post-etype');

    Route::get('/messages', 'AdminController@getMessages')->name('admin.get-messages');
    Route::get('/message/{id}', 'AdminController@getMessage')->name('admin.get-message');
    Route::post('/post-message', 'AdminController@postMessage')->name('admin.post-message');

    Route::get('/events', 'AdminController@getEvents')->name('admin.events');
    Route::get('/event/{id?}', 'AdminController@getEvent')->name('admin.get-event');
    Route::post('/post-event', 'AdminController@postEvent')->name('admin.post-event');
    Route::get('/event-copy/{id}', 'AdminController@getEventCopy')->name('admin.get-event-copy');

    Route::get('/community', 'AdminController@getCommunity')->name('admin.community');
    Route::get('/community-status/{id}', 'AdminController@getCommunityStatus')->name('admin.community-status');
    //Route::get('/package/{id?}', 'AdminController@getPackage')->name('admin.get-package');
    //Route::post('/post-package', 'AdminController@postPackage')->name('admin.post-package');

    Route::get('/event-details/{id}', 'AdminController@getDetails')->name('admin.event-details');

    Route::get('/csv', 'AdminController@getCSV')->name('admin.csv');
    Route::post('/csv2', 'AdminController@postCSV')->name('admin.csv2');

});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/event-details/{id}', 'HomeController@getDetails')->name('event-details');
Route::get('/event-select/{id}', 'HomeController@getEventSelect')->name('event-select');
Route::get('/event-remove/{id}', 'HomeController@getEventRemove')->name('event-remove');
Route::get('/event-bug/{id}', 'HomeController@getEventBug')->name('event-bug');
Route::post('/event-bug-update', 'HomeController@postEventBugUpdate')->name('bug-update');

Route::get('/event-email/{id}', 'HomeController@getEventEmail')->name('event-email');
Route::get('/event-download/{id}', 'HomeController@getEventDownload')->name('event-download');



Route::get('/event-partner/{id}', 'HomeController@getEventPartner')->name('event-partner');
Route::post('/event-partner-update', 'HomeController@postEventPartnerUpdate')->name('partner-update');
Route::get('/event-activity/{id}', 'HomeController@getEventActivity')->name('event-activity');
Route::post('/event-activity-update', 'HomeController@postEventActivityUpdate')->name('activity-update');
Route::get('/my-pins', 'HomeController@getPins')->name('my-pins');
Route::post('/pin-update', 'HomeController@postPinUpdate')->name('pin-update');
Route::get('/profile', 'HomeController@getProfile')->name('my-profile');
Route::post('/profile', 'HomeController@postProfile')->name('my-profile-post');
Route::get('/inbox', 'HomeController@getInbox')->name('my-inbox');

Route::get('/download-ics', 'HomeController@getICS')->name('download-ics');


Route::get('/teams', 'HomeController@getTeams')->name('teams');
Route::get('/team/{id?}', 'HomeController@getTeam')->name('get-team');
Route::post('/post-team', 'HomeController@postTeam')->name('post-team');
Route::get('/shared-pins', 'HomeController@getSharedPins')->name('shared-pins');
#Route::get('/team-copy/{id}', 'HomeController@getTeamCopy')->name('get-team-copy');