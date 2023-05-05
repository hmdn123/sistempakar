<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aturan extends Model
{
    use HasFactory;

    protected $table = 'aturan';

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'kode_penyakit', 'kode');
    }

    public function indikator()
    {
        return $this->belongsTo(Indikator::class, 'kode_indikator', 'kode');
    }
}
