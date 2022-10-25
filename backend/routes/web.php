<?php

use App\Models\InertiaTest;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ItemController;


Route::resource('items', ItemController::class)
->middleware(['auth', 'verified']);

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/inertia/index', [InertiaTest::class, 'index'])->name('inertia.index');
Route::get('/inertia/create', [InertiaTest::class, 'create'])->name('inertia.create');
Route::post('/inertia', [InertiaTest::class, 'store'])->name('inertia.store');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
