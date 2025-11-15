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
        Schema::create('dokter', function (Blueprint $table) {
            $table->id('id_dokter');
            $table->foreignId('id_rumahsakit')->constrained('rumah_sakit', 'id_rumahsakit')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_poli')->constrained('poliklinik', 'id_poli')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_dokter', 100);
            $table->string('spesialisasi', 100);
            $table->string('no_str', 20)->unique();
            $table->string('no_telepon', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};
