<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JourneysController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'admin'], function () {
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

//ruta para las clases
    Route::get('admin/class/list', [ClassController::class, 'list']);
    Route::get('admin/class/add', [ClassController::class, 'add']);
    Route::post('admin/class/add', [ClassController::class, 'insert']);
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::post('admin/class/edit/{id}', [ClassController::class, 'update']);
    Route::get('admin/class/delete/{id}', [ClassController::class, 'delete']);

//jornadas
    Route::get('admin/journeys/list', [JourneysController::class, 'list']);
    Route::get('admin/journeys/add', [JourneysController::class, 'add']);
    Route::post('admin/journeys/add', [JourneysController::class, 'insert']);
    Route::get('admin/journeys/edit/{id}', [JourneysController::class, 'edit']);
    Route::post('admin/journeys/edit/{id}', [JourneysController::class, 'update']);
    Route::get('admin/journeys/delete/{id}', [JourneysController::class, 'delete']);

//asignaturas
    Route::get('admin/subject/list', [SubjectController::class, 'list']);
    Route::get('admin/subject/add', [SubjectController::class, 'add']);
    Route::post('admin/subject/add', [SubjectController::class, 'insert']);
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('admin/subject/edit/{id}', [SubjectController::class, 'update']);
    Route::get('admin/subject/delete/{id}', [SubjectController::class, 'delete']);

    //asignar clases a las materias
    Route::get('admin/assign_subject/list', [ClassSubjectController::class, 'list']);
    Route::get('admin/assign_subject/add', [ClassSubjectController::class, 'add']);
    Route::post('admin/assign_subject/add', [ClassSubjectController::class, 'insert']);
    Route::get('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'edit']);
    Route::post('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'update']);
    Route::get('admin/assign_subject/delete/{id}', [ClassSubjectController::class, 'delete']);


    //editar un solor registro
    Route::get('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'edit_single']);
    Route::post('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'update_single']);
});

//docente
Route::group(['middleware' => 'teacher'], function () {
    // Route::get('teacher/dashboard', function () {
    //     return view('admin.dashboard');
    // });
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);

});

//alumnos
Route::group(['middleware' => 'student'], function () {
    // Route::get('student/dashboard', function () {
    //     return view('admin.dashboard');
    // });
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);

});

//padre de familia
Route::group(['middleware' => 'parent'], function () {
    // Route::get('parent/dashboard', function () {
    //     return view('admin.dashboard');
    // });
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);

});

//usuario general
Route::group(['middleware' => 'schooll'], function () {
    // Route::get('schooll/dashboard', function () {
    //     return view('admin.dashboard');
    // });
    Route::get('schooll/dashboard', [DashboardController::class, 'dashboard']);

});
