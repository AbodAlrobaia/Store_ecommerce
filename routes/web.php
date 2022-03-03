<?php

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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
/////////// visible
Route::get('test1', function () {
  $category= \App\Models\Category::first();
  $category->makeVisible('translations');  // داله تجبر على ارجاع الترانزاكشن برغم انها هيدن في  المودل
  return $category;
});

// Route::get('hash', function () {
// dd(Hash::make(123));
// });
// Route::get('test', function () {
// dd(Setting::all()[0]->value);
// });

