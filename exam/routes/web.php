<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['middleware' => 'PreventBackHistory'])->group(function () {
    Auth::routes();
});

Route::middleware(['middleware' => 'PreventBackHistory'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Auth::routes();
});



Route::group(['prefix' => 'admin', 'middleware' => [ 'auth:admin', 'PreventBackHistory']], function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::resource('students', StudentController::class,);
   

});
Route::group(['prefix' => 'teacher', 'middleware' => ['auth:teacher','PreventBackHistory']], function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('teacher.dashboard');

});
Route::group(['prefix' => 'student', 'middleware' => ['auth:users','PreventBackHistory' ]], function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('student.dashboard');

});
