<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    $totalIncome = $user->transactions()->where('type', 'income')->sum('amount');
    $totalExpense = $user->transactions()->where('type', 'expense')->sum('amount');
    $balance = $totalIncome - $totalExpense;

    $categoryData = $user->categories()
        ->withSum(['transactions' => function($query) {
            $query->where('type', 'expense');
        }], 'amount')
        ->get();

    return view('dashboard', compact('totalIncome', 'totalExpense', 'balance', 'categoryData'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('categories', CategoryController::class);
    Route::resource('transactions', TransactionController::class); 
});

require __DIR__.'/auth.php';