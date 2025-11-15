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
        Schema::create('poliklinik', function (Blueprint $table) {
            $table->id('id_poli');
            $table->foreignId('id_rumahsakit')->constrained('rumah_sakit', 'id_rumahsakit')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_poli', 100);
            $table->integer('lantai');
            $table->string('jam_operasional', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poliklinik');
    }
};
