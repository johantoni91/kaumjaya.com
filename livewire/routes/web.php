<?php

use App\Http\Livewire\Admin\Index;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Client\HomePage;
use App\Http\Livewire\Client\JajanCart;
use App\Http\Livewire\Client\JajanPage;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MidtransController;

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

Route::get('/', HomePage::class);
Route::get('/', function () {return view('/client/clientIndex');})->name('rumah');

Auth::routes(['verify' => true]);
Route::get('/order', JajanPage::class);
Route::get('/order', function () {return view('/client/jajanPage');})->middleware(['auth','verified'])->name('jajan');

Route::get('/order/cart', JajanCart::class);
Route::get('/order/cart', function () {return view('/client/jajanCart');})->middleware(['auth','verified'])->name('jajanCart');

Route::get('/order/checkout/{id}', [MidtransController::class, 'index'])->middleware(['auth','verified']);
Route::post('/order/checkout/{id}', [MidtransController::class, 'transaction']);

Route::get('/history', JajanCart::class);
Route::get('/history', function () {return view('/client/history');})->middleware(['auth','verified'])->name('history');

Route::get('/invoice/{order_time}', [InvoiceController::class, 'index']);

Route::get('/home', Index::class);
Route::get('/home', [HomeController::class, 'index'])->name('home');