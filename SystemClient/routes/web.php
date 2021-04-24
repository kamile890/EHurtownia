<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SMSGateway\GatewaysListController;
use \App\Http\Controllers\Templates\TemplatesList;
use \App\Http\Controllers\Auth\Register;
use \App\Http\Controllers\Auth\Login;
use \App\Http\Controllers\Settings\Settings;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gateways', [GatewaysListController::class, 'index']);
Route::get('/templatesList', [TemplatesList::class, 'index']);
Route::post('/addTemplate', [TemplatesList::class, 'addTemplate']);
Route::post('/saveConfiguration/{name}', [GatewaysListController::class, 'saveConfiguration']);
Route::get('/registerPage', [Register::class, 'index']);
Route::get('/loginPage', [Login::class, 'index']);
Route::get('/register', [Register::class, 'register']);
Route::get('/login', [Login::class, 'login']);
Route::get('/logout', [Login::class, 'logout']);
Route::get('/settings', [Settings::class, 'index']);



