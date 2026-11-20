<?php

namespace App\Models;

use App\Support\Uploads;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $guarded = [];

    public function getFileUrlAttribute(): ?string
    {
        return Uploads::url($this->file);
    }

    public function getIsImageAttribute(): bool
    {
        $extension = strtolower(pathinfo((string) $this->file, PATHINFO_EXTENSION));

        return in_array($extension, ['jpg', 'jpeg', 'png', 'webp'], true);
    }
}
