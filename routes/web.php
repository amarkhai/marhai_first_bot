<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'SiteController@index');

Auth::routes();

Route::match(['get', 'post'],'/register', 'SiteController@register');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/webhook', 'TelegramHookHandlerController@handle');

Route::middleware(['auth'])
    ->prefix('admin')
    ->namespace('Backend')
    ->name('admin.')
    ->group(function(){

    Route::get('/', 'DashboardController@index')->name('index');

    Route::get('/setting', 'SettingController@index')->name('setting.index');

    Route::post('/setting/store', 'SettingController@store')->name('setting.store');
    Route::post('/setting/set-webhook', 'SettingController@setWebhook')->name('setting.setwebhook');
    Route::post('/setting/get-webhook-info', 'SettingController@getWebhookInfo')->name('setting.getwebhookinfo');
});
