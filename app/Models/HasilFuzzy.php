<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilFuzzy extends Model
{
    use HasFactory;

    protected $table = 'hasil_fuzzy';

    protected $fillable = [
        'saham_id', 'fuzzifikasi_id',
        'nilai_z', 'persentase', 'kategori', 'interpretasi'
    ];

    public function saham()
    {
        return $this->belongsTo(Saham::class);
    }

    public function fuzzifikasi()
    {
        return $this->belongsTo(Fuzzifikasi::class);
    }
}
