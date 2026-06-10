<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            
            Log::info('Password reset requested for: ' . $request->email);

            $status = Password::sendResetLink(
                $request->only('email')
            );

            if ($status === Password::RESET_LINK_SENT) {
                Log::info('Reset link sent successfully');
                return back()->with('status', 'Link reset password telah dikirim ke email Anda!');
            }

            Log::error('Failed to send reset link: ' . $status);
            return back()->withErrors(['email' => 'Gagal mengirim link reset. Silakan coba lagi.']);

        } catch (\Exception $e) {
            Log::error('Password reset error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}