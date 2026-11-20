<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    // "education" has no plural, so the table name is set explicitly.
    protected $table = 'education';

    protected $guarded = [];
}
