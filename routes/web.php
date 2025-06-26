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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChampionshipController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\EmailVerifyController;
use App\Http\Controllers\RegulationController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\SitemapController;
use App\Models\Championship;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/proxy-composant', function () {
    $response = Http::get('https://desirthierry.net//js/thierry-banner.js');

    return response($response->body(), $response->status())
        ->header('Content-Type', $response->header('Content-Type'));
});

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Calendrier des matchs
Route::get('/calendrier', [CalendarController::class, 'index'])->name('calendar');

// Résultats des matchs
Route::get('/match', [GameController::class, 'index'])->name('games');

// Classements des poules
Route::get('/poules', [GroupController::class, 'index'])->name('groups');

// Phase à élimination directe
Route::get('/elimination', [KnockoutController::class, 'index'])->name('knockout');

// Liste des équipes
Route::get('/equipes', [TeamController::class, 'index'])->name('teams');

// Détail d'une équipe
Route::get('/equipes/{id}', [TeamController::class, 'show'])->name('teams.show');

Route::get('palmares', [ChampionshipController::class, 'index'])->name('prize-list');
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

Route::get('conditions-generales-utilisation', [AboutController::class, 'cgu'])->name('cgu');
Route::get('mentions-legales', [AboutController::class, 'legal'])->name('legal');
Route::get('politique-de-confidentialite', [AboutController::class, 'privacy'])->name('privacy');
// FAQ
Route::get('/faq', [FaqController::class, 'index'])->name('faq');

Route::get('/test-mail', function () {
    return view('vendor.mail.html.message');
});
// routes/web.php
Route::get('/sitemap.xml', [SitemapController::class, 'index']);


Route::middleware('guest')->group(function () {
    Route::get('connexion', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('connexion', [AuthController::class, 'login'])->name('login.submit');

    Route::get('inscription', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('inscription', [AuthController::class, 'register'])->name('register.submit');


    Route::get('mot-de-passe-oublie', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('mot-de-passe-oublie', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reinitialiser-mot-de-passe/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reinitialiser-mot-de-passe', [AuthController::class, 'resetPassword'])->name('password.reset.post');

    Route::get('/{provider}/redirection', [AuthController::class, 'redirectToProvider'])
        ->where('provider', 'google|facebook')
        ->name('social.redirect');

    Route::get('/{provider}/rappel', [AuthController::class, 'handleProviderCallback'])
        ->where('provider', 'google|facebook')
        ->name('social.callback');
});


Route::middleware(['auth'])->group(function () {

    // Afficher la notice de vérification
    Route::get('/email/verify', [EmailVerifyController::class, 'notice'])
        ->name('verification.notice');

    // Traiter la vérification
    Route::get('/email/verify/{id}/{hash}', [EmailVerifyController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');

    // Renvoyer le lien
    Route::post('/email/verification-notification', [EmailVerifyController::class, 'send'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::post('/deconnexion', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth',  'verified')->prefix('edition')->group(function () {
    Route::get('/', [EditController::class, 'show'])->name('dashboard');
    Route::prefix('actualites')->group(function () {
        Route::get('/', [NewsController::class, 'adminIndex'])->name('news.index');
        Route::get('/creer', [NewsController::class, 'create'])->name('news.create');
        Route::post('/creer', [NewsController::class, 'store'])->name('news.store');
        Route::get('/modifier/{slug}', [NewsController::class, 'edit'])->name('news.edit');
        Route::put('/modifier/{slug}', [NewsController::class, 'update'])->name('news.edit');
        Route::delete('/supprimer/{slug}', [NewsController::class, 'destroy'])->name('news.delete');
    });
    Route::prefix('equipes')->group(function () {
        Route::get('/', [TeamController::class, 'adminIndex'])->name('teams.index');
        Route::post('/', [TeamController::class, 'store'])->name('teams.store');
        Route::delete('/supprimer/{id}', [TeamController::class, 'destroy'])->name('teams.delete');
    });
    Route::prefix('championnat')->group(function () {
        Route::post('/', [ChampionshipController::class, 'store'])->name('championship.store');
        Route::prefix('/groupes')->group(function () {
            Route::get('/', [GroupController::class, 'adminIndex'])->name('championship.group');
            Route::post('/', [GroupController::class, 'store'])->name('championship.update');
            Route::post('/ajouter-equipe', [GroupController::class, 'addTeamToGroup'])->name('championship.group.addTeam');
            Route::delete('/supprimer-equipe/{group_id}/{team_id}', [GroupController::class, 'removeTeamFromGroup'])->name('championship.group.removeTeam');
            Route::delete('/supprimer/{id}', [GroupController::class, 'destroy'])->name('championship.group.delete');
        });
        Route::prefix('/elimination')->group(function () {
            Route::get('/', [KnockoutController::class, 'adminIndex'])->name('championship.knockout');
        });
        Route::prefix('/match')->group(function () {
            Route::get('/', [GameController::class, 'adminIndex'])->name('championship.game');
            Route::post('/', [GameController::class, 'store'])->name('championship.game.store');
            Route::delete('/supprimer/{id}', [GameController::class, 'destroy'])->name('championship.game.delete');
            Route::put('/', [GameController::class, 'update'])->name('championship.game->update');
            Route::put('/reporte/{id}', [GameController::class, 'postpone'])->name('championship.game.postpone');
            Route::put('/en-direct/{id}', [GameController::class, 'live'])->name('championship.game.live');
            Route::put('/replanifer/{id}', [GameController::class, 'unpostpone'])->name('championship.game.unpostpone');
            Route::put('/terminer/{id}', [GameController::class, 'end'])->name('championship.game.end');
        });
        Route::prefix('parametre')->group(function () {
            Route::get('/', [ChampionshipController::class, 'setting'])->name('championship.setting');
            Route::put('/', [ChampionshipController::class, 'updateSettings'])->name('championship.setting.post');
        });
    });
    Route::prefix('/profil')->group(function () {
        Route::get('/', [AuthController::class, 'showProfile'])->name('profile');
        Route::put('', [AuthController::class, 'updateProfile'])->name('profile.update');
        Route::get('/moderation', [AdminController::class, 'index'])->name('moderation.index');
        Route::put('/moderation', [AdminController::class, 'updateRoles'])->name('moderation.update');
    });

    Route::put('/modifier-mots-de-passe', [AuthController::class, 'updatePassword'])->name('password.update');
    Route::get('modifier-mot-de-passe', [AuthController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('modifier-mot-de-passe', [AuthController::class, 'changePassword'])->name('password.update');
});
