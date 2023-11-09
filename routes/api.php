<?php

use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\RestaurantController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



//public routes
Route::post('/register', [AuthenticationController::class, 'register']);
//Route::get('/login', [AuthenticationController::class, 'login']);
Route::post('/login', [AuthenticationController::class, 'login']);



//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::put('user/edit', [AuthenticationController::class, 'editUser'])->name('user.Edit');

    //address
    Route::resource('addresses', AddressController::class);
    Route::post('addresses/{address}', [AddressController::class, 'setActiveAddress'])->name('Address.setActiveAddress');

    //restaurant
    Route::apiResource('apiRestaurant', RestaurantController::class);
    Route::get('apiRestaurant/{id}/foods', [RestaurantController::class, 'food']);



});








Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




//
//Route::middleware('auth:sanctum')->group(function(){
//    # logout
//    Route::post('logout',[AuthController::class,'logout'],);
//    # Address PART
//    Route::get('addresses',[AddressesController::class,'getAddresses']);
//    Route::post('addresses',[AddressesController::class,'addAddress']);
//    Route::get('addresses/{address_id}',[AddressesController::class,'setCurrent']);
//
//    # Restaurant PART
//    Route::get('restaurants/{restaurant_id}',[RestaurantsController::class,'getRestaurantInfo']);
//    Route::get('restaurants',[RestaurantsController::class,'getRestaurants']);
//
//    # Food PART
//    Route::get('restaurants/{restaurant_id}/foods',[FoodController::class,'getFoods']);
//
//    #cards
//    Route::get('carts',[CartController::class,'getCarts']);
//    Route::post('carts/add',[CartController::class,'addCart']);
//    Route::patch('carts/add',[CartController::class,'update']);
//    Route::get('carts/{cart_id}',[CartController::class,'show']);
//
//    #Payment
//    Route::post('carts/{cart}/pay',[OrderController::class , 'addCart']);
//
//});
