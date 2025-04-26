<?php

use App\Http\Controllers\EvenementController;
use App\Http\Controllers\GalerieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentreController;


Route::get('/', [\App\Http\Controllers\HomeController::class,'index'])->name('home');



Route::resource('centres', CentreController::class);
Route::resource('evenements', \App\Http\Controllers\EvenementController::class);
Route::resource('galeries', GalerieController::class);
Route::resource('videos', VideoController::class);


Route::get('/evenement', [EvenementController::class, 'allEvent'])->name('evenements.all');
Route::get('/video', [VideoController::class, 'allVideo'])->name('videos.all');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
