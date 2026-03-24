<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);
});

Route::post('logout', [\App\Http\Controllers\Auth\LogoutController::class, 'logout'])->middleware('auth')->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    // Admin Routes
    Route::middleware('admin')->group(function () {
        Route::get('admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard.admin');

        // Teacher Management
        Route::resource('teachers', TeacherController::class);

        // Subject Management
        Route::resource('subjects', SubjectController::class);
        Route::get('subjects/{subject}/assign', [SubjectController::class, 'assignForm'])->name('subjects.assign');
        Route::post('subjects/{subject}/assign', [SubjectController::class, 'assignTeachers'])->name('subjects.assign.store');

        // Attendance Management
        Route::resource('attendance', AttendanceController::class);
        Route::post('attendance/mark', [AttendanceController::class, 'markAttendance'])->name('attendance.mark');

        // Salary Management
        Route::resource('salaries', SalaryController::class);
    });

    // Teacher Routes
    Route::middleware('teacher')->group(function () {
        Route::get('teacher/dashboard', [DashboardController::class, 'teacherDashboard'])->name('dashboard.teacher');
        Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    });
});

// Fallback for authenticated users
Route::middleware('auth')->get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect()->route('dashboard.admin');
    } else {
        return redirect()->route('dashboard.teacher');
    }
})->name('dashboard');

