<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        // Generate captcha baru setiap kali halaman login dibuka
        $a = rand(1, 9);
        $b = rand(1, 9);

        session([
            'captcha_question' => "$a + $b",
            'captcha_answer'   => $a + $b,
        ]);

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validasi captcha
        if ($request->captcha != session('captcha_answer')) {

            // generate ulang captcha ketika salah
            $a = rand(1, 9);
            $b = rand(1, 9);

            session([
                'captcha_question' => "$a + $b",
                'captcha_answer'   => $a + $b,
            ]);

            return back()->withErrors([
                'captcha' => 'Jawaban captcha salah!',
            ])->withInput();
        }

        // Lanjut autentikasi Breeze
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // setelah logout kembali ke login
    }
}
