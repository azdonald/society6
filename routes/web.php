<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/register', ['uses' => 'UserController@register']);
$router->post('/login', ['uses' => 'UserController@login']);

// Creatives
$router->post('/creatives', ['middleware' => 'token', 'uses' => 'CreativeController@create']);
$router->get('/creatives', ['uses' => 'CreativeController@getAll']);
$router->get('/creatives/{id}', ['uses' => 'CreativeController@getCreative']);
$router->put('/creatives/{id}', ['uses' => 'CreativeController@update']);

// Products
$router->post('/products', ['middleware' => 'token', 'uses' => 'ProductController@create']);
$router->get('/products', ['uses' => 'ProductController@getAllProducts']);
$router->get('/products/{id}', ['uses' => 'ProductController@getProduct']);
$router->put('/products/{id}', ['uses' => 'ProductController@update']);

// Orders
$router->post('/orders', ['uses' => 'OrderController@create']);
$router->get('/orders', ['uses' => 'OrderController@getAllOrders']);
$router->get('/orders/{id}', ['uses' => 'OrderController@getOrder']);
$router->put('/orders/{id}', ['uses' => 'OrderController@update']);


// Vendors
$router->group(['prefix' => 'vendors'], function () use ($router){
    $router->post('register', ['uses' => 'VendorController@register']);
    $router->post('login', ['uses' => 'VendorController@login']);
    $router->get('orders', ['middleware' => 'token', 'uses' => 'VendorController@getOrders']);
    $router->post('notify', ['middleware' => 'token', 'uses' => 'VendorController@notifyShipped']);
});
