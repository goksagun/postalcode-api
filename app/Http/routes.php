<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', 'HomeController@getHome');

$app->get('consumers', 'ConsumerController@getConsumers');
$app->get('consumer/create', 'ConsumerController@getCreate');
$app->post('consumer/create', 'ConsumerController@postCreate');
$app->get('consumer/{id:[0-9]+}', 'ConsumerController@getConsumer');
$app->get('consumer/{id:[0-9]+}/settings', 'ConsumerController@getSettings');
$app->post('consumer/{id:[0-9]+}/settings', 'ConsumerController@postSettings');
$app->get('consumer/{id:[0-9]+}/recreate-keys', 'ConsumerController@getRecreateKeys');
$app->get('consumer/{id:[0-9]+}/tokens', 'ConsumerController@getTokens');
$app->get('consumer/{id:[0-9]+}/create-tokens', 'ConsumerController@getCreateTokens');
$app->get('consumer/{id:[0-9]+}/recreate-tokens/{tokenId:[0-9]+}', 'ConsumerController@getRecreateTokens');
$app->get('consumer/{id:[0-9]+}/revoke-tokens/{tokenId:[0-9]+}', 'ConsumerController@getRevokeTokens');

$app->get('auth/register', 'AuthController@getRegister');
$app->get('auth/login', 'AuthController@getLogin');
$app->post('auth/register', 'AuthController@postRegister');
$app->post('auth/login', 'AuthController@postLogin');
$app->get('auth/logout', 'AuthController@getLogout');

$app->group(['prefix' => 'api'], function (Laravel\Lumen\Application $app) {
    $app->get('provinces', 'App\Http\Controllers\ProvinceController@getAllProvinces');
    $app->get('province/{id}', 'App\Http\Controllers\ProvinceController@getProvince');
    $app->post('province', 'App\Http\Controllers\ProvinceController@postProvince');
    $app->put('province/{id}', 'App\Http\Controllers\ProvinceController@putProvince');
    $app->delete('province/{id}', 'App\Http\Controllers\ProvinceController@deleteProvince');
    $app->get('province/{id}/districts', 'App\Http\Controllers\ProvinceController@getProvinceDistricts');

    $app->get('districts', 'App\Http\Controllers\DistrictController@getAllDistrict');
    $app->get('district/{id}', 'App\Http\Controllers\DistrictController@getDistrict');
    $app->post('district', 'App\Http\Controllers\DistrictController@postDistrict');
    $app->get('district/{id}/neighborhoods', 'App\Http\Controllers\DistrictController@getDistrictNeighborhoods');

    $app->get('neighborhoods', 'App\Http\Controllers\NeighborhoodController@getAllNeighborhood');
    $app->get('neighborhood/{id}', 'App\Http\Controllers\NeighborhoodController@getNeighborhood');
    $app->post('neighborhood', 'App\Http\Controllers\NeighborhoodController@postNeighborhood');
    $app->get('neighborhood/{id}/suburbs', 'App\Http\Controllers\NeighborhoodController@getNeighborhoodSuburbs');

    $app->get('suburbs', 'App\Http\Controllers\SuburbController@getAllSuburb');
    $app->get('suburb/{id}', 'App\Http\Controllers\SuburbController@getSuburb');
    $app->post('suburb', 'App\Http\Controllers\SuburbController@postSuburb');
});

