<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = ['event_id', 'question', 'status', 'created_at', 'updated_at'];
}
