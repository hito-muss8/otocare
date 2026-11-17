<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
Schema::create('services', function (Blueprint $table) {
    $table->id();
    $table->string('name'); // Contoh: Cuci Salju & Vacuum
    $table->text('description')->nullable();
    $table->decimal('price', 10, 2); // Harga layanan
    $table->integer('estimated_duration_minutes')->default(30); // Estimasi waktu
    $table->timestamps();
});

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
