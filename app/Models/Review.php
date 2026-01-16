<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'instagram',
        'rating',
        'text',
        'is_approved',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_approved' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get Gravatar URL for the user's email
     */
    public function getGravatarUrlAttribute(): string
    {
        $email = strtolower(trim($this->user->email ?? ''));
        $hash = md5($email);
        
        return "https://www.gravatar.com/avatar/{$hash}?s=80&d=mp";
    }

    /**
     * Get formatted Instagram handle (with @)
     */
    public function getInstagramHandleAttribute(): ?string
    {
        if (empty($this->instagram)) {
            return null;
        }

        $handle = ltrim($this->instagram, '@');
        
        return "@{$handle}";
    }

    /**
     * Scope: only approved reviews
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Scope: with verified email users only
     */
    public function scopeVerified($query)
    {
        return $query->whereHas('user', function ($q) {
            $q->whereNotNull('email_verified_at');
        });
    }
}
