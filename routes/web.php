<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HompageController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HompageController::class, 'index']);

// Route untuk menampilkan halaman login
Route::get('/login', [AuthController::class, 'showFormLogin'])->name('login')->middleware('guest');

// Route untuk menangani proses login
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

// Route untuk pengunjung yang sudah login
Route::middleware('auth')->group(function () {
    // Route untuk menampilkan dashboard admin
    Route::get('/admin', function () {
        return view('admin.dashboard.index', [
            'title' => 'Dashboard',
        ]);
    });

    // Route untuk menampilkan halaman manajemen admin
    Route::get('/users', [UserController::class, 'index']);

    // Route untuk menampilkan form tambah admin
    Route::get('/users/create', [UserController::class, 'create']);

    // Route untuk menyimpan data admin yang baru
    Route::post('/users', [UserController::class, 'store']);

    // Route untuk menampilkan form edit admin
    Route::get('/users/{id}/edit', [UserController::class, 'edit']);

    // Route untuk menyimpan update admin
    Route::put('/users/{id}', [UserController::class, 'update']);

    // Route untuk menghapus data admin
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // Route untuk logout
    Route::get('/logout', [AuthController::class, 'logout']);

    // Route untuk CRUD category
    Route::resource('categories', CategoryController::class);

    // Route untuk CRUD post
    Route::resource('posts', PostController::class);

    // Route untuk CRUD gallery
    Route::resource('galleries', GalleryController::class);

    // Route untuk menyimpan foto yang diupload
    Route::post('/images/store', [ImageController::class, 'store']);

    // Route untuk menghapus foto
    Route::delete('/images/{id}', [ImageController::class, 'destroy']);
});
