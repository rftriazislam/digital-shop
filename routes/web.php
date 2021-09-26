<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes(['verify' => true]);
Auth::routes();

Route::get('/', 'FrontendController@home')->name('home');

Route::get('/login', 'FrontendController@login')->name('login');

Route::get('/refer/{refer_id}', 'FrontendController@refer')->name('refer');

Route::get('-affiliate-{id}-{form_name}', 'FrontendController@addcartpage')->name('affiliate_link');


Route::post('/login-popup', 'FrontendController@loginpopup')->name('loginpopup');

Route::get('/logout-logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/signup ', 'FrontendController@signup');

Route::post('/send-mail', 'EmailController@sendemail')->name('sendemail');

Route::get('/terms-conditions', 'FrontendController@terms_conditions')->name('terms_conditions');
Route::get('/privacy-policy', 'FrontendController@privacy_policy')->name('privacy_policy');


Route::get('/send-me89-eiu', 'EmailController@resetmessage')->name('sendmessgae');

Route::get('/reset-password/{token}', 'ResetController@resetpassword');

Route::post('/reset-password', 'ResetController@updatepassword')->name('updatepassword');

Route::post('/wish-list', 'LoadAjaxController@wishlist')->name('wishlist');

Route::get('/total-wish-list', 'LoadAjaxController@totalwish')->name('totalwishlist');


Route::get('/forget-password', 'EmailController@forgetpassword')->name('forgetpassword');


Route::post('/code-register', 'EmailController@register')->name('register_ter');

Route::get('/confirm-register', 'EmailController@confirmregister')->name('confirmregister');

Route::post('/code-verify-login', 'EmailController@login')->name('verifylogin');


// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/category/{form_name}', 'FrontendController@category')->name('category');

Route::get('/sub-category', 'FrontendController@subcategory')->name('subcategory');



Route::post('/search-suggetion', 'LoadAjaxController@searchsuggetion')->name('searchsuggetion');

Route::post('/search-products', 'FrontendController@search_product')->name('search_product');




Route::get('/single-subcategory/{subcategory_id}/{form_name}', 'FrontendController@singlesubcategory')->name('singlesubcategory');


Route::get('/product', 'FrontendController@product')->name('product');
Route::get('/add-cart/{id}/{form_name}', 'FrontendController@addcartpage')->name('addcart');
Route::get('/cart-page', 'FrontendController@cartpage')->name('cartpage');
Route::post('/checkout-page', 'FrontendController@checkout')->name('checkout');
Route::post('/confirm-page', 'FrontendController@checkoutsave')->name('checkoutsave');
Route::post('/payment-complete', 'FrontendController@paymentcomplete')->name('paymentcomplete');



Route::post('/payment-complete-details', 'PaymentController@paymentcompletedetails')->name('shurjopay.response');

Route::get('/paymentissue', 'PaymentController@paymentissue')->name('paymentissue');

// Route::get('/payment-issue', 'PaymentController@paymentissue')->name('paymentissue');





//-------------------------cart controller-----------------------------------------
Route::post('/add-to-cart', 'Cartcontroller@addtocart')->name('addtocart');

Route::post('/js-cartpage', 'Cartcontroller@jscartpage')->name('jscartpage');
Route::post('/singleproductremove', 'Cartcontroller@singleproductremove')->name('singleproductremove');
Route::post('/cartupdate', 'Cartcontroller@cartupdate')->name('cartupdate');

Route::post('/load_data', 'Cartcontroller@cartdata')->name('load_data');
Route::get('/add-too-cart/{id}', 'Cartcontroller@addtoocart')->name('addtoocart');


//-------------------------cart controller-----------------------------------------

Route::group(['middleware' => ['auth', 'admin'],], function () {

    Route::get('/admin', 'AdminController@index')->name('admin');

    Route::get('/admin-myprofile', 'AdminController@myprofile')->name('admin.myprofile');
    Route::post('/admin-profile-update', 'AdminController@profile_update')->name('admin.profile_update');

    Route::get('/admin-category', 'Admin\CategoryController@category')->name('admin.category');
    Route::post('/admin-category-save', 'Admin\CategoryController@categorysave')->name('admin.categorysave');
    Route::get('/admin-category-status/{status}/{id}', 'Admin\CategoryController@categorystatus');
    Route::get('/admin-category-delete/{id}', 'Admin\CategoryController@categorydelete');
    Route::get('/admin-category-edit/{id}', 'Admin\CategoryController@categoryedit');
    Route::post('/admin-category-updated', 'Admin\CategoryController@categoryupdated')->name('admin.categoryupdated');

    Route::get('/admin-commission', 'AdminController@commission')->name('admin.commission');
    Route::get('/admin-commission-set/{id}', 'AdminController@commissionset');
    Route::post('/admin-commission-updated', 'AdminController@commissionupdated')->name('admin.commissionupdated');


    Route::get('/admin-sub-category', 'Admin\SubcategoryController@subcategory')->name('admin.subcategory');
    Route::post('/admin-sub-category-save', 'Admin\SubcategoryController@subcategorysave')->name('admin.subcategorysave');
    Route::get('/admin-sub-category-status/{status}/{id}', 'Admin\SubcategoryController@subcategorystatus');
    Route::get('/admin-sub-category-delete/{id}', 'Admin\SubcategoryController@subcategorydelete');
    Route::get('/admin-sub-category-edit/{id}', 'Admin\SubcategoryController@subcategoryedit');
    Route::post('/admin-sub-category-updated', 'Admin\SubcategoryController@subcategoryupdated')->name('admin.subcategoryupdated');

    Route::get('/admin-product-permission/{form_name}', 'Admin\ProductPermissionController@productpermission')->name('product_permission');
    Route::get('/admin-status/{id}/{status}/{form_name}', 'Admin\ProductPermissionController@productstatus')->name('admin.status');
    Route::get('/admin.product.delete/{id}/{form_name}', 'Admin\ProductPermissionController@productdelete')->name('admin.product.delete');
    Route::get('/admin.product.view/{id}/{form_name}', 'Admin\ProductPermissionController@productview')->name('admin.product.view');

    // Route::get('/admin.product.decline/{id}/{form_name}', 'Admin\ProductPermissionController@productdecline')->name('admin.product.decline');
    Route::post('/admin-reject-message', 'Admin\ProductPermissionController@productdecline')->name('reject_message');


    Route::get('/admin-permission-make-payment', 'AdminController@permissionmakemoney')->name('permission_makemoney');
    Route::get('/admin-social-status/{id}/{status}', 'AdminController@socialstatus')->name('admin.social-status');
    Route::get('/admin-make-status/{id}/{status}', 'AdminController@makestatus')->name('admin.make-status');

    Route::get('/admin-withdraw', 'AdminController@withdraw')->name('admin.withdraw');
    Route::get('/admin-withdraw-view/{id}', 'AdminController@withdraw_view')->name('admin.withdraw_view');
    Route::post('/admin-withdraw-save', 'AdminController@withdraw_save')->name('admin.withdraw_save');

    Route::get('/admin-tutorial-video', 'AdminController@tutorial_video')->name('tutorial_video');
    Route::post('/admin-save-tutorial-video', 'AdminController@save_tutorial')->name('save_tutorial');

    Route::get('/admin-youtube-status/{id}', 'AdminController@youtubestatus');
    Route::get('/admin-youtube-delete/{id}', 'AdminController@youtubedelete');
    Route::get('/admin-youtube-edit/{id}', 'AdminController@youtubeedit');
    Route::post('/admin-update-tutorial-video', 'AdminController@update_tutorial')->name('update_tutorial');

    Route::get('/admin-discount', 'DiscountController@discount')->name('discount');
    Route::post('/admin-add-discount', 'DiscountController@add_discount')->name('admin.add_discount');

    Route::get('/admin-customer-list', 'AdminController@customer_list')->name('admin.customer_list');
});

Route::group(['middleware' => ['auth', 'customer'],], function () {

    Route::get('/dashboard', 'CustomerController@index')->name('customer');
    Route::get('/myprofile', 'CustomerController@myprofile')->name('customer.myprofile');
    Route::post('/profile-update', 'CustomerController@profile_update')->name('customer.profile_update');

    Route::get('/customer-product/{form_name}', 'CustomerController@product')->name('customer.product');
    Route::post('/get-add-product', 'CustomerController@addproduct')->name('customer.addpoduct');

    Route::post('/validate_product', 'CustomerController@validate_product')->name('validate_product');



    Route::post('/customer-save-socialmedia', 'CustomerController@savesocialmedia')->name('customer.savesocialmedia');

    Route::get('/customer-social-delete/{id}', 'CustomerController@socialdelete')->name('customer.social-delete');

    Route::post('/customer-save-payment', 'CustomerController@savemakepayment')->name('customer.savemakepayment');

    Route::get('/customer-makepayment-delete/{id}', 'CustomerController@makepaymentdelete')->name('customer.makepayment-delete');

    Route::post('/customer-save-influence', 'CustomerController@saveinfluence')->name('customer.saveinfluence');

    Route::get('/customer-influence-delete/{id}', 'CustomerController@influencedelete')->name('customer.influence-delete');

    Route::post('/customer-save-giftcard', 'CustomerController@savegiftcard')->name('customer.savegiftcard');
    Route::get('/customer-giftcard-delete/{id}', 'CustomerController@giftcarddelete')->name('customer.giftcard-delete');

    Route::post('/customer-save-savesubscription', 'CustomerController@savesubscription')->name('customer.savesubscription');
    Route::get('/customer-subscription-delete/{id}', 'CustomerController@subscriptiondelete')->name('customer.subscription-delete');


    Route::post('/customer-save-savedigitalwallet', 'CustomerController@savedigitalwallet')->name('customer.savedigitalwallet');
    Route::get('/customer-digitalwallet-delete/{id}', 'CustomerController@digitalwalletdelete')->name('customer.digitalwallet-delete');

    Route::post('/customer-save-saveadvertisementaccount', 'CustomerController@saveadvertisementaccount')->name('customer.saveadvertisementaccount');

    Route::get('/customer-advertisementaccount-delete/{id}', 'CustomerController@advertisementaccountdelete')->name('customer.advertisementaccount-delete');


    Route::post('/customer-save-social-promotion', 'CustomerController@savesocialmediapromotion')->name('customer.savesocialmediapromotion');

    Route::get('/customer-socialmediapromotion-delete/{id}', 'CustomerController@socialmediapromotiondelete')->name('customer.socialmediapromotion-delete');


    Route::post('/customer-savesave-top-up-apps', 'CustomerController@savetopupapps')->name('customer.savetopupapps');
    Route::get('/customer-topupapps-delete/{id}', 'CustomerController@topupappsdelete')->name('customer.topupapps-delete');


    Route::post('/customer-save-games-zone', 'CustomerController@savegameszone')->name('customer.savegameszone');

    Route::get('/customer-gameszone-delete/{id}', 'CustomerController@gameszonedelete')->name('customer.gameszone-delete');


    Route::get('/customer-sell-orders', 'CustomerController@sell_orders')->name('customer.sell_orders');

    Route::get('/customer-referral-link', 'CustomerController@referral_link')->name('customer.referral_link');


    Route::get('/customer-referral-link', 'CustomerController@referral_link')->name('customer.referral_link');


    Route::post('/customer-order-delivery', 'CustomerController@order_delivery')->name('customer.order_delivery');

    Route::post('/customer-delivery-confirm', 'CustomerController@delivery_confirm')->name('customer.delivery_confirm');

    Route::post('/customer-buyer-checking', 'CustomerController@buyer_checking')->name('customer.buyer_checking');
    Route::post('/customer-buyer-comfirm', 'CustomerController@buyer_comfirm')->name('customer.buyer_comfirm');



    Route::get('/customer-buy-orders', 'CustomerController@buy_orders')->name('customer.buy_orders');
    Route::get('/get-subcategory-list', 'CustomerController@getsubcategory')->name('getsubcategory');




    Route::get('/get-withdraw', 'CustomerController@balance_withdraw')->name('balance_withdraw');
    Route::post('/withdraw', 'CustomerController@withdraw')->name('customer.withdraw');
    Route::post('/withdraw-compelete', 'CustomerController@withdraw_compelete')->name('withdraw_compelete');
    Route::get('/withdraw-checking/{id}', 'CustomerController@withdraw_checking')->name('customer.withdraw_checking');
    Route::post('/total_balance', 'LoadAjaxController@total_balance')->name('total_balance');
    // Route::post('/response', 'smasif\ShurjopayLaravelPackage\ShurjopayController@response')->name('shurjopay.response');

    Route::get('/tutorial', 'CustomerController@tutorial')->name('tutorial');
    Route::get('/play-youtube/{id}', 'CustomerController@playvideo')->name('playvideo');

    Route::get('/apps', 'CustomerController@apps')->name('apps');
    Route::get('/customer-reject/{id}/{form_code}', 'CustomerController@customer_reject')->name('customer.reject');
    Route::post('/customer-reject-message', 'CustomerController@reject_message')->name('customer.reject_message');

    Route::get('/customer-update/{id}/{form_code}', 'CustomerController@customer_update')->name('customer.productedit');
    Route::post('/customer-update-product', 'CustomerController@updateproduct')->name('customer.updateproduct');
});

// load more ajax
Route::get('/loadmore', 'LoadAjaxController@index');

Route::post('/load_data', 'LoadAjaxController@load_data')->name('load_data');
Route::get('/payment-issue-app', 'Api\PaymentController@payment_issue')->name('payment_issue_apps');


Route::any('{slug}', 'FrontendController@invalid');