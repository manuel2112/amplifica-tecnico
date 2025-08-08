<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopifyController;
use App\Http\Controllers\UtilityController;
use App\Http\Middleware\Acceso;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home_index'])->name('home_index')->middleware(Acceso::class);
Route::get('/shopify/products', [ShopifyController::class, 'products_show'])->name('products_show')->middleware(Acceso::class);
Route::get('/shopify/oders', [ShopifyController::class, 'orders_show'])->name('orders_show')->middleware(Acceso::class);

Route::get('/register', [RegisterController::class, 'register_get'])->name('register_index');
Route::post('/register', [RegisterController::class, 'register_post'])->name('register_index_post');

Route::get('/export-excel-products', [UtilityController::class, 'exportExcelProducts'])->name('export_excel_products');
Route::get('/export-excel-orders', [UtilityController::class, 'exportExcelOrders'])->name('export_excel_orders');

Route::get('/login', [LoginController::class, 'login_index'])->name('login_index');
Route::post('/login', [LoginController::class, 'login_index_post'])->name('login_index_post');
Route::get('/salir', [LoginController::class, 'login_salir'])->name('login_salir');
