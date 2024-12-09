<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category', 'status'];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_categories', 'category_id', 'event_id');
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_categories', 'category_id', 'user_detail_id');
    }
}
