<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SMSGateway\GatewaysListController;
use \App\Http\Controllers\Templates\TemplatesList;
use \App\Http\Controllers\Auth\Register;
use \App\Http\Controllers\Auth\Login;
use \App\Http\Controllers\Settings\Settings;
use \App\Http\Controllers\Labels\LabelsController;
use \App\Http\Controllers\Dealers\DealersController;
use \App\Http\Controllers\Products\ProductsList;
use \App\Http\Controllers\Categories\CategoriesList;
use \App\Http\Controllers\Clients\ClientsList;
use \App\Http\Controllers\CustomFields\CustomFieldsList;
use \App\Http\Controllers\Home\HomeController;
use \App\Http\Controllers\Koszyk\CartController;
use \App\Http\Controllers\Koszyk\Zamowienie;
use \App\Http\Controllers\Orders\OrdersController;
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

Route::get('/', [HomeController::class, 'index']);
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
Route::get('/deleteLabel', [LabelsController::class, 'deleteLabel']);
Route::get('/dealers', [DealersController::class, 'index']);
Route::get('/addDealer', [DealersController::class, 'addDealer']);
Route::get('/editDealer', [DealersController::class, 'editDealer']);
Route::get('/products', [ProductsList::class, 'index']);
Route::post('/addProduct', [ProductsList::class, 'addProduct']);
Route::post('/editProduct', [ProductsList::class, 'editProduct']);
Route::get('/deleteProduct', [ProductsList::class, 'deleteProduct']);
Route::get('/restoreProduct', [ProductsList::class, 'restoreProduct']);
Route::get('/categories', [CategoriesList::class, 'index']);
Route::get('/addCategory', [CategoriesList::class, 'addCategory']);
Route::get('/editCategory', [CategoriesList::class, 'editCategory']);
Route::get('/deleteCategory', [CategoriesList::class, 'deleteCategory']);
Route::get('/clients', [ClientsList::class, 'index']);
Route::get('/editClient', [ClientsList::class, 'editClient']);
Route::get('/customFields', [CustomFieldsList::class, 'index']);
Route::get('/addCustom', [CustomFieldsList::class, 'addCustom']);
Route::get('/editCustom', [CustomFieldsList::class, 'editCustom']);
Route::get('/deleteField', [CustomFieldsList::class, 'deleteCustom']);
Route::get('/deleteDealer', [DealersController::class, 'deleteDealer']);
Route::get('/cart', [CartController::class, 'index']);
Route::get('/addToCart', [CartController::class, 'addToCart']);
Route::get('zamow', [Zamowienie::class, 'index']);
Route::get('/order', [OrdersController::class, 'order']);
Route::get('/orders', [OrdersController::class, 'listOrders']);
Route::get('/realize', [OrdersController::class, 'realize']);
Route::get('/editClientCustom', [ClientsList::class, 'editClientCustom']);
Route::get('/editClientLabel', [ClientsList::class, 'editClientLabel']);
Route::get('/deleteLabelClient', [ClientsList::class, 'deleteLabelClient']);
Route::get('/deletefromCart', [CartController::class, 'deletefromCart']);
Route::get('/accountData', [ClientsList::class, 'accountData']);
Route::get('/saveClientSelf', [ClientsList::class, 'saveClientSelf']);
Route::get('/sendToClient', [ClientsList::class, 'sendToClient']);






