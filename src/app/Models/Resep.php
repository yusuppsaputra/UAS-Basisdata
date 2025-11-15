<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resep extends Model
{
    protected $table = 'resep';
    protected $primaryKey = 'id_resep';
    protected $guarded = ['id_resep'];
    public $timestamps = true;

    /**
     * Get the kunjungan that generated this resep
     */
    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class, 'id_kunjungan', 'id_kunjungan');
    }

    /**
     * Get the obat prescribed in this resep
     */
    public function obat(): BelongsTo
    {
        return $this->belongsTo(Obat::class, 'id_obat', 'id_obat');
    }
}
