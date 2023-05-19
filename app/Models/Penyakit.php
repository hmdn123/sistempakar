<?php

namespace App\Models;

use App\Models\Indikator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;

    protected $table = 'penyakit';

    public function indikator()
    {
        return $this->belongsToMany(Indikator::class, 'aturan', 'kode_penyakit', 'kode_indikator');
    }
}
