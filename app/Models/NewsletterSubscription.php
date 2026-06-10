<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsletterSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'is_active',
        'token',
        'subscribed_at',
        'unsubscribed_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subscription) {
            if (empty($subscription->token)) {
                $subscription->token = Str::random(60);
            }
        });
    }

    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

   
    public static function isSubscribed($email)
    {
        return static::where('email', $email)->where('is_active', true)->exists();
    }
}