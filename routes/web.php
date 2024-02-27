<?php

use App\Http\Controllers\AdminIndexController;
use App\Http\Controllers\BookManagementController;
use App\Http\Controllers\BorrowersController;
use App\Http\Controllers\CategoriesManagementController;
use App\Http\Controllers\CompleteAccountController;
use App\Http\Controllers\EmployeeManagementController;
use App\Http\Controllers\EmployeesIndexController;
use App\Http\Controllers\EmployeeVerificationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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
Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::get('/auth/redirect', [LoginController::class, 'redirect']);
    Route::get('/auth/callback', [LoginController::class, 'callback']);
    Route::get('/auth/complete/{id}', [CompleteAccountController::class, 'index'])->name('complete.account');
    Route::put('/auth/complete/{id}', [CompleteAccountController::class, 'edit'])->name('complete.account.post');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/auth/profile/', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/auth/profile/{id}', [ProfileController::class, 'update'])->name('profile.put');
    Route::delete('/auth/profile/delete/{id}', [ProfileController::class, 'destroy'])->name('profile.delete');
});

Route::middleware(['adminallow'])->group(function () {
    Route::get('/admin/dashboard', [AdminIndexController::class, 'index'])->name('admin.index');
    Route::get('/admin/employee/management', [EmployeeManagementController::class, 'index'])->name('admin.employee.management');
    Route::get('/employees/admin/show/{id}', [EmployeeManagementController::class, 'edit'])->name('employees.show');
    Route::put('/employees/access/admin/{id}', [EmployeeManagementController::class, 'accessadmin']);
    Route::delete('/employees/admin/destroy/{id}', [EmployeeManagementController::class, 'destroy']);

    Route::get('/admin/employee/Verification', [EmployeeVerificationController::class, 'index'])->name('employee.verif');
    Route::put('/admin/employee/Verification/{id}', [EmployeeVerificationController::class, 'verification']);
    Route::delete('/admin/employee/Verification/destroy/{id}', [EmployeeVerificationController::class, 'destroy']);
});

Route::middleware(['employeeallow'])->group(function () {
    Route::get('/employees/dashboard', [EmployeesIndexController::class, 'index'])->name('employees.index');

    Route::get('/employees/categories', [CategoriesManagementController::class, 'index'])->name('employees.categories');
    Route::get('/employees/categories/{id}', [CategoriesManagementController::class, 'show'])->name('employees.get');
    Route::post('/employees/categories', [CategoriesManagementController::class, 'store']);
    Route::put('/employees/categories/update/{id}', [CategoriesManagementController::class, 'update']);
    Route::delete('/employees/categories/delete/{id}', [CategoriesManagementController::class, 'destroy']);

    Route::get('/employees/book', [BookManagementController::class, 'index'])->name('employees.book');
    Route::post('/employees/book', [BookManagementController::class, 'store']);
    Route::put('/employees/book/put/{id}', [BookManagementController::class, 'update'])->name('book.put');
    Route::get('/employees/edit/show/{id}', [BookManagementController::class, 'edit'])->name('book.show');
    Route::delete('/employees/book/delete/{id}', [BookManagementController::class, 'destroy']);

    Route::get('/employees/borrowers', [BorrowersController::class, 'index'])->name('employees.borrowers');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'Success Logout');
});
