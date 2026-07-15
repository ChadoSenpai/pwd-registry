<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\TotpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TwoFactorController extends Controller
{
    public function showLoginChallenge(): View
    {
        if (! session()->has('2fa.login.id')) {
            return redirect()->route('login');
        }

        return view('auth.two-factor-login');
    }

    public function verifyLoginChallenge(Request $request): RedirectResponse
    {
        $request->validate(['otp' => ['required', 'digits:6']]);

        $userId = session('2fa.login.id');
        $remember = session('2fa.login.remember', false);
        $user = Auth::getProvider()->retrieveById($userId);

        if (! $user || ! $user->google2fa_enabled || ! TotpService::verifyCode($user->google2fa_secret, $request->input('otp'))) {
            return back()->withErrors(['otp' => 'The provided authentication code is invalid.']);
        }

        Auth::login($user, $remember);
        session()->forget(['2fa.login.id', '2fa.login.remember']);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function showSettings(): View
    {
        $user = Auth::user();
        $secret = $user->google2fa_secret ?: TotpService::generateSecret();

        if (! $user->google2fa_secret) {
            $user->google2fa_secret = $secret;
            $user->save();
        }

        $otpAuthUrl = TotpService::getTotpUri($secret, 'PWD-Registry', $user->email);
        $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' . urlencode($otpAuthUrl);

        return view('auth.google-authenticator', compact('user', 'secret', 'otpAuthUrl', 'qrUrl'));
    }

    public function enable(Request $request): RedirectResponse
    {
        $request->validate(['otp' => ['required', 'digits:6']]);

        $user = Auth::user();
        $user->google2fa_secret = $user->google2fa_secret ?: TotpService::generateSecret();
        $user->save();

        if (! TotpService::verifyCode($user->google2fa_secret, $request->input('otp'))) {
            return back()->withErrors(['otp' => 'The provided authentication code is invalid.']);
        }

        $user->google2fa_enabled = true;
        $user->save();

        return back()->with('success', 'Google Authenticator is now enabled.');
    }

    public function disable(Request $request): RedirectResponse
    {
        $request->validate(['otp' => ['required', 'digits:6']]);

        $user = Auth::user();
        if (! TotpService::verifyCode($user->google2fa_secret, $request->input('otp'))) {
            return back()->withErrors(['otp' => 'The provided authentication code is invalid.']);
        }

        $user->google2fa_enabled = false;
        $user->save();

        return back()->with('success', 'Google Authenticator has been disabled.');
    }
}
