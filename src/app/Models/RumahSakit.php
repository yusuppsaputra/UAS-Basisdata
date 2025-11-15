<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RumahSakit extends Model
{
    protected $table = 'rumah_sakit';
    protected $primaryKey = 'id_rumahsakit';
    protected $guarded = ['id_rumahsakit'];
    public $timestamps = true;

    /**
     * Get all polikliniks for this rumah sakit
     */
    public function poliklinik(): HasMany
    {
        return $this->hasMany(Poliklinik::class, 'id_rumahsakit', 'id_rumahsakit');
    }

    /**
     * Get all dokters for this rumah sakit
     */
    public function dokter(): HasMany
    {
        return $this->hasMany(Dokter::class, 'id_rumahsakit', 'id_rumahsakit');
    }

    /**
     * Get all dokters for this rumah sakit (alias)
     */
    public function dokters(): HasMany
    {
        return $this->dokter();
    }
}
