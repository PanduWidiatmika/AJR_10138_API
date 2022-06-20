<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\pdfApiController;
use App\Http\Controllers\Api\BrosurController;
use App\Http\Controllers\Api\PromoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login','api\AuthController@login');
Route::get('pdfsewa/{month}/{year}','api\pdfApiController@pdfsewa');
Route::get('pdfdriver/{month}/{year}','api\pdfApiController@pdfdriver');
Route::get('pdfperforma/{month}/{year}','api\pdfApiController@pdfperforma');
Route::get('pdfcustomer/{month}/{year}','api\pdfApiController@pdfcustomer');
Route::get('pdfpendapatan/{month}/{year}','api\pdfApiController@pdfpendapatan');

Route::get('promo','api\PromoController@index');
Route::get('brosur','api\BrosurController@index');
