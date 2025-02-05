<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Questions extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'question', 'status', 'created_at', 'updated_at'];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, 'question_id');
    }
    public function singleAnswer(User $user)
    {
        return $this->answers()->where('user_id', $user->id)->first();
    }
}
