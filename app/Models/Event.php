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
        'status',
        'isActive',
    ];

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function volunteers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_user',  'event_id', 'user_id')->withTimestamps();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'event_categories', 'event_id', 'category_id')->withTimestamps();
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'event_skills', 'event_id', 'skill_id')->withTimestamps();
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Questions::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->volunteers()
            ->avg('event_rating') ?: 0;
    }

    public function getAllEventReviewsAttribute()
    {
        return $this->volunteers()
            ->select('name', 'event_rating', 'user_review', 'event_id', 'user_id', 'event_user.created_at', 'event_user.updated_at')
            ->get();
    }

    public function getReviewsEventAttribute()
    {
        return $this->volunteers()
            ->select('name', 'event_rating', 'user_review', 'user_rating', 'event_id', 'user_id')
            ->get();
    }

    public function getOrganizerAverageRatingAttribute()
    {
        return $this->organizer()
            ->join('events', 'users.id', 'organizer_id')
            ->join('event_user', 'events.id', 'event_user.event_id')
            ->avg('event_rating') ?: 0;
    }

    public function updateReview($data)
    {
        $this->volunteers()->where('user_id', $data['user_id'])->update(['user_review' => $data['user_review'], 'event_rating' => $data['event_rating']]);
    }

    public function updateUserRating($data)
    {
        $this->volunteers()->where('user_id', $data['user_id'])->update(['user_rating' => $data['user_rating']]);
    }

    public function getAllUsersRatingAttribute()
    {
        return $this->volunteers()
            ->select('name', 'user_rating', 'user_id', 'event_id')
            ->get();
    }
}
