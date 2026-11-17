<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
import Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'payment_gateway_reference',
        'payment_method',
        'amount',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    // Relasi: Pembayaran terikat pada satu booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}