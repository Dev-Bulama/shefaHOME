<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    protected $fillable = [
        'session_id',
        'ip',
        'country',
        'state',
        'city',
        'page',
        'page_title',
        'referrer',
        'browser',
        'device',
        'is_bot',
    ];

    protected $casts = [
        'is_bot' => 'boolean',
    ];

    /**
     * Scope: records created today.
     */
    public function scopeToday(Builder $q): Builder
    {
        return $q->whereDate('created_at', today());
    }

    /**
     * Scope: records created in the current calendar month.
     */
    public function scopeThisMonth(Builder $q): Builder
    {
        return $q->whereYear('created_at', now()->year)
                 ->whereMonth('created_at', now()->month);
    }

    /**
     * Scope: records that are not bots.
     */
    public function scopeNotBot(Builder $q): Builder
    {
        return $q->where('is_bot', false);
    }
}
