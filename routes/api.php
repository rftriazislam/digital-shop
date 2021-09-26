<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\GetController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\DiscountController;


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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//1
Route::post('/signup', [AuthController::class, 'signup']);
//2
Route::post('/signin', [AuthController::class, 'signin']);
//3
Route::get('/products', [GetController::class, 'products']);
//4
Route::get('/all-products', [GetController::class, 'all_products']);

Route::group(['middleware' => 'auth:api'], function () {

    Route::post('/profile-update/{user_id}', [AuthController::class, 'profileupdate']);
    //5
    Route::post('/social-product-add', [PostController::class, 'socialproductadd']);
    //6
    Route::post('/make-payment-add', [PostController::class, 'makepaymentadd']);
    //7
    Route::post('/influence-marketing-add', [PostController::class, 'influencemarketing']);
    //29
    Route::post('/gift-card-add', [PostController::class, 'giftcard']);
    //30
    Route::post('/subscription-add', [PostController::class, 'subscription']);
    //32
    Route::post('/digital-wallet-add', [PostController::class, 'digital_wallet']);
    //33
    Route::post('/advertisement-account-add', [PostController::class, 'advertisementaccount']);


    //36
    Route::post('/social-media-promotion-add', [PostController::class, 'social_media_promotion']);
    //37
    Route::post('/top-up-add', [PostController::class, 'top_up']);
    //38
    Route::post('/games-zone-add', [PostController::class, 'games_zone']);


    //34
    Route::post('/wish-list-add', [PostController::class, 'wishlist']);
    //35
    Route::post('/wish-list-remove', [PostController::class, 'wishlistremove']);


    //16
    Route::post('/buy-product', [PostController::class, 'buy_product']);
    //17
    Route::get('/order-history/{user_id}', [GetController::class, 'order_history']);

    //18
    Route::get('/profile/{user_id}', [AuthController::class, 'profile']);
    //19 not compelete
    Route::post('/forgot-password', [AuthController::class, 'forgot_password']);
    //21
    Route::post('/order-confirm-seller', [PostController::class, 'order_comfirm_seller']);
    //22
    Route::get('/order-image/{order_id}', [GetController::class, 'order_image']);
    //23
    Route::post('/order-confirm-buyer', [PostController::class, 'order_comfirm_buyer']);
    //24
    Route::post('/report-order', [PostController::class, 'report_order']);
    //25
    Route::post('/change-password', [AuthController::class, 'change_password']);
    //26

    //44 payment

    Route::post('/payment-complete', [PaymentController::class, 'paymentcomplete']);

    //49
    Route::get('/favorite-products/{id}', [GetController::class, 'favorite_products']);
    //50 
    Route::get('/all-favorite-products/{id}', [GetController::class, 'all_favorite_products']);
});

//45 response paymentresponse

Route::post('/payment-response', [PaymentController::class, 'paymentresponse']);

//20
Route::get('/search-products', [GetController::class, 'searchproducts']);
//8
Route::get('/categories', [DataController::class, 'categories']);

//9
Route::get('/all-subcategory/{category_id}', [DataController::class, 'allsubcategory']);

//14
Route::get('/single-product/{form_name}/{product_id}', [GetController::class, 'singleproduct']);


//15
Route::get('/all-single-product/{form_name}/{subcategory_id}', [DataController::class, 'allsingleproduct']);
//11
Route::get('/social-products', [GetController::class, 'socialproducts']);
//12
Route::get('/make-payment-products', [GetController::class, 'makepaymentproducts']);
//13
Route::get('/influence-products', [GetController::class, 'influenceproducts']);
//27
Route::get('/giftcard-products', [GetController::class, 'giftcards']);
//28
Route::get('/subscription-products', [GetController::class, 'subscriptions']);

//39
Route::get('/digital-wallet-products', [GetController::class, 'digital_wallets']);
//40
Route::get('/advertisement-account-products', [GetController::class, 'advertisement_accounts']);
//41
Route::get('/social-media-promotion-products', [GetController::class, 'socialmedia_promotions']);
//42
Route::get('/top-up-apps-products', [GetController::class, 'toupapps']);
//43
Route::get('/games-zone-products', [GetController::class, 'gameszons']);



//31
Route::get('/money-exchange', [GetController::class, 'moneyexchange']);

//46
Route::get('/tutorial-video', [GetController::class, 'tutorial_video']);
//47
Route::get('/product-discount', [DiscountController::class, 'product_discount']);

//48
Route::get('/popular-products', [GetController::class, 'popular_products']);