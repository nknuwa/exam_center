<?php

use App\Http\Controllers\AbsentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OlExamController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\MediumController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CommentsController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });


/* login Route*/

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

/* Home Route*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/* absentees Route*/
Route::prefix('absentees')->group(function () {
    Route::get('/', [AbsentController::class, 'index'])->name('absentees.all');
    Route::get('/get-paper-details', [AbsentController::class, 'getPaperDetails'])->name('get.paper.details');


    Route::post('/store', [AbsentController::class, 'store'])->name('absentees.store');

    Route::get('/exams/download/csv', [OlExamController::class, 'downloadAllCsv'])->name('exams.download.csv');
    Route::get('/exams/download/excel', [OlExamController::class, 'downloadAllExcel'])->name('exams.download.excel');
    Route::get('/exams/download/pdf', [OlExamController::class, 'downloadAllPdf'])->name('exams.download.pdf');
});

Route::prefix('medium')->group(function () {
    Route::get('/', [MediumController::class, 'index'])->name('medium.all');
    Route::get('/get-paper-details', [MediumController::class, 'getPaperDetails'])->name('get.paper_medium.details');
    Route::get('/get-medium', [MediumController::class, 'getMedium'])->name('get.medium');
    Route::post('/store', [MediumController::class, 'store'])->name('medium.store');
});

Route::prefix('center')->group(function () {
    Route::get('/', [CenterController::class, 'index'])->name('center.all');
    Route::get('/get-paper-details', [CenterController::class, 'getPaperDetails'])->name('get.paper_center.details');
    Route::get('/get-center-details', [CenterController::class, 'getCenterDetails'])->name('get.center.details');
    Route::get('/get-center-by-index', [CenterController::class, 'getCenterByIndex'])->name('get.center.by.index');
    Route::post('/store', [CenterController::class, 'store'])->name('centers.store');

});

Route::prefix('message')->group(function () {
    Route::get('/', [CommentsController::class, 'index'])->name('message.all');
    Route::get('/get-paper-details', [CommentsController::class, 'getPaperDetails'])->name('get.paper_note.details');
    Route::post('/store', [CommentsController::class, 'store'])->name('message.store');


});
/* user Route*/
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.all');
    Route::get('/new', [UserController::class, 'new'])->name('users.new');
    Route::post('/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/{user_id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/{user_id}/update', [UserController::class, 'update'])->name('users.update');
    Route::get('/{user_id}/delete', [UserController::class, 'delete'])->name('users.delete');

    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles');
    Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
    Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('users.permissions');
    Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])->name('users.permissions.revoke');
    Route::get('/export/list', [UserController::class, 'export'])->name('users.export');

    Route::get('/{user_id}/{status}/status', [UserController::class, 'status'])->name('users.status');
});

/* permissions Route*/
Route::prefix('permissions')->group(function () {
    Route::get('/admin', [PermissionController::class, 'index'])->name('permissions.all');
    Route::get('/new', [PermissionController::class, 'new'])->name('permissions.new');
    Route::post('/store', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/{permission_id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/{permission_id}/update', [PermissionController::class, 'update'])->name('permissions.update');
    Route::get('/{permission_id}/delete', [PermissionController::class, 'delete'])->name('permissions.delete');
});

/* roles Route*/
Route::prefix('roles')->group(function () {
    Route::get('/admin', [RoleController::class, 'index'])->name('roles.all');
    Route::get('/new', [RoleController::class, 'new'])->name('roles.new');
    Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/{role_id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/{role_id}/update', [RoleController::class, 'update'])->name('roles.update');
    Route::get('/{role_id}/delete', [RoleController::class, 'delete'])->name('roles.delete');
    Route::get('/{role_id}/permissions', [RoleController::class, 'addPermission'])->name('roles.permissions');
    Route::put('/{role_id}/give-permissions', [RoleController::class, 'givePermission'])->name('roles.give-permissions');
});
