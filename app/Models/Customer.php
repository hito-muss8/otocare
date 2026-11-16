<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    protected $table = 'customers';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'phone',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'customer_id');
    }
}