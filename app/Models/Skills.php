<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    protected $fillable = ['skill', 'status', 'created_at', 'updated_at'];
}
