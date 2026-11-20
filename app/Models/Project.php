<?php

namespace App\Models;

use App\Support\Text;
use App\Support\Uploads;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function getImageUrlAttribute(): ?string
    {
        return Uploads::url($this->image);
    }

    /** ["PHP", "Laravel", ...] from the comma separated "tools" field. */
    public function getToolListAttribute(): array
    {
        return Text::csv($this->tools);
    }

    /** One bullet per line of the "highlights" field. */
    public function getHighlightListAttribute(): array
    {
        return Text::lines($this->highlights);
    }
}
