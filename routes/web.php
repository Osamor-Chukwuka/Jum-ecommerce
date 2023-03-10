<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersContrller;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SellerController;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
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

// If you have routes that share a segment of their paths, you can group them in a route prefix group 






Auth::routes();

// Routes that handles Categories
Route::get('/', [CategoriesController::class, 'index'])->name('landing');

// Homepage after Authentication
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// show products in a category
Route::get('/category/products/{products}', [CategoriesController::class, 'show'])->name('show');

// Show add Product form
Route::get('/create', [CategoriesController::class, 'create'])->name('create');

// Store Products
Route::post('/add', [CategoriesController::class, 'store'])->name('store');

// show product full page
Route::get('/products/full/{productDesc}', [CategoriesController::class, 'fullPage'])->name('description');

// Get cart
Route::get('/cart', [CartController::class, 'getCart'])->name('cart');

// Add to cart
Route::post('/products/full/{productDesc}', [CartController::class, 'addCart'])->name('addCart');

// Delete from cart
Route::post('cart/delete', [CartController::class, 'delete'])->name('deleteFromCart');

// Increase quantity of a product in cart
Route::post('cart/product/add_quantity', [CartController::class, 'increaseQuantity'])->name('increaseQuantity');

// Decrease quantity of a product in cart
Route::post('cart/product/decrease_quantity', [CartController::class, 'decreaseQuantity'])->name('decreaseQuantity');

// show product full page again
Route::get('/cart/full/{productDesc}', [CartController::class, 'cartProductPage']);

// Route::get('/cart/full/{productDesc}', function() {
//     return redirect(Route('description', ['productDesc']));
// });


// SELLER SECTION
// show seller registeration form
Route::get('/jum/seller', function(){
    return view('sellerReg');
})->name('seller');

// Register seller
Route::post('/seller/reg', [SellerController::class, 'add']);

// my shop
Route::controller(SellerController::class)->group(function() {
    Route::get('/my_shop', 'myShop')->name('my_shop');
    Route::get('/my_shop/products', 'myShop')->name('shop_products');
    Route::get('/my_shop/orders', 'myShop')->name('shop_orders');
    Route::get('/my_shop/delivered', 'myShop')->name('shop_delivered');
});

// Checkout
Route::get('/cart/checkout', [OrdersContrller::class, 'checkout'])->name('checkout');

// Verify Payment
Route::get('cart/verify-payment/{reference}', [OrdersContrller::class, 'verifyCustomerPayment']);

// Pay Vendors
Route::get('cart/pay-vendors', [OrdersContrller::class, 'payVendors'])->name('pay-vendors');

