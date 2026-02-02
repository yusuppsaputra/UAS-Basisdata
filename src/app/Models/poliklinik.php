<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Poliklinik extends Model
{
    protected $table = 'poliklinik';
    protected $primaryKey = 'id_poli';
    protected $guarded = ['id_poli'];
    public $timestamps = true;

    /**
     * The rumah sakit this poliklinik belongs to
     */
    public function rumahSakit(): BelongsTo
    {
        return $this->belongsTo(RumahSakit::class, 'id_rumahsakit', 'id_rumahsakit');
    }
}
