<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Category;
use App\Models\User;

class Transaction extends Model
{
    use SoftDeletes;

    protected $table = "transactions";

    protected $fillable = [
        'user_id',
        'description',
        'amount',
        'type',
        'recurring',
        'category_id',
        'transaction_date',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
