<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    protected $fillable = ['skill', 'status'];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_skills', 'skill_id', 'event_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_skills', 'skill_id', 'user_detail_id');
    }
}
