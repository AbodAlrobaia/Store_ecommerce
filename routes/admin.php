<?php

use App\Http\Controllers\dashboard\BrandsController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\MainCategoriesController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\SubCategoriesController;
use App\Http\Controllers\dashboard\TagsController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//note that the prefix is admin for all file routs
// Route::get('mm', function(){
//     dd(1);
//     dd(LaravelLocalization::getCurrentLocale());
//     dd(app()->getLocale());
// }); // this frest page admin vister if authintaction

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::group(['namespace' =>'Dashboard','middleware'=>'auth:admin','prefix'=>'admin'],function(){
            Route::get('mm', function(){
                dd(123);
            });
            Route::get('/',[DashboardController::class ,'index'])->name('admin.dashboard'); // this frest page admin vister if authintaction
            Route::get('/logout',[LoginController::class , 'logout'])->name('admin.logout');
            Route::group(['prefix'=>'setting'],function (){
                Route::get('shipping-methods/{type}',[SettingsController::class ,'editshippings'])->name('edit.shpping');
                Route::PUT('shipping-methods/{id}',[SettingsController::class ,'updateshippings'])->name('update.shpping');
            });
            Route::group(['prefix'=>'profile'],function (){
                Route::get('edit',[ProfileController::class ,'editprofile'])->name('edit.profile');
                Route::PUT('update',[ProfileController::class ,'updateprofile'])->name('update.profile');
                // Route::PUT('update/password',[ProfileController::class ,'updatepassword'])->name('update.profile.password');
            });


            ///////////////maincategory ///////////////////////////
            Route::group(['prefix'=>'main_categoies'],function(){
                Route::get('/',[MainCategoriesController::class , 'index'])->name('admin.maincategory');
                Route::get('create',[MainCategoriesController::class , 'create'])->name('admin.maincategory.create');
                Route::post('store',[MainCategoriesController::class , 'store'])->name('admin.maincategory.store');
                Route::get('edit/{id}',[MainCategoriesController::class , 'edit'])->name('admin.maincategory.edit');
                Route::post('update/{id}',[MainCategoriesController::class , 'update'])->name('admin.maincategory.update');
                Route::get('delete/{id}',[MainCategoriesController::class , 'destroy'])->name('admin.maincategory.delete');
                Route::get('changeStatus/{id}',[MainCategoriesController::class , 'changeStatus']);


            });
            /////////////////// end maincategory /////////////////
            /////////////// sub_category ///////////////////////////
            Route::group(['prefix'=>'sub_categoies'],function(){
                Route::get('/',[SubCategoriesController::class , 'index'])->name('admin.subcategory');
                Route::get('create',[SubCategoriesController::class , 'create'])->name('admin.subcategory.create');
                Route::post('store',[SubCategoriesController::class , 'store'])->name('admin.subcategory.store');
                Route::get('edit/{id}',[SubCategoriesController::class , 'edit'])->name('admin.subcategory.edit');
                Route::post('update/{id}',[SubCategoriesController::class , 'update'])->name('admin.subcategory.update');
                Route::get('delete/{id}',[SubCategoriesController::class , 'destroy'])->name('admin.subcategory.delete');
                Route::get('changeStatus/{id}',[SubCategoriesController::class , 'changeStatus']);
            /////////////// sub_category ///////////////////////////

            });
            Route::group(['prefix'=>'brands'],function(){
                Route::get('/',[BrandsController::class , 'index'])->name('admin.brands');
                Route::get('create',[BrandsController::class , 'create'])->name('admin.brands.create');
                Route::post('store',[BrandsController::class , 'store'])->name('admin.brands.store');
                Route::get('edit/{id}',[BrandsController::class , 'edit'])->name('admin.brands.edit');
                Route::post('update/{id}',[BrandsController::class , 'update'])->name('admin.brands.update');
                Route::get('delete/{id}',[BrandsController::class , 'destroy'])->name('admin.brands.delete');
                Route::get('changeStatus/{id}',[BrandsController::class , 'changeStatus']);
            /////////////// end  brand //////////////////////////

            });
            Route::group(['prefix'=>'tags'],function(){
                Route::get('/',[TagsController::class , 'index'])->name('admin.tags');
                Route::get('create',[TagsController::class , 'create'])->name('admin.tags.create');
                Route::post('store',[TagsController::class , 'store'])->name('admin.tags.store');
                Route::get('edit/{id}',[TagsController::class , 'edit'])->name('admin.tags.edit');
                Route::post('update/{id}',[TagsController::class , 'update'])->name('admin.tags.update');
                Route::get('delete/{id}',[TagsController::class , 'destroy'])->name('admin.tags.delete');
                Route::get('changeStatus/{id}',[TagsController::class , 'changeStatus']);
            /////////////// end  Tags/////////////////////////

            });

            ///////////////////// START PRODUCT
            Route::group(['prefix'=>'products'],function(){
                Route::get('/',[ProductController::class , 'index'])->name('admin.products');
                Route::get('create',[ProductController::class , 'create'])->name('admin.products_general.create');
                Route::post('store',[ProductController::class , 'store'])->name('admin.products.general.store');
                // Route::get('edit/{id}',[ProductController::class , 'edit'])->name('admin.products.edit');
                // Route::post('update/{id}',[ProductController::class , 'update'])->name('admin.products.update');
                // Route::get('delete/{id}',[ProductController::class , 'destroy'])->name('admin.products.delete');
                // Route::get('changeStatus/{id}',[ProductController::class , 'changeStatus']);
            /////////////// end  PRODUCTS/////////////////////////

            });




        });

        Route::group(['namespace' =>'Dashboard','middleware'=>'guest:admin'],function(){
            Route::get('login',[LoginController::class , 'login'])->name('admin.login');
            Route::post('login',[LoginController::class , 'postlogin'])->name('admin.postLogin');


        });
    });
