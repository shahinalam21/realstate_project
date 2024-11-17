<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', action: [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// admin and agent routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [adminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('admin/logout', [adminController::class, 'AdminLogout'])->name('admin.logout');
});
route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
});

Route::get('/admin/login', [adminController::class, 'AdminLogin'])->name('admin.login');

