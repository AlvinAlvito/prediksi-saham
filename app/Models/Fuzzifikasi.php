<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuzzifikasi extends Model
{
    use HasFactory;

    protected $table = 'tb_fuzzifikasi';

    protected $fillable = [
        'saham_id',
        'per_rendah','per_sedang','per_tinggi',
        'roe_buruk','roe_cukup','roe_baik',
        'volume_kecil','volume_sedang','volume_besar',
        'kapitalis_kecil','kapitalis_sedang','kapitalis_besar'
    ];

    public function saham()
    {
        return $this->belongsTo(Saham::class);
    }

    public function hasilFuzzy()
    {
        return $this->hasOne(HasilFuzzy::class, 'fuzzifikasi_id');
    }
}
