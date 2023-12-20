<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\ProductController;

Route::get('/',[HomeController::class,'index'])->name('index');

// Auth
Route::get('/user-login',[AuthController::class,'login'])->name('login');
Route::post('/user-login-submit',[AuthController::class,'submitLogin'])->name('submit_login');
Route::get('/user-logout',[AuthController::class,'logout'])->name('logout');
Route::get('/user-signup',[AuthController::class,'signup'])->name('signup');
Route::POST('/user-signup-submit',[AuthController::class,'submitSignup'])->name('submit_signup');

// My Account
Route::get('/my-account',[CustomerController::class,'myAccount'])->name('myaccount');
Route::get('/my-account/orders',[CustomerController::class,'myOrder'])->name('myaccount_orders');
Route::get('/my-account/order-detail/{$id}',[CustomerController::class,'myOrderDetail'])->name('myaccount_order_detail');
Route::get('/my-account/wishlist',[CustomerController::class,'myWishlist'])->name('myaccount_wishlist');
Route::get('/my-account/address',[CustomerController::class,'myAddress'])->name('myaccount_address');
Route::get('/my-account/address-add',[CustomerController::class,'myAddressAdd'])->name('myaccount_address_add');
Route::get('/my-account/address-edit/$id}',[CustomerController::class,'myAddressEdit'])->name('myaccount_address_edit');
Route::get('/my-account/address-delete/$id}',[CustomerController::class,'myAddressDelete'])->name('myaccount_address_delete');
Route::get('/my-account/profile-edit',[CustomerController::class,'myProfileEdit'])->name('myaccount_profile_edit');
Route::POST('/my-account/profile-submit',[CustomerController::class,'submitProfile'])->name('myaccount_profile_submit');
Route::get('/my-account/password-change',[CustomerController::class,'myPasswordChange'])->name('myaccount_password_change');
Route::POST('/my-account/password-submit',[CustomerController::class,'submitPassword'])->name('myaccount_password_submit');

// Content
Route::get('/content/{slug}',[ContentController::class,'content_by_slug'])->name('content');

// Shopping
Route::POST('/ajax/submit-addcart',[ShoppingController::class,'submitAddCart'])->name('submit_addcart');
Route::POST('/ajax/submit-editcart',[ShoppingController::class,'submitEditCart'])->name('submit_editcart');
Route::POST('/ajax/submit-deletecart',[ShoppingController::class,'submitDeleteCart'])->name('submit_deletecart');
Route::get('/shopping-cart',[ShoppingController::class,'cart'])->name('shopping_cart');
Route::get('/check-out',[ShoppingController::class,'checkOut'])->name('check_out');
Route::POST('/checkout-submit-addaddress',[ShoppingController::class,'submitAddAddress'])->name('submit_addaddress');
Route::get('/thank-you-for-shopping-with-us',[CustomerController::class,'index'])->name('thankyou_shopping');

// Product
Route::get('/products/celebrity-special',[ProductController::class,'products_celebrity'])->name('products_celebrity');
Route::get('/products/new-arrival',[ProductController::class,'products_newarrival'])->name('products_newarrival');
Route::get('/products/festival-special',[ProductController::class,'products_festival'])->name('products_festival');
Route::get('/products/deal-of-the-day',[ProductController::class,'products_deal'])->name('products_deal');
Route::get('products/search',[ProductController::class,'products_search'])->name('products_search');
Route::get('/products/{slug}',[ProductController::class,'products_ptype'])->name('products_ptype');
// ?collection=collectionslug&color=1&size=3&plate=gold
Route::get('/product/{slug}',[ProductController::class,'product_detail'])->name('product_detail');

// Other
Route::get('/404-page-not-found',[ContentController::class,'notFound'])->name('not_found');