<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
//rutas para login
Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
//cessar sesion
Route::get('logout', [AuthController::class, 'logout']);
//ruta para recuperar clave
Route::get('forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);



// Route::get('admin/admin/list', function () {
//     return view('admin.admin.list');
// });

//rutas para el administrador
Route::group(['middleware'=>'admin'],function() {
    // Route::get('admin/dashboard', function () {
    //     return view('admin.dashboard');
    // });
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);

     Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

});

//docente
Route::group(['middleware'=>'teacher'],function() {
    // Route::get('teacher/dashboard', function () {
    //     return view('admin.dashboard');
    // });
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);

});

//alumnos
Route::group(['middleware'=>'student'],function() {
    // Route::get('student/dashboard', function () {
    //     return view('admin.dashboard');
    // });
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);

});

//padre de familia
Route::group(['middleware'=>'parent'],function() {
    // Route::get('parent/dashboard', function () {
    //     return view('admin.dashboard');
    // });
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);

});

//usuario general
Route::group(['middleware'=>'schooll'],function() {
    // Route::get('schooll/dashboard', function () {
    //     return view('admin.dashboard');
    // });
    Route::get('schooll/dashboard', [DashboardController::class, 'dashboard']);

});
