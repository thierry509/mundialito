<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\SocialAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    protected $socialAuthService;

    public function __construct(SocialAuthService $socialAuthService)
    {
        $this->socialAuthService = $socialAuthService;
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'Identifiant ou Mot passe Incorect',
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['first_name'],
            'email' => $request->email,
            'roles' => 'user',
            'password' => Hash::make($validated['password']),
        ]);

        dd();

        Auth::login($user);

        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if (request()->header('X-Inertia')) {
            return Inertia::location('/');
        } else {
            return redirect('/');
        }
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function showRegisterForm()
    {
        return view('auth.register');
    }


    /**
     * Redirection vers le provider
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Callback du provider
     */
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            // dd($socialUser->user);

            $user = $this->socialAuthService->findOrCreateUser($socialUser, $provider);

            auth()->login($user, true);

            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e) {
            dd($e);
            return redirect('/connexion')->withErrors([
                'message' => 'Échec de l\'authentification avec ' . ucfirst($provider)
            ]);
        }
    }
}
