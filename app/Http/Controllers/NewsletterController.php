<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use App\Mail\NewsletterWelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    /**
     * Subscribe ke newsletter
     */
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ], [
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
        ]);

        // Cek apakah email sudah terdaftar
        if (NewsletterSubscription::isSubscribed($validated['email'])) {
            return response()->json([
                'success' => false,
                'message' => 'This email is already subscribed to our newsletter.',
            ], 422);
        }

        // Cek apakah email pernah unsubscribe, re-activate
        $existing = NewsletterSubscription::where('email', $validated['email'])->first();
        
        if ($existing) {
            $existing->update([
                'is_active' => true,
                'subscribed_at' => now(),
                'unsubscribed_at' => null,
                'token' => \Illuminate\Support\Str::random(60),
            ]);
            $subscription = $existing;
        } else {
            $subscription = NewsletterSubscription::create([
                'email' => $validated['email'],
                'is_active' => true,
                'subscribed_at' => now(),
            ]);
        }

        // Kirim email welcome
        try {
            Mail::to($validated['email'])->send(new NewsletterWelcomeMail($subscription));
        } catch (\Exception $e) {
            Log::error('Newsletter welcome email failed: ' . $e->getMessage());
            // Tetap success karena subscription berhasil, hanya email yang gagal
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing! Check your email for a welcome message.',
        ]);
    }

    /**
     * Unsubscribe dari newsletter
     */
    public function unsubscribe($token)
    {
        $subscription = NewsletterSubscription::where('token', $token)->first();

        if (!$subscription) {
            return redirect()->route('home')
                ->with('error', 'Invalid unsubscribe link.');
        }

        $subscription->update([
            'is_active' => false,
            'unsubscribed_at' => now(),
        ]);

        return view('newsletter.unsubscribed', [
            'email' => $subscription->email,
        ]);
    }
}