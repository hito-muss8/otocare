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
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel users, jika user dihapus, kendaraannya ikut terhapus (cascade)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('vehicle_type', ['motor', 'mobil_sedan', 'suv', 'truck']);
            $table->string('brand'); // Contoh: Toyota, Honda
            $table->string('model'); // Contoh: Avanza, Civic
            $table->string('license_plate')->unique(); // Plat nomor
            $table->string('color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
