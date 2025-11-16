<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Icon extends Model
{
    protected $table = "icons";

    protected $fillable = [
        'name',
        'class',
        'type'
    ];

    public function icon()
    {
        return $this->belongsTo(Icon::class);
    }
}
