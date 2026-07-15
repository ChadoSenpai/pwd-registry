<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate(['email' => ['required', 'email'], 'password' => ['required', 'string']]);

        $user = User::where('email', $data['email'])->first();
        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');
        }

        if ($user->google2fa_enabled) {
            $request->session()->put('2fa.login.id', $user->id);
            $request->session()->put('2fa.login.remember', $request->boolean('remember'));
            return redirect()->route('login.2fa.show');
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('home');
    }

    public function editPassword(): View
    {
        return view('auth.change-password');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $request->user()->forceFill([
            'password' => bcrypt($data['password']),
        ])->save();

        return to_route('settings.password')->with('success', 'Your password has been changed successfully.');
    }

    public function googleAuthenticator(): View
    {
        $secret = 'JBSWY3DPEHPK3PXP';
        $otpAuthUrl = 'otpauth://totp/PWD-Registry:' . urlencode(Auth::user()->email) . '?secret=' . $secret . '&issuer=PWD-Registry&algorithm=SHA1&digits=6&period=30';
        $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' . urlencode($otpAuthUrl);

        return view('auth.google-authenticator', compact('secret', 'otpAuthUrl', 'qrUrl'));
    }
}
