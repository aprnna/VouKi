<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'latitute',
        'longitude',
        'city',
        'province',
        'country',
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
}
