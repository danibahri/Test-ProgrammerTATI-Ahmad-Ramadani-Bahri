<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyLog extends Model
{
    protected $table = 'daily_log';

    protected $fillable = [
        'user_id',
        'log_date',
        'activity_description',
        'status',
        'attachment',
    ];

    /**
     * Get the user that owns the daily log.
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include logs for a specific user.
     */
    public function scopeBelongsToUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
