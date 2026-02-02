

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
        Schema::create('rumah_sakit', function (Blueprint $table) {
            $table->id('id_rumahsakit');
            $table->string('upload_gambar')->nullable();
            $table->string('nama', 100);
            $table->string('alamat', 255);
            $table->string('kota', 50);
            $table->string('provinsi', 50);
            $table->string('no_telepon', 15);
            $table->enum('kelas_rumah_sakit', ['A', 'B', 'C', 'D']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumah_sakit');
    }
};
