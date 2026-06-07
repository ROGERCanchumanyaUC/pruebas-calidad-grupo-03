<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    protected $fillable = [
        'user_id', 'course_id', 'status', 'progress',
        'last_accessed_at', 'total_time_minutes', 'completed_at', 'enrolled_at',
    ];

    protected function casts(): array
    {
        return [
            'progress' => 'decimal:2',
            'last_accessed_at' => 'datetime',
            'completed_at' => 'datetime',
            'enrolled_at' => 'datetime',
            'total_time_minutes' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    // ── Scopes ──

    public function scopeActive($query)
    {
        return $query->where('status', 'activo');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completado');
    }
}
