<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\GalerieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\SocialLinkController;



Route::get('/', [\App\Http\Controllers\HomeController::class,'index'])->name('home');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::resource('centres', CentreController::class);
Route::resource('evenements', \App\Http\Controllers\EvenementController::class);
Route::resource('galeries', GalerieController::class);
Route::resource('videos', VideoController::class);
Route::resource('carousel', CarouselController::class);

Route::resource('social-links', SocialLinkController::class);
Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
    ->name('users.toggle-status');
Route::resource('users', UserController::class);




Route::get('/evenement', [EvenementController::class, 'allEvent'])->name('evenements.all');
Route::get('/video', [VideoController::class, 'allVideo'])->name('videos.all');

Route::get('change-language/{locale}', function ($lang) {

        \Illuminate\Support\Facades\Session::put('locale', $lang);

    return back();
})->name('change.language');


Route::get('test-session', function () {
    dd(session()->all());  // Affiche toutes les données de la session
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

require __DIR__.'/auth.php';
