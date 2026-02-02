<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dokter extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    protected $guarded = ['id_dokter'];
    public $timestamps = true;

    /**
     * Get the rumah sakit that employs this dokter
     */
    public function rumahSakit(): BelongsTo
    {
        return $this->belongsTo(RumahSakit::class, 'id_rumahsakit', 'id_rumahsakit');
    }

    /**
     * Get the poliklinik that this dokter works at
     */
    public function poliklinik(): BelongsTo
    {
        return $this->belongsTo(Poliklinik::class, 'id_poli', 'id_poli');
    }

    /**
     * Get all jadwal praktek for this dokter
     */
    public function jadwalPraktek(): HasMany
    {
        return $this->hasMany(JadwalPraktek::class, 'id_dokter', 'id_dokter');
    }

    /**
     * Get all jadwal praktek for this dokter (alias)
     */
    public function jadwalPrakteks(): HasMany
    {
        return $this->jadwalPraktek();
    }

    /**
     * Get all kunjungans for this dokter
     */
    public function kunjungan(): HasMany
    {
        return $this->hasMany(Kunjungan::class, 'id_dokter', 'id_dokter');
    }

    /**
     * Get all kunjungans for this dokter (alias)
     */
    public function kunjungans(): HasMany
    {
        return $this->kunjungan();
    }

    /**
     * Mutator to ensure upload_gambar is stored as a string path.
     * Handles accidental arrays (defensive) to prevent DB binding errors.
     */
    public function setUploadGambarAttribute($value): void
    {
        if (is_array($value)) {
            // If it's a numeric array with a string path, take first
            if (isset($value[0]) && is_string($value[0])) {
                $this->attributes['upload_gambar'] = $value[0];

                return;
            }

            // If associative with common keys
            if (isset($value['path']) && is_string($value['path'])) {
                $this->attributes['upload_gambar'] = $value['path'];

                return;
            }

            if (isset($value['name']) && is_string($value['name'])) {
                $this->attributes['upload_gambar'] = $value['name'];

                return;
            }

            // Fallback: null to avoid array-to-string DB errors
            $this->attributes['upload_gambar'] = null;

            return;
        }

        $this->attributes['upload_gambar'] = $value;
    }
}
