<?php
/*Alaa*/
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
define('AD', 'Administrator');
define('ADI', 'Administrator/include');
define('FE', 'Frontend');
define('FEI', 'Frontend/include');


// Route::get('/', function () {
//     return view(FE . '/home');
// });

Route::get('/{locale?}',  'HomeController@index');
/*
Route::get('countries', function()
{
  // return Countries::getList('en', 'html');
	return Countries::getOne('EG', 'en');
});
*/

Route::group(['middlewareGroups' => ['web']], function() {

    Auth::routes();

/*houida*/


         Route::get('{locale?}/about',FE. '\StaticpagesController@AboutPage');
         Route::get('{locale?}/contact-us',FE. '\StaticpagesController@ContactUsPage');


        Route::post('store',FE.'\StaticpagesController@store');

         Route::get('{locale?}/cases',FE.  '\CasesController@AllCases');
         Route::get('{locale?}/cases/filtering',FE.  '\CasesController@filtering');

         //Route::get('{locale?}/cases/searchview',FE.  '\CasesController@searchview');
          Route::get('{locale?}/cases/search',FE.  '\CasesController@search');
          Route::get('{locale?}/cases/searchFiltering',FE.  '\CasesController@searchFiltering');
        // Route::get('cases/search', ['as' => 'search', 'uses' => FE.'\CasesController@search']);




         Route::get('{locale?}/case/{id}',FE.  '\CasesController@SingleCase');
  Route::get('{locale?}/case/single_cases_filtering/{id}',FE.  '\CasesController@single_cases_filtering');


         Route::get('{locale?}/your-cases',FE.  '\CasesController@your_cases');
         Route::get('{locale?}/cases/your_cases_filtering',FE.  '\CasesController@your_cases_filtering');
  /*houida*/
    // Route::get('{locale?}/login', AD . '\AdminController@login');
    Route::get('{locale?}/logout', AD . '\AdminController@logout');
    Route::post('{locale?}/login', FE . '\UserController@user_login');
    Route::post('register', FE . '\UserController@store');

    // Route::get('{locale?}/redirect', 'SocialAuthFacebookController@redirect');
    // Route::get('{locale?}/callback', 'SocialAuthFacebookController@callback');

    Route::get('{locale?}/auth/facebook', 'SocialAuthFacebookController@redirectToProvider');
    Route::get('{locale?}/auth/facebook/callback', 'SocialAuthFacebookController@handleProviderCallback');

    // Route::resource('password/reset', AD . '\AdminController@reset_password');
    // Agent Area
    Route::get('{locale?}/lawyers', FE . '\UserController@list_lawyers');
   Route::get('{locale?}/lawyers/filtering', FE . '\UserController@filtering');
   Route::any('{locale?}/lawyers/search',FE.  '\UserController@search');
   Route::get('{locale?}/lawyers/searchFiltering',FE.  '\UserController@searchFiltering');

    Route::get('{locale?}/lawyer/{id}', FE . '\UserController@lawyer');
  Route::get('{locale?}/lawyer/lawyer_cases_filtering/{id}',FE.  '\UserController@lawyer_cases_filtering');


    Route::any('cities_country/{id?}', FE . '\CitiesController@cities_country');
    Route::post('set_your_bids/{case_id}', FE . '\BidsController@set_your_bids');
    Route::any('{locale?}/apply-bids', FE . '\BidsController@apply_bids');

      Route::group(['middleware' => 'auth'], function() {

        Route::get('{locale?}/edit-profile/{id}', FE . '\UserController@edit');
        Route::post('update-profile/{id}', FE . '\UserController@update');
        Route::post('change-password/{id}', FE . '\UserController@changePassword');

      // lawyer Area
        Route::group(['middleware' => 'Permission:lawyer'], function() {

        });

        // lawyer Area
        //  Route::group(['middleware' => 'Permission:client'], function() {
             /*houida*/
                Route::get('{locale?}/create',FE.  '\CasesController@index');
                Route::post('create-case',FE.'\CasesController@create_case');

                 Route::get('{locale?}/edit-case/{GUID}', FE. '\CasesController@edit');
                Route::post('update-case/{GUID}', FE. '\CasesController@update');

                Route::get('{locale?}/delete-case/{GUID}', FE. '\CasesController@delete');
            /*houida*/

    //      });

// Admin Area
      Route::group(['middleware' => 'Permission:admin'], function() {

        Route::resource('{locale?}/admins', AD . '\AdminController');
        Route::get('create', AD . '\AdminController@create');
        Route::post('delete_select_admins', AD . '\AdminController@DeleteSelectedAdmins');
        });

    });
  });





// Route::get('/home', 'HomeController@index')->name('home');
