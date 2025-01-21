<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Questions extends Model
{
    protected $fillable = ['event_id', 'question', 'status', 'created_at', 'updated_at'];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
