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
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegulationController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\FaqController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

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

Route::get('creer-actualites', [NewsController::class, 'create'])->name('news.store');

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
