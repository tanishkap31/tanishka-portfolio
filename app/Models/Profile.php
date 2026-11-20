<?php

namespace App\Models;

use App\Support\Uploads;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    protected $casts = [
        'open_for_work' => 'boolean',
    ];

    public function getPhotoUrlAttribute(): ?string
    {
        return Uploads::url($this->photo);
    }
}
