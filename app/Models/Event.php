<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'banner',
        'location',
        'max_volunteers',
        'category',
        'prefered_skills',
        'RegisterStart',
        'RegisterEnd',
        'EventStart',
        'EventEnd',
        'is_active',
    ];

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function volunteers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_user',  'event_id', 'user_id')->withTimestamps();
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()
        ->where('type', 'event')
        ->avg('rating') ?: 0;
    }
}
