<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\CompletedShoppingListController;

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

//非ログイントップページ
Route::get('/', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);

//会員登録
Route::prefix('/user')->group(function () {
    Route::get('/register',[UserController::class,'index']);
    Route::post('/register',[UserController::class,'register']);
});

//認可
Route::middleware(['auth'])->group(function () {
    Route::prefix('/shopping_list')->group(function () {  
        Route::get('/list',[ShoppingListController::class, 'list']);
        Route::post('/register',[ShoppingListController::class, 'register']);
        Route::delete('/delete/{shopping_list_id}', [ShoppingListController::class, 'delete'])->whereNumber('shopping_list_id')->name('delete');
        Route::post('/complete/{shopping_list_id}', [ShoppingListController::class, 'complete'])->whereNumber('shopping_list_id')->name('complete');
    });
    
    //購入済み一覧
    Route::get('/completed_shopping_list/list',[CompletedShoppingListController::class, 'list']);
    
    //ログアウト
    Route::get('/logout', [AuthController::class, 'logout']);
});