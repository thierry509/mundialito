<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Logique de connexion
    }

    public function register(Request $request)
    {
        // Logique d'inscription
    }

    public function logout()
    {
        // Logique de déconnexion
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function showRegisterForm()
    {
        return view('auth.register');
    }
}
