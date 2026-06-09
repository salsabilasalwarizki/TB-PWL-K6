<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;

class SocialAuthController extends Controller
{
    private function configureHttpClient($driver)
    {
        if (app()->environment('local', 'development')) {
            $client = new Client([
                'verify' => false,
                'timeout' => 30,
            ]);
            $driver->setHttpClient($client);
        }
        return $driver;
    }

    public function redirectToGoogle()
    {
        $driver = Socialite::driver('google')->scopes(['profile', 'email']);
        $driver = $this->configureHttpClient($driver);
        return $driver->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            Log::info('=== GOOGLE CALLBACK STARTED ===');
            
            $driver = Socialite::driver('google');
            $driver = $this->configureHttpClient($driver);
            $googleUser = $driver->user();
            
            Log::info('Google user data:', [
                'id' => $googleUser->getId(),
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
            ]);
            
            // Find or create user
            $user = User::where('google_id', $googleUser->getId())->first();
            
            if (!$user) {
                $user = User::where('email', $googleUser->getEmail())->first();
                
                if ($user) {
                    Log::info('Updating existing user ID: ' . $user->id);
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                        'provider' => 'google',
                        'email_verified_at' => now(),
                    ]);
                } else {
                    Log::info('Creating new user');
                    $user = User::create([
                        'name' => $googleUser->getName() ?? 'Google User',
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                        'provider' => 'google',
                        'email_verified_at' => now(),
                        'password' => Hash::make(Str::random(32)),
                        'role' => 'user',
                    ]);
                    Log::info('New user created with ID: ' . $user->id);
                }
            }
            
            // Login user
            Log::info('Logging in user ID: ' . $user->id);
            Auth::login($user, true);
            
            // Save session
            session(['user_id' => $user->id]);
            session()->save();
            
            Log::info('After login:', [
                'auth_check' => Auth::check(),
                'auth_id' => Auth::id(),
                'session_id' => session()->getId(),
            ]);
            
            // Redirect ke home dengan URL penuh
            Log::info('Redirecting to: ' . url('/'));
            
            return redirect()->to(url('/'));
            
        } catch (\Exception $e) {
            Log::error('Google OAuth Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return redirect()->route('login')
                ->with('error', 'Google login failed: ' . $e->getMessage());
        }
    }

    public function redirectToGithub()
    {
        $driver = Socialite::driver('github')->scopes(['user:email']);
        $driver = $this->configureHttpClient($driver);
        return $driver->redirect();
    }

    public function handleGithubCallback()
    {
        try {
            Log::info('=== GITHUB CALLBACK STARTED ===');
            
            $driver = Socialite::driver('github');
            $driver = $this->configureHttpClient($driver);
            $githubUser = $driver->user();
            
            Log::info('GitHub user data:', [
                'id' => $githubUser->getId(),
                'email' => $githubUser->getEmail(),
                'nickname' => $githubUser->getNickname(),
            ]);
            
            $email = $githubUser->getEmail();
            if (!$email) {
                $email = $githubUser->getNickname() . '@github.com';
            }
            
            $user = User::where('github_id', $githubUser->getId())->first();
            
            if (!$user) {
                $user = User::where('email', $email)->first();
                
                if ($user) {
                    Log::info('Updating existing user ID: ' . $user->id);
                    $user->update([
                        'github_id' => $githubUser->getId(),
                        'avatar' => $githubUser->getAvatar(),
                        'provider' => 'github',
                        'email_verified_at' => now(),
                    ]);
                } else {
                    Log::info('Creating new user');
                    $user = User::create([
                        'name' => $githubUser->getName() ?? $githubUser->getNickname() ?? 'GitHub User',
                        'email' => $email,
                        'github_id' => $githubUser->getId(),
                        'avatar' => $githubUser->getAvatar(),
                        'provider' => 'github',
                        'email_verified_at' => now(),
                        'password' => Hash::make(Str::random(32)),
                        'role' => 'user',
                    ]);
                    Log::info('New user created with ID: ' . $user->id);
                }
            }
            
            // Login user
            Log::info('Logging in user ID: ' . $user->id);
            Auth::login($user, true);
            
            // Save session
            session(['user_id' => $user->id]);
            session()->save();
            
            Log::info('After login:', [
                'auth_check' => Auth::check(),
                'auth_id' => Auth::id(),
                'session_id' => session()->getId(),
            ]);
            
            // Redirect ke home
            Log::info('Redirecting to: ' . url('/'));
            
            return redirect()->to(url('/'));
            
        } catch (\Exception $e) {
            Log::error('GitHub OAuth Error:', [
                'error' => $e->getMessage(),
            ]);
            
            return redirect()->route('login')
                ->with('error', 'GitHub login failed: ' . $e->getMessage());
        }
    }
}