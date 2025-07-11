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
        Schema::create('booking_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('pelanggans')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('kelas_gyms')->onDelete('cascade');
            $table->dateTime('booking_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_kelas');
    }
};
