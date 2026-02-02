<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('dokter', 'upload_gambar')) {
            Schema::table('dokter', function (Blueprint $table) {
                $table->string('upload_gambar')->nullable();
            });
        }

        if (! Schema::hasColumn('pasien', 'upload_gambar')) {
            Schema::table('pasien', function (Blueprint $table) {
                $table->string('upload_gambar')->nullable();
            });
        }

        if (! Schema::hasColumn('obat', 'upload_gambar')) {
            Schema::table('obat', function (Blueprint $table) {
                $table->string('upload_gambar')->nullable();
            });
        }

        if (! Schema::hasColumn('jadwal_praktek', 'upload_gambar')) {
            Schema::table('jadwal_praktek', function (Blueprint $table) {
                $table->string('upload_gambar')->nullable();
            });
        }

        if (! Schema::hasColumn('kunjungan', 'upload_gambar')) {
            Schema::table('kunjungan', function (Blueprint $table) {
                $table->string('upload_gambar')->nullable();
            });
        }

        if (! Schema::hasColumn('resep', 'upload_gambar')) {
            Schema::table('resep', function (Blueprint $table) {
                $table->string('upload_gambar')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('dokter', 'upload_gambar')) {
            Schema::table('dokter', function (Blueprint $table) {
                $table->dropColumn('upload_gambar');
            });
        }

        if (Schema::hasColumn('pasien', 'upload_gambar')) {
            Schema::table('pasien', function (Blueprint $table) {
                $table->dropColumn('upload_gambar');
            });
        }

        if (Schema::hasColumn('obat', 'upload_gambar')) {
            Schema::table('obat', function (Blueprint $table) {
                $table->dropColumn('upload_gambar');
            });
        }

        if (Schema::hasColumn('jadwal_praktek', 'upload_gambar')) {
            Schema::table('jadwal_praktek', function (Blueprint $table) {
                $table->dropColumn('upload_gambar');
            });
        }

        if (Schema::hasColumn('kunjungan', 'upload_gambar')) {
            Schema::table('kunjungan', function (Blueprint $table) {
                $table->dropColumn('upload_gambar');
            });
        }

        if (Schema::hasColumn('resep', 'upload_gambar')) {
            Schema::table('resep', function (Blueprint $table) {
                $table->dropColumn('upload_gambar');
            });
        }
    }
};
