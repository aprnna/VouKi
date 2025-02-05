<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VolunteerEvent extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return \Database\Factories\VolunteerFactory::new();
    }

    protected $table = 'event_user';

    protected $fillable = ['event_id', 'user_id', 'user_acceptance_status', 'user_rating', 'user_review', 'event_rating', 'status', 'created_at', 'updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
