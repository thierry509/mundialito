<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\KnockoutController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChampionshipController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\RegulationController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GameController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Calendrier des matchs
Route::get('/calendrier', [CalendarController::class, 'index'])->name('calendar');

// Résultats des matchs
Route::get('/resultats', [ResultController::class, 'index'])->name('results');

// Classements des poules
Route::get('/poules', [GroupController::class, 'index'])->name('groups');

// Phase à élimination directe
Route::get('/elimination', [KnockoutController::class, 'index'])->name('knockout');

// Liste des équipes
Route::get('/equipes', [TeamController::class, 'index'])->name('teams');

// Détail d'une équipe
Route::get('/equipes/{id}', [TeamController::class, 'show'])->name('teams.show');

// Liste des joueurs
Route::get('/joueurs', [PlayerController::class, 'index'])->name('players');

// Détail d'un joueur
Route::get('/joueurs/{id}', [PlayerController::class, 'show'])->name('players.show');

// Actualités
Route::get('/actualites', [NewsController::class, 'index'])->name('news');

// Détail d'une actualité
Route::get('/actualites/{slug}', [NewsController::class, 'show'])->name('news.show');



// Galerie photos et vidéos
Route::get('/galerie', [GalleryController::class, 'index'])->name('gallery');

// À propos du championnat
Route::get('/a-propos', [AboutController::class, 'index'])->name('about');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Règlements du tournoi
Route::get('/reglements', [RegulationController::class, 'index'])->name('regulations');

// Sponsors
Route::get('/sponsors', [SponsorController::class, 'index'])->name('sponsors');

// FAQ
Route::get('/faq', [FaqController::class, 'index'])->name('faq');


Route::get('connexion', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('connexion', [AuthController::class, 'login'])->name('login.submit');
Route::get('inscription', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('inscription', [AuthController::class, 'register'])->name('register.submit');

Route::prefix('edition')->group(function () {
    Route::get('/', [EditController::class, 'show'])->name('dashboard');
    Route::prefix('actualites')->group(function(){
        Route::get('/', [NewsController::class, 'adminIndex'])->name('news.index');
        Route::get('/creer', [NewsController::class, 'create'])->name('news.create');
        Route::post('/creer', [NewsController::class, 'store'])->name('news.store');
    });

    Route::prefix('equipes')->group(function(){
        Route::get('/', [TeamController::class, 'adminIndex'])->name('teams.index');
        Route::post('/', [TeamController::class, 'store'])->name('teams.store');
        Route::delete('/supprimer/{id}', [TeamController::class, 'destroy'])->name('teams.delete');
    });
    Route::prefix('championnat')->group(function(){
        Route::post('/', [ChampionshipController::class, 'store'])->name('championship.store');
        Route::prefix('/groupes')->group(function(){
            Route::get('/', [GroupController::class, 'adminIndex'])->name('championship.group');
            Route::post('/', [GroupController::class, 'store'])->name('championship.update');
            Route::post('/ajouter-equipe', [GroupController::class, 'addTeamToGroup'])->name('championship.group.addTeam');
            Route::delete('/supprimer-equipe/{group_id}/{team_id}', [GroupController::class, 'removeTeamFromGroup'])->name('championship.group.removeTeam');
            Route::delete('/supprimer/{id}', [GroupController::class, 'destroy'])->name('championship.group.delete');
        });
        Route::prefix('match')->group(function(){
            Route::get('/', [GameController::class, 'adminIndex'])->name('championship.game');
            Route::post('/', [GameController::class, 'store'])->name('championship.game.store');
            Route::delete('/supprimer/{id}', [CalendarController::class, 'destroy'])->name('championship.game.delete');
        });
    });
    Route::get('deconnexion', [AuthController::class, 'logout'])->name('logout');
    Route::get('profil', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('profil', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('modifier-mot-de-passe', [AuthController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('modifier-mot-de-passe', [AuthController::class, 'changePassword'])->name('password.update');
});


