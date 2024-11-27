<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Regency extends Model
{
    public function province() : BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
}
