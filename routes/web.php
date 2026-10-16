<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\WorkoutPlanController;
use App\Http\Controllers\WorkoutSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LocaleController;

// Public routes
Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Locale
Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

// Authenticated routes
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Exercises (public browsing but auth required for admin actions)
    Route::get('/exercises', [ExerciseController::class, 'index'])->name('exercises.index');
    Route::get('/exercises/{exercise}', [ExerciseController::class, 'show'])->name('exercises.show');

    // Workout Sessions
    Route::resource('sessions', WorkoutSessionController::class);

    // Workout Plans
    Route::resource('plans', WorkoutPlanController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Admin only
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::post('/users/{user}/role', [AdminController::class, 'changeRole'])->name('admin.role');
        Route::get('/audit', [AdminController::class, 'auditLog'])->name('admin.audit');
        Route::post('/exercises/{id}/restore', [ExerciseController::class, 'restore'])->name('exercises.restore');
        Route::get('/exercises/create', [ExerciseController::class, 'create'])->name('exercises.create');
        Route::post('/exercises', [ExerciseController::class, 'store'])->name('exercises.store');
        Route::get('/exercises/{exercise}/edit', [ExerciseController::class, 'edit'])->name('exercises.edit');
        Route::put('/exercises/{exercise}', [ExerciseController::class, 'update'])->name('exercises.update');
        Route::delete('/exercises/{exercise}', [ExerciseController::class, 'destroy'])->name('exercises.destroy');
    });
});

// Guest exercise browsing (no auth required)
Route::get('/exercises', [ExerciseController::class, 'index'])->name('exercises.index');