<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\StatsController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//route with auth
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        //DASHBOARD INDEX
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        //RESTAURANTS RESOURCE
        Route::resource('restaurants', RestaurantController::class)->except(['show'])->parameters(['restaurants' => 'restaurant:slug']);

        // DISHES RESOURCE
        Route::resource('dishes', DishController::class)->parameters(['dishes' => 'dish:slug']);

        //DISHES TOOGLE
        Route::put('/dishes/{id}/toggle', [DishController::class, 'toggle'])->name('dishes.toggle');

        //ORDERS RESOURCE
        Route::resource('orders', OrderController::class);

        //STATS CONTROLLER
        Route::get('/stats', [StatsController::class, 'index'])->name('stats.index');

        //LEAD RESOURCE
        // route::post('/leads', [LeadController::class, 'store']);

        // NOT FOUND PAGE
        Route::fallback(function () {
            abort(404, 'Pagina non trovata');
        });
    });

require __DIR__ . '/auth.php';
