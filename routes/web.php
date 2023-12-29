<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/show/{user}', [AdminController::class, 'show'])->name('show');
    Route::get('{user}/edit', [AdminController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [AdminController::class, 'update'])->name('update');
    Route::delete('/delete/{user}', [AdminController::class, 'delete'])->name('delete');
});

Route::middleware(['auth'])->name('files.')->prefix('files')->group(function () {
    Route::get('/', [FileController::class, 'index'])->name('index');
    Route::get('/generate-pdf', [FileController::class, 'generatePdf'])->name('generate-pdf');


});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
