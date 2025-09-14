<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DirigeantController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\GalerieController;
use App\Http\Controllers\MoughataaController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\WilayaController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\SocialLinkController;


Route::get('/', [\App\Http\Controllers\HomeController::class,'index'])->name('home');


Route::get('/login', [AuthenticatedSessionController::class,'create'])->name('login');


Route::get('/evenement', [EvenementController::class, 'allEvent'])->name('evenements.all');

Route::get('/video', [VideoController::class, 'allVideo'])->name('videos.all');
Route::get('/video/show/{id}', [VideoController::class, 'show'])->name('video.show');
Route::get('/evenement/show/{id}', [EvenementController::class, 'show'])->name('evenement.show');
Route::get('/wilaya/{wilaya}/moughataas', [App\Http\Controllers\MoughataaController::class, 'byWilaya'])->name('moughataas.by_wilaya');



// Routes pour le front-end
Route::prefix('equipe')->group(function() {
    Route::get('/', [DirigeantController::class, 'listeDirigeants'])->name('equipe.liste');
    Route::get('/{id}', [DirigeantController::class, 'afficherDirigeant'])->name('equipe.details');
});
Route::get('change-language/{locale}', function ($lang) {

        \Illuminate\Support\Facades\Session::put('locale', $lang);

    return back();
})->name('change.language');




Route::middleware('auth')->group(function () {
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

    Route::resource('wilayas', WilayaController::class);
    Route::resource('participants', ParticipantController::class);
    Route::resource('dirigeants', DirigeantController::class);

    Route::resource('moughataas', MoughataaController::class);
    // Route pour afficher les Moughataa d'une Wilaya

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('questions', QuestionController::class);
    Route::post('questions/{question}/toggle-status', [QuestionController::class, 'toggleStatus'])
        ->name('questions.toggle-status');
    Route::get('questions/{question}/results', [QuestionController::class, 'results'])
        ->name('questions.results');
});




// Routes publiques
    Route::get('/votes', [VoteController::class, 'index'])->name('votes.index');
    Route::post('/votes/{question}/vote', [VoteController::class, 'vote'])->name('votes.vote');
    Route::get('/votes/{question}/results', [VoteController::class, 'results'])->name('votes.results');




Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

require __DIR__.'/auth.php';
