<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPraktek extends Model
{
    protected $table = 'jadwal_praktek';
    protected $primaryKey = 'id_jadwal';
    protected $guarded = ['id_jadwal'];
    public $timestamps = true;

    /**
     * Get the dokter that owns this jadwal praktek
     */
    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }
}
