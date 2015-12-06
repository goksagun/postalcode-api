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

$app->get('password/email', 'PasswordController@getEmail');
$app->post('password/email', 'PasswordController@postEmail');

$app->get('password/reset/{token}', 'PasswordController@getReset');
$app->post('password/reset/{token}', 'PasswordController@postReset');

$app->group(['prefix' => 'api'], function (Laravel\Lumen\Application $app) {
    $app->get('provinces', 'App\Http\Controllers\ProvinceController@getAllProvinces');
    $app->get('provinces/{id}', 'App\Http\Controllers\ProvinceController@getProvince');
    $app->post('provinces', 'App\Http\Controllers\ProvinceController@postProvince');
    $app->put('provinces/{id}', 'App\Http\Controllers\ProvinceController@putProvince');
    $app->delete('provinces/{id}', 'App\Http\Controllers\ProvinceController@deleteProvince');
    $app->get('provinces/{id}/districts', 'App\Http\Controllers\ProvinceController@getProvinceDistricts');

    $app->get('districts', 'App\Http\Controllers\DistrictController@getAllDistricts');
    $app->get('districts/{id}', 'App\Http\Controllers\DistrictController@getDistrict');
    $app->post('districts', 'App\Http\Controllers\DistrictController@postDistrict');
    $app->get('districts/{id}/neighborhoods', 'App\Http\Controllers\DistrictController@getDistrictNeighborhoods');

    $app->get('neighborhoods', 'App\Http\Controllers\NeighborhoodController@getAllNeighborhoods');
    $app->get('neighborhoods/{id}', 'App\Http\Controllers\NeighborhoodController@getNeighborhood');
    $app->post('neighborhoods', 'App\Http\Controllers\NeighborhoodController@postNeighborhood');
    $app->get('neighborhoods/{id}/suburbs', 'App\Http\Controllers\NeighborhoodController@getNeighborhoodSuburbs');

    $app->get('suburbs', 'App\Http\Controllers\SuburbController@getAllSuburbs');
    $app->get('suburbs/{id}', 'App\Http\Controllers\SuburbController@getSuburb');
    $app->post('suburbs', 'App\Http\Controllers\SuburbController@postSuburb');
});

