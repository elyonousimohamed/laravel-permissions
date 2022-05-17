<?php

use App\Http\Controllers\RoleController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('roles')->middleware(['auth', 'verified'])->group(function () {
    Route::get('', [RoleController::class, 'index'])->name('roles.index')->middleware(['can:roles.index']);
    Route::get('show/{role}', [RoleController::class, 'show'])->name('roles.show')->middleware(['can:roles.show']);
    Route::get('create', [RoleController::class, 'create'])->name('roles.create')->middleware(['can:roles.create']);
    Route::post('store', [RoleController::class, 'store'])->name('roles.store')->middleware(['can:roles.store']);
    Route::get('{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware(['can:roles.edit']);
    Route::put('update/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware(['can:roles.update']);
    Route::delete('destroy/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware(['can:roles.delete']);
});

require __DIR__ . '/auth.php';
