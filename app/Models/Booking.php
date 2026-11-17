<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'staff_id',
        'service_id',
        'booking_type',
        'address',
        'latitude',
        'longitude',
        'scheduled_at',
        'status',
        'total_price',
        'notes',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    // Relasi: Booking milik satu user (pelanggan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Booking menggunakan satu kendaraan tertentu
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Relasi: Booking dikerjakan oleh satu staff (bisa null)
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    // Relasi: Booking memilih satu jenis layanan
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Relasi: Booking memiliki satu data pembayaran
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // Relasi: Booking memiliki satu ulasan (review)
    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
