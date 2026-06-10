<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

   
    protected $primaryKey = 'id';

   
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'email_verified_at',
        'google_id',
        'github_id',
        'provider',
        'avatar',
        'last_login_at',
        'banned_at',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'banned_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    
    public function datasets(): HasMany
    {
        return $this->hasMany(Dataset::class, 'user_id');
    }

    
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    
    public function downloads(): HasMany
    {
        return $this->hasMany(Download::class, 'user_id');
    }

   
    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'superadmin'], true);
    }

   
    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

   
    public function isBanned(): bool
    {
        return $this->banned_at !== null;
    }

    
    public function isActive(): bool
    {
        return $this->is_active && !$this->isBanned();
    }

   
    public function hasGoogle(): bool
    {
        return !empty($this->google_id);
    }

   
    public function hasGithub(): bool
    {
        return !empty($this->github_id);
    }

    
    public function hasPassword(): bool
    {
        return !empty($this->password);
    }

   
    public function getAvatarUrlAttribute(): string
    {
        if (!empty($this->avatar)) {
            return $this->avatar;
        }
        
        
        return 'https://gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '?d=mp&s=200';
    }

    
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->whereNull('banned_at');
    }

   
    public function scopeAdmins($query)
    {
        return $query->whereIn('role', ['admin', 'superadmin']);
    }

    
    public function scopeWithSocialLogin($query, ?string $provider = null)
    {
        if ($provider === 'google') {
            return $query->whereNotNull('google_id');
        }
        
        if ($provider === 'github') {
            return $query->whereNotNull('github_id');
        }
        
        return $query->whereNotNull('google_id')
                    ->orWhereNotNull('github_id');
    }
   
public function posts()
{
    return $this->hasMany(Post::class);
}
}