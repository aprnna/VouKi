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
        'latitude',
        'longitude',
        'city',
        'province',
        'country',
        'detail_location',
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

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'event_categories', 'event_id', 'category_id');
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'event_skills', 'event_id', 'skill_id');
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()
            ->where('type', 'event')
            ->avg('rating') ?: 0;
    }
}
