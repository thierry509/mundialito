<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Str;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Services\SocialAuthService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
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
        ])->withInput();
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $request->email,
            'roles' => 'user',
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));


        Auth::login($user);

        return redirect(route('verification.notice'))   ;
        // return redirect()->back();
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
        if (!in_array($provider, ['google', 'facebook'])) {
            abort(404);
        }

        try {
            $socialUser = Socialite::driver($provider)->user();

            $user = $this->socialAuthService->findOrCreateUser($socialUser, $provider);

            auth()->login($user, true);

            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e) {
            Log::error("Erreur de social login avec {$provider}", ['exception' => $e]);
            return redirect('/connexion')->withErrors([
                'error' => $e->getMessage() ?? 'Échec de l\'authentification avec ' . ucfirst($provider)
            ]);
        }
    }

    public function showProfile()
    {
        return Inertia::render('Users.Profil', [
            'user' => Auth::user(),
        ]);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $validated = $request->validated();

        $user = Auth::user();

        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone' => $validated['phone'],
        ]);
        return redirect()->back();
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $user->update([
            'password' => $validated['password'],
        ]);
        return redirect()->back();
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));
        return $status === Password::RESET_LINK_SENT
            ? view('auth.passwords-sent')->with('email', $request->email)
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request)
    {
        $token = request('token');
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $validated = $request->validated();
        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );
        } catch (\Exception $e) {
            dd($e);
        }
        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
