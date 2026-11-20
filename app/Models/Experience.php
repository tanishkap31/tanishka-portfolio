<?php

namespace App\Models;

use App\Support\Text;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $guarded = [];

    /** One bullet per line of the description. */
    public function getBulletListAttribute(): array
    {
        return Text::lines($this->description);
    }
}
