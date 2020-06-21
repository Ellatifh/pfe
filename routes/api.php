<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('login', function () {
   return response(['status'=>false,"message"=>"Unauthorized ! You're not authenticated"],403)
                  ->header('Content-Type', 'application/json');
})->name('login');
Route::prefix('v1')->group(function(){
    Route::post('login', 'Api\AuthController@login');
    Route::post('signup', 'Api\AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function(){
        /****** AUTHENTICATION */
        Route::post('logout', 'Api\AuthController@logout');
        Route::get('user', 'Api\AuthController@user');
        /****** END AUTHENTICATION */

        Route::apiresource('cities', 'Api\CitieController');
        Route::apiresource('categories', 'Api\CategorieController');
        Route::apiresource('cultures', 'Api\CultureController');
        Route::apiresource('events', 'Api\EventController');
        Route::apiresource('hebergements', 'Api\HebergementController');
        Route::apiresource('infos', 'Api\InfosController');
        Route::apiresource('loisirs', 'Api\LoisirController');
        Route::apiresource('medias', 'Api\MediaController');
        Route::apiresource('restaurants', 'Api\RestaurantController');
        Route::apiresource('shoppings', 'Api\ShoppingController');
    });
});
