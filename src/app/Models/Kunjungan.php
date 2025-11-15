<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kunjungan extends Model
{
    protected $table = 'kunjungan';
    protected $primaryKey = 'id_kunjungan';
    protected $guarded = ['id_kunjungan'];
    public $timestamps = true;

    /**
     * Get the pasien that made this kunjungan
     */
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    /**
     * Get the dokter that handled this kunjungan
     */
    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    /**
     * Get all reseps for this kunjungan
     */
    public function resep(): HasMany
    {
        return $this->hasMany(Resep::class, 'id_kunjungan', 'id_kunjungan');
    }

    /**
     * Get all reseps for this kunjungan (alias)
     */
    public function reseps(): HasMany
    {
        return $this->resep();
    }
}
