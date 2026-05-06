<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    protected $fillable = ['user_id', 'course_name', 'level', 'price', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
