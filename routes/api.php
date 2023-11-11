<?php

use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\OrderController;
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
Route::post('/login', [AuthenticationController::class, 'login']);
//


//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::put('user/edit', [AuthenticationController::class, 'editUser']);

    //address
    Route::resource('addresses', AddressController::class);
    Route::post('addresses/{address}', [AddressController::class, 'setActiveAddress']);

    //restaurant
    Route::apiResource('apiRestaurant', RestaurantController::class);
    Route::get('apiRestaurant/{id}/foods', [RestaurantController::class, 'food']);

    //orders
    Route::get('carts', [OrderController::class, 'getCards']);
    Route::post('carts/add', [OrderController::class, 'add']);
    Route::put('carts/update', [OrderController::class, 'update']);
    Route::get('carts/{cartId}', [OrderController::class, 'getCard'])->whereNumber('cartId');
    Route::post('carts/{cartId}/pay', [OrderController::class, 'payCard'])->whereNumber('cartId');
    Route::delete('carts/delete', [OrderController::class, 'destroy']);


    //comments
    Route::post('comments', [CommentController::class, 'store']);
    Route::get('comments', [CommentController::class, 'index']);


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
