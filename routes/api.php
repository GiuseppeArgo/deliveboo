<?php

use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\Api\DishOrderController;
use App\http\Controllers\Api\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// route api Restaurants
Route::get('/restaurants', [RestaurantController::class, 'index']);

Route::get('/restaurants/{slug}', [RestaurantController::class, 'show']);

// route api Types
Route::get('/types', [TypeController::class, 'index']);

//route api DishOrder
Route::post('/dishorders',[DishOrderController::class, 'store']);

//route api Order
Route::post('/orders',[OrderController::class, 'store']);

//route for braintree token

Route::get('/generatetoken', [CheckoutController::class, 'generateToken']);


//route for braintree make payment

Route::post('/makepayment', [CheckoutController::class, 'makePayment']);