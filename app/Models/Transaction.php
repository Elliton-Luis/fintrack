<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
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
}
