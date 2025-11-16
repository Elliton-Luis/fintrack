<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Transaction;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = [
        'name',
        'type',
        'icon_id',
        'user_id'
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function icon()
{
    return $this->belongsTo(Icon::class);
}
}
