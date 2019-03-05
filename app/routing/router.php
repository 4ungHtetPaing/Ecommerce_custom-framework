<?php

namespace App\Routing;

use App\Routing\RouteDispatcher;

$router = new \AltoRouter;


$router->setBasePath("/E-commerce/public");

$router->map("GET", "/admin","App\Controllers\AdminController@index","Admin Home");

$router->map("GET", "/","App\Controllers\HomeController@index","home");
$router->map("POST", "/cart","App\Controllers\HomeController@cart","cart");
$router->map("GET", "/cart","App\Controllers\HomeController@showCart","showCart");
$router->map("POST", "/payout","App\Controllers\HomeController@payout","payout");
$router->map("GET", "/detail/[i:id]","App\Controllers\HomeController@show","detail");

$router->map("GET", "/admin/category/category","App\Controllers\CategoryController@index","Category Home");
$router->map("GET", "/admin/category/create","App\Controllers\CategoryController@create","Category Create");
$router->map("POST", "/admin/category/create","App\Controllers\CategoryController@store","Category Store");
$router->map("GET", "/admin/category/delete/[i:id]","App\Controllers\CategoryController@delete","Category Delete");
$router->map("POST", "/admin/category/[i:id]/update","App\Controllers\CategoryController@update","Category Update");

// Payment
$router->map("POST", "/payment/stripe", "App\Controllers\PaymentController@stripePayment","Stripe Payment");

// Sub Category Route*****************

$router->map("POST", "/admin/sub_category/create/[i:id]","App\Controllers\SubCategoryController@store","SubCategory Create");
$router->map("GET", "/admin/sub_category/home", "App\Controllers\SubCategoryController@index", "SubCategory Home");
$router->map("POST", "/admin/sub_category/update/[i:id]", "App\Controllers\SubCategoryController@update", "SubCategory Update");
$router->map("GET", "/admin/sub_category/delete/[i:id]","App\Controllers\SubCategoryController@delete","SubCategory Delete");

// Product Route

$router->map("GET", "/admin/product/home", "App\Controllers\ProductController@index", "Product Home");
$router->map("POST", "/admin/product/create", "App\Controllers\ProductController@store", "Product Create");
$router->map("GET", "/admin/product/delete/[i:id]", "App\Controllers\ProductController@delete", "Product Delete");


$router->map("GET", "/user/login", "App\Controllers\UserController@loginForm", "Login Form");
$router->map("POST", "/user/login", "App\Controllers\UserController@login", "Login");
$router->map("GET", "/user/register", "App\Controllers\UserController@registerForm", "Register Form");
$router->map("POST", "/user/register", "App\Controllers\UserController@register", "Register");
$router->map("GET", "/user/logout", "App\Controllers\UserController@logout", "Logout");

new RouteDispatcher($router);

?>