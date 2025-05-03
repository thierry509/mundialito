<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        // Ici, tu traiteras l'envoi du formulaire (validation, email, etc.)
        return back()->with('success', 'Message envoyé avec succès !');
    }
}
