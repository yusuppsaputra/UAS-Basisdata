<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poliklinik extends Model
{
    protected $table = 'poliklinik';
    protected $primaryKey = 'id_poli';
    protected $guarded = ['id_poli'];
    public $timestamps = true;

    /**
     * Get the rumah sakit that owns this poliklinik
     */
    public function rumahSakit(): BelongsTo
    {
        return $this->belongsTo(RumahSakit::class, 'id_rumahsakit', 'id_rumahsakit');
    }

    /**
     * Get all dokters in this poliklinik
     */
    public function dokter(): HasMany
    {
        return $this->hasMany(Dokter::class, 'id_poli', 'id_poli');
    }

    /**
     * Get all dokters in this poliklinik (alias)
     */
    public function dokters(): HasMany
    {
        return $this->dokter();
    }
}
