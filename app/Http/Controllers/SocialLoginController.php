<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Nova\Nova;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class SocialLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirectToLinkedIn()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function processGoogleCallback(Request $request)
    {
        try {
            $socialUser = Socialite::driver('google')->user();
        } catch (InvalidStateException $exception) {
            return redirect()->route('nova.login')
                ->withErrors([
                    'email' => [
                        __($exception.'Google Login failed, please try again.'),
                    ],
                ]);
        }

        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName(),
                'password' => Str::random(32),
            ]
        );

        $this->guard()->login($user);

        return redirect()->intended(Nova::path());
    }

    public function create(Request $request)
    {
        return view('nova::auth/signup-create', ['name' => 'James']);
    }


    public function create_final(Request $request)
    {

        // $this->guard()->login($user);
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::firstOrCreate(
            request(['name', 'email', 'password'])
        );
        $this->guard()->login($user);

        return redirect()->intended(Nova::path());
    }

    public function processLinkedInCallback(Request $request)
    {
        try {
            $socialUser = Socialite::driver('linkedin')->user();
        } catch (InvalidStateException $exception) {
            return redirect()->route('nova.login')
                ->withErrors([
                    'email' => [
                        __($exception.'Google Login failed, please try again.'),
                    ],
                ]);
        }


        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName(),
                'password' => Str::random(32),
            ]
        );

        $this->guard()->login($user);

        return redirect()->intended(Nova::path());
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard(config('nova.guard'));
    }
}
