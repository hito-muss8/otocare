<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_type',
        'brand',
        'model',
        'license_plate',
        'color',
    ];

    // Relasi: Kendaraan milik satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Kendaraan bisa memiliki banyak riwayat booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
