<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'rating',
        'comment',
    ];

    // Relasi: Review milik satu booking tertentu
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // Relasi: Review ditulis oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
