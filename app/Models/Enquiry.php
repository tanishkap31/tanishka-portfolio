<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    /** Every status an enquiry can have: database value => label shown in the admin panel. */
    public const STATUSES = [
        'new' => 'New',
        'read' => 'Read',
        'replied' => 'Replied',
        'won' => 'Won',
        'closed' => 'Closed',
    ];

    protected $guarded = [];

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst((string) $this->status);
    }

    /** Bootstrap colour class for the status badge. */
    public function getStatusBadgeAttribute(): string
    {
        return [
            'new' => 'text-bg-warning',
            'read' => 'text-bg-secondary',
            'replied' => 'text-bg-primary',
            'won' => 'text-bg-success',
            'closed' => 'text-bg-dark',
        ][$this->status] ?? 'text-bg-secondary';
    }
}
