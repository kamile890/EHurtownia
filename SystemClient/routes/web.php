<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SMSGateway\GatewaysListController;
use \App\Http\Controllers\Templates\TemplatesList;
use \App\Http\Controllers\Auth\Register;
use \App\Http\Controllers\Auth\Login;
use \App\Http\Controllers\Settings\Settings;
use \App\Http\Controllers\Labels\LabelsController;
use \App\Http\Controllers\Dealers\DealersController;
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
Route::get('/addTemplate', [TemplatesList::class, 'addTemplate']);
Route::get('/saveConfiguration', [GatewaysListController::class, 'saveConfiguration']);
Route::get('/registerPage', [Register::class, 'index']);
Route::get('/loginPage', [Login::class, 'index']);
Route::get('/register', [Register::class, 'register']);
Route::get('/login', [Login::class, 'login']);
Route::get('/logout', [Login::class, 'logout']);
Route::get('/settings', [Settings::class, 'index']);
Route::get('/saveSettings', [Settings::class, 'saveSettings']);
Route::get('/editTemplate', [TemplatesList::class, 'editTemplate']);
Route::get('/deleteTemplate', [TemplatesList::class, 'deleteTemplate']);
Route::get('/labels', [LabelsController::class, 'index']);
Route::get('/addLabel', [LabelsController::class, 'addLabel']);
Route::get('/editLabel', [LabelsController::class, 'editLabel']);
Route::get('/dealers', [DealersController::class, 'index']);
Route::get('/addDealer', [DealersController::class, 'addDealer']);
Route::get('//editDealer', [DealersController::class, 'editDealer']);



