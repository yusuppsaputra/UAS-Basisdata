<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Obat extends Model
{
    protected $table = 'obat';
    protected $primaryKey = 'id_obat';
    protected $guarded = ['id_obat'];
    public $timestamps = true;

    /**
     * Get all reseps for this obat
     */
    public function resep(): HasMany
    {
        return $this->hasMany(Resep::class, 'id_obat', 'id_obat');
    }

    /**
     * Get all reseps for this obat (alias)
     */
    public function reseps(): HasMany
    {
        return $this->resep();
    }
}
