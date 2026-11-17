<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'estimated_duration_minutes',
    ];

    // Relasi: Layanan dapat dipilih di banyak booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
