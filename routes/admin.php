<?php

use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
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
Route::group(['namespace' =>'Dashboard','middleware'=>'auth:admin'],function(){
    
    Route::get('/',[DashboardController::class ,'index'])->name('admin.dashboard'); // this frest page admin vister if authintaction
});

Route::group(['namespace' =>'Dashboard','middleware'=>'guest:admin'],function(){
    
    Route::get('login',[LoginController::class , 'login'])->name('admin.login');
    Route::post('login',[LoginController::class , 'postlogin'])->name('admin.postLogin');


});

