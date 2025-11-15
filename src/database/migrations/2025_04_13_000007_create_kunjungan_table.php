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
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id('id_kunjungan');
            $table->foreignId('id_pasien')->constrained('pasien', 'id_pasien')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_dokter')->constrained('dokter', 'id_dokter')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('tanggal_kunjungan');
            $table->text('keluhan');
            $table->text('diagnosa')->nullable();
            $table->decimal('biaya_admin', 10, 2)->default(0);
            $table->enum('status', ['Selesai', 'Batal', 'Proses'])->default('Proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan');
    }
};
