<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\ProductController;

Route::get('/',[HomeController::class,'index'])->name('index');

// Auth
Route::get('/user-login',[AuthController::class,'login'])->name('login');
Route::post('/user-login-submit',[AuthController::class,'submitLogin'])->name('submit_login');
Route::get('/user-logout',[AuthController::class,'logout'])->name('logout');
Route::get('/user-signup',[AuthController::class,'signup'])->name('signup');
Route::POST('/user-signup-submit',[AuthController::class,'submitSignup'])->name('submit_signup');
Route::get('/user-forgot-password',[AuthController::class,'forgot_password'])->name('forgot_password');
Route::POST('/user-forgot-submit',[AuthController::class,'submitForgotPassword'])->name('submit_forgot_pass');

// Auth Signup Two Steps
Route::GET('/user-step1-signup',[AuthController::class,'signup_step1'])->name('signup_step1');
Route::GET('/ajax/signup-step1',[AuthController::class,'submitSignupStep1'])->name('submit_signup_step1');
Route::GET('/user-step2-signup',[AuthController::class,'signup_step1'])->name('signup_step2');
Route::POST('/user-step2-signup-submit',[AuthController::class,'submitSignupStep1'])->name('submit_signup_step2');

// My Account
Route::get('/my-account',[CustomerController::class,'myAccount'])->name('myaccount');
Route::get('/my-account/orders',[CustomerController::class,'myOrder'])->name('myaccount_orders');
Route::get('/my-account/wishlist',[CustomerController::class,'myWishlist'])->name('myaccount_wishlist');
Route::get('/my-account/address',[CustomerController::class,'myAddress'])->name('myaccount_address');
Route::get('/my-account/address-add',[CustomerController::class,'myAddressAdd'])->name('myaccount_address_add');
Route::get('/my-account/address-edit/{id}',[CustomerController::class,'myAddressEdit'])->name('myaccount_address_edit');
Route::get('/my-account/address-default/{id}',[CustomerController::class,'myAddressDefault'])->name('myaccount_address_default');    
Route::get('/my-account/profile-edit',[CustomerController::class,'myProfileEdit'])->name('myaccount_profile_edit');
Route::get('/my-account/password-change',[CustomerController::class,'myPasswordChange'])->name('myaccount_password_change');
Route::GET('/my-account/submit-deladdress/{id}',[CustomerController::class,'submitDelAddress'])->name('myaccount_submit_deladdress');

Route::POST('/my-account/submit-addaddress',[CustomerController::class,'submitAddAddress'])->name('myaccount_submit_addaddress');
Route::POST('/my-account/submit-editaddress',[CustomerController::class,'submitEditAddress'])->name('myaccount_submit_editaddress');

Route::POST('/my-account/profile-submit',[CustomerController::class,'submitProfile'])->name('myaccount_profile_submit');
Route::POST('/my-account/password-submit',[CustomerController::class,'submitPassword'])->name('myaccount_password_submit');

// Content
Route::get('/content/{slug}',[ContentController::class,'content_by_slug'])->name('content');

// Cart
Route::GET('/ajax/cart-increaseQuantity',[CartController::class,'increaseQuantity']);
Route::GET('/ajax/cart-decreaseQuantity',[CartController::class,'decreaseQuantity']);
Route::GET('/ajax/cart-deleteProduct',[CartController::class,'deleteProduct']);
Route::GET('/ajax/cart-empty',[CartController::class,'empty']);

// Checkout
Route::GET('/check-out',[CheckoutController::class,'checkOut'])->name('check_out');
Route::POST('/checkout-submit-addaddress',[CheckoutController::class,'submitAddAddress'])->name('submit_addaddress');
Route::POST('/submit-order',[CheckoutController::class,'submitOrder'])->name('submit_order');

// Shopping
Route::POST('/ajax/submit-addcart',[ShoppingController::class,'submitAddCart'])->name('submit_addcart');
Route::get('/shopping-cart',[ShoppingController::class,'cart'])->name('shopping_cart');

// Product
Route::get('/products/celebrity-special',[ProductController::class,'products_celebrity'])->name('products_celebrity');
Route::get('/products/new-arrival',[ProductController::class,'products_newarrival'])->name('products_newarrival');
Route::get('/products/festival-special',[ProductController::class,'products_festival'])->name('products_festival');
Route::get('/products/deal-of-the-day',[ProductController::class,'products_deal'])->name('products_deal');
Route::get('products/search',[ProductController::class,'products_search'])->name('products_search');    // ?s=string
Route::get('/products/{slug}',[ProductController::class,'products_ptype'])->name('products_ptype');
// ?collection=1,2&color=1,2&minprice=3&maxprice=3&custom=value
Route::get('/product/{slug}',[ProductController::class,'product_detail'])->name('product_detail');

// Fixed Content Pages
Route::get('/404-page-not-found',[ContentController::class,'notFound'])->name('not_found');
Route::get('/thank-you-for-shopping-with-us',[ContentController::class,'thankForShopping']);
Route::get('/request-for-forget-password',[ContentController::class,'requestForgotPassword']);
