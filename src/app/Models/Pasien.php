<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';
    protected $guarded = ['id_pasien'];
    public $timestamps = true;

    /**
     * Get all kunjungans for this pasien
     */
    public function kunjungan(): HasMany
    {
        return $this->hasMany(Kunjungan::class, 'id_pasien', 'id_pasien');
    }

    /**
     * Get all kunjungans for this pasien (alias)
     */
    public function kunjungans(): HasMany
    {
        return $this->kunjungan();
    }
}
