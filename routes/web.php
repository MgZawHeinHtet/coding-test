<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Models\Company;
use App\Models\Employee;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $total_employees = Employee::count();
    $total_company = Company::count();
    $recent_created_company = Company::orderBy('created_at', 'desc')->take(3)->get();
    
    return view('dashboard',[
        'total_employee' => $total_employees,
        'total_company' => $total_company,
        'recent_companies'=>$recent_created_company
    ]);
})->middleware(['auth',AdminMiddleware::class, 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('dashboard')->group(function(){
    Route::resource('company',CompanyController::class);
    Route::resource('employee',EmployeeController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
