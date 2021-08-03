<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\ParserApartment\ParserApartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;


/**
 * Маршрут главной страницы
 */
Route::get('/', [HomeController::class, 'index'])->name('home');

/**
 * Маршрут для просмотра объявления
 */
Route::get('/ad-show/{id}', [HomeController::class, 'show'])->name('ad.show');

/**
 * Маршруты для гостей
 */
Route::group(['middleware'=> 'guest'], function () {
    Route::get('/login', [UserController::class, 'loginAuth'])->name('login');
    Route::get('/register', [UserController::class, 'registerUser'])->name('register');
    Route::post('/login', [UserController::class, 'authenticate'])->name('authenticate');
    Route::post('/register', [UserController::class, 'store'])->name('store');
});

/**
 * Маршруты для авторизовынных пользователей
 */
Route::group(['middleware' => 'auth'], function () {
    /**
     * Маршрут для включения и просмотра информации о парсере
     */
    Route::get('/parser-info', [ParserApartmentController::class, 'infoParser'])->name('info.parser');
    /**
     * Маршрут для включения и отключения парсера
     */
    Route::post('/parser-info/{id?}', [ParserApartmentController::class, 'startParser'])->name('start.parser');
    /**
     * Маршрут для создания объявления
     */
    Route::get('/ad/create', [HomeController::class, 'create'])->name('ad.create');
    /**
     * Маршрут для сохранения нового объявления
     */
    Route::post('/ad/create/{id}', [HomeController::class, 'store'])->name('ad.store');
    /**
     * Маршрут для редактирования объявления
     */
    Route::get('/ad/edit/{id}', [HomeController::class, 'edit'])->name('ad.edit');
    /**
     * Маршрут для сохранения обновлённого объявления
     */
    Route::put('/ad/edit/{id}', [HomeController::class, 'update'])->name('ad.update');
    /**
     * Муршрут для удаления объявления
     */
    Route::delete('/ad/delete/{id}', [HomeController::class, 'destroy'])->name('ad.delete');
    /**
     * Маршрут для выхода из системы
     */
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

