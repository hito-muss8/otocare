<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
Schema::create('bookings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
    // staff_id bisa kosong (nullable) jika belum diambil oleh petugas cuci manapun
    $table->foreignId('staff_id')->nullable()->constrained('users')->onDelete('set null');
    $table->foreignId('service_id')->constrained('services')->onDelete('restrict');
    
    $table->enum('booking_type', ['home_service', 'on_site']); // Panggilan atau datang ke tempat
    $table->text('address')->nullable(); // Diisi jika home_service
    $table->decimal('latitude', 10, 8)->nullable();
    $table->decimal('longitude', 11, 8)->nullable();
    
    $table->dateTime('scheduled_at'); // Jadwal cuci
    $table->enum('status', ['pending', 'confirmed', 'process', 'completed', 'cancelled'])->default('pending');
    $table->decimal('total_price', 10, 2);
    $table->text('notes')->nullable();
    $table->timestamps();
});

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
