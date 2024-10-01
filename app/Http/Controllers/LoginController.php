<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Ad;

class LoginController extends Controller
{

    public function authenticate(Request $request, ? Ad $ad): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            //dd($ad->id);
            return empty($ad->id) ? redirect()->route('dashboard') : redirect()->route('ads.show', $ad->id);
            
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logOut()
    {

        Auth::logout();

        return view('login');
    }
    /* Displays form to request a new password */
    public function passwordRequest()
    {
        return view('forgot-password');
    }
    /* Emails the user the reset link */
    public function passwordEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
    /* Displays the form to update and save the new password*/
    public function passwordReset(string $token)
    {
        return view('reset-password', ['token' => $token]);
    }
    /* Updates the password in the database*/
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

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

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('users.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * Displays the login page.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new registered user.
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
