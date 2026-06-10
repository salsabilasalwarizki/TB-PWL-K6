<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use App\Mail\NewsletterWelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ], [
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
        ]);

       
        if (NewsletterSubscription::isSubscribed($validated['email'])) {
            return response()->json([
                'success' => false,
                'message' => 'This email is already subscribed to our newsletter.',
            ], 422);
        }

        
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

        
        try {
            Mail::to($validated['email'])->send(new NewsletterWelcomeMail($subscription));
        } catch (\Exception $e) {
            Log::error('Newsletter welcome email failed: ' . $e->getMessage());
            
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing! Check your email for a welcome message.',
        ]);
    }

    
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