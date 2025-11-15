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
        Schema::create('resep', function (Blueprint $table) {
            $table->id('id_resep');
            $table->foreignId('id_kunjungan')->constrained('kunjungan', 'id_kunjungan')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_obat')->constrained('obat', 'id_obat')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jumlah');
            $table->text('aturan_pakai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep');
    }
};
