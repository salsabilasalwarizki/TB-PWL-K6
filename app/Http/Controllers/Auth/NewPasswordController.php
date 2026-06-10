<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'password.confirmed' => 'Password confirmation does not match',
            'password.min' => 'Password must be at least 8 characters',
        ]);

        try {
            Log::info('Password reset attempt for: ' . $request->email);

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($request->password),
                        'remember_token' => Str::random(60),
                    ])->save();

                    event(new PasswordReset($user));
                    
                    Log::info('Password reset successful for: ' . $user->email);
                }
            );

            if ($status === Password::PASSWORD_RESET) {
                return redirect()->route('login')->with('status', __($status));
            }

            Log::error('Password reset failed: ' . $status);
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Gagal reset password. Silakan coba lagi.']);

        } catch (\Exception $e) {
            Log::error('Password reset error: ' . $e->getMessage());
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}