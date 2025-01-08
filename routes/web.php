<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ShowProfile;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController as FrontUserController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/welcome', function () {
    $name = 'John Scott';
    $title = 'Laravel';
    $version = '12';

    return view('welcome', compact('name', 'title', 'version'));
});

Route::get('/users', [FrontUserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [FrontUserController::class, 'show'])->name('users.show');

Route::get('/admin/users', [AdminUserController::class, 'index']);

Route::get('/profile/{id}', ShowProfile::class);

Route::resource('posts', PostController::class);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
