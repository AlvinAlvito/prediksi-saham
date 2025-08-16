<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saham extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_saham',
        'nama_saham',
        'per',
        'roe',
        'volume',
        'market_cap'
    ];

    public function fuzzifikasi()
    {
        return $this->hasOne(Fuzzifikasi::class);
    }

    public function hasilFuzzy()
    {
        return $this->hasMany(HasilFuzzy::class);
    }

    public function prosesFuzzy()
    {
        $fuzzy = new Fuzzifikasi();
        $fuzzy->saham_id = $this->id;

        // ================================
        // KONFIGURASI BATAS (dari Bab IV)
        // ================================
        $batas = [
            'per' => [
                'rendah' => [0, 5, 10],        // [min, peak, max]
                'sedang' => [10, 15, 20],
                'tinggi' => [20, 26.4, 30],
            ],
            'roe' => [
                'buruk' => [-20.1, 5, 10],
                'cukup' => [10, 15, 20],
                'baik' => [20, 25, 70],
            ],
            'volume' => [
                'kecil' => [0, 3_000_000, 5_000_000],
                'sedang' => [5_000_000, 25_000_000, 50_000_000],
                'besar' => [50_000_000, 60_000_000, 100_000_000],
            ],
            'kapitalisasi' => [
                'kecil' => [0, 50, 100],
                'sedang' => [100, 300, 500],
                'besar' => [500, 600, 1080],
            ],
        ];

        // ================================
        // 1. FUZZIFIKASI PER
        // ================================
        $x = $this->per;
        [$a, $b, $c] = $batas['per']['rendah'];
        $fuzzy->per_rendah = ($x <= $a) ? 1 : (($x >= $c) ? 0 : (($c - $x) / ($c - $a)));

        [$a, $b, $c] = $batas['per']['sedang'];
        $fuzzy->per_sedang = ($x <= $a || $x >= $c) ? 0 :
            (($x == $b) ? 1 :
                (($x > $a && $x < $b) ? ($x - $a) / ($b - $a) : ($c - $x) / ($c - $b)));

        [$a, $b, $c] = $batas['per']['tinggi'];
        $fuzzy->per_tinggi = ($x <= $a) ? 0 : (($x >= $c) ? 1 : (($x - $a) / ($b - $a)));

        // ================================
        // 2. FUZZIFIKASI ROE
        // ================================
        $x = $this->roe;
        [$a, $b, $c] = $batas['roe']['buruk'];
        $fuzzy->roe_buruk = ($x <= $a) ? 1 : (($x >= $c) ? 0 : (($c - $x) / ($c - $a)));

        [$a, $b, $c] = $batas['roe']['cukup'];
        $fuzzy->roe_cukup = ($x <= $a || $x >= $c) ? 0 :
            (($x == $b) ? 1 :
                (($x > $a && $x < $b) ? ($x - $a) / ($b - $a) : ($c - $x) / ($c - $b)));

        [$a, $b, $c] = $batas['roe']['baik'];
        $fuzzy->roe_baik = ($x <= $a) ? 0 : (($x >= $c) ? 1 : (($x - $a) / ($b - $a)));

        // ================================
        // 3. FUZZIFIKASI VOLUME
        // ================================
        $x = $this->volume;
        [$a, $b, $c] = $batas['volume']['kecil'];
        $fuzzy->volume_kecil = ($x <= $a) ? 1 : (($x >= $c) ? 0 : (($c - $x) / ($c - $a)));

        [$a, $b, $c] = $batas['volume']['sedang'];
        $fuzzy->volume_sedang = ($x <= $a || $x >= $c) ? 0 :
            (($x == $b) ? 1 :
                (($x > $a && $x < $b) ? ($x - $a) / ($b - $a) : ($c - $x) / ($c - $b)));

        [$a, $b, $c] = $batas['volume']['besar'];
        $fuzzy->volume_besar = ($x <= $a) ? 0 : (($x >= $c) ? 1 : (($x - $a) / ($b - $a)));

        // ================================
        // 4. FUZZIFIKASI MARKET CAP
        // ================================
        $x = $this->market_cap;
        [$a, $b, $c] = $batas['kapitalisasi']['kecil'];
        $fuzzy->kapitalis_kecil = ($x <= $a) ? 1 : (($x >= $c) ? 0 : (($c - $x) / ($c - $a)));

        [$a, $b, $c] = $batas['kapitalisasi']['sedang'];
        $fuzzy->kapitalis_sedang = ($x <= $a || $x >= $c) ? 0 :
            (($x == $b) ? 1 :
                (($x > $a && $x < $b) ? ($x - $a) / ($b - $a) : ($c - $x) / ($c - $b)));

        [$a, $b, $c] = $batas['kapitalisasi']['besar'];
        $fuzzy->kapitalis_besar = ($x <= $a) ? 0 : (($x >= $c) ? 1 : (($x - $a) / ($b - $a)));

        // simpan hasil fuzzifikasi
        $fuzzy->save();

        // ================
        // 2. Rules (Hardcode dari Bab IV)
        // ================
        $rules = [
            // 1
            ['nilai' => min($fuzzy->per_rendah, $fuzzy->roe_buruk, $fuzzy->volume_kecil, $fuzzy->kapitalis_kecil), 'z' => 20],  // Tidak Layak

            // 2
            ['nilai' => min($fuzzy->per_sedang, $fuzzy->roe_buruk, $fuzzy->volume_sedang, $fuzzy->kapitalis_kecil), 'z' => 20],  // Tidak Layak

            // 3
            ['nilai' => min($fuzzy->per_tinggi, $fuzzy->roe_buruk, $fuzzy->volume_besar, $fuzzy->kapitalis_sedang), 'z' => 20],  // Tidak Layak

            // 4
            ['nilai' => min($fuzzy->per_rendah, $fuzzy->roe_cukup, $fuzzy->volume_sedang, $fuzzy->kapitalis_sedang), 'z' => 55], // Layak

            // 5
            ['nilai' => min($fuzzy->per_rendah, $fuzzy->roe_baik, $fuzzy->volume_besar, $fuzzy->kapitalis_besar), 'z' => 55], // Layak

            // 6
            ['nilai' => min($fuzzy->per_sedang, $fuzzy->roe_cukup, $fuzzy->volume_sedang, $fuzzy->kapitalis_sedang), 'z' => 55], // Layak

            // 7
            ['nilai' => min($fuzzy->per_sedang, $fuzzy->roe_baik, $fuzzy->volume_besar, $fuzzy->kapitalis_sedang), 'z' => 85], // Sangat Layak

            // 8
            ['nilai' => min($fuzzy->per_sedang, $fuzzy->roe_baik, $fuzzy->volume_sedang, $fuzzy->kapitalis_besar), 'z' => 85], // Sangat Layak

            // 9
            ['nilai' => min($fuzzy->per_tinggi, $fuzzy->roe_baik, $fuzzy->volume_besar, $fuzzy->kapitalis_besar), 'z' => 85], // Sangat Layak

            // 10
            ['nilai' => min($fuzzy->per_tinggi, $fuzzy->roe_cukup, $fuzzy->volume_sedang, $fuzzy->kapitalis_besar), 'z' => 85], // Sangat Layak

            // 11
            ['nilai' => min($fuzzy->per_tinggi, $fuzzy->roe_buruk, $fuzzy->volume_kecil, $fuzzy->kapitalis_kecil), 'z' => 20], // Tidak Layak

            // 12
            ['nilai' => min($fuzzy->per_rendah, $fuzzy->roe_baik, $fuzzy->volume_kecil, $fuzzy->kapitalis_sedang), 'z' => 55], // Layak

            // 13
            ['nilai' => min($fuzzy->per_sedang, $fuzzy->roe_cukup, $fuzzy->volume_kecil, $fuzzy->kapitalis_sedang), 'z' => 55], // Layak

            // 14
            ['nilai' => min($fuzzy->per_tinggi, $fuzzy->roe_baik, $fuzzy->volume_kecil, $fuzzy->kapitalis_besar), 'z' => 55], // Layak

            // 15
            ['nilai' => min($fuzzy->per_rendah, $fuzzy->roe_cukup, $fuzzy->volume_besar, $fuzzy->kapitalis_sedang), 'z' => 55], // Layak

            // 16
            ['nilai' => min($fuzzy->per_sedang, $fuzzy->roe_baik, $fuzzy->volume_besar, $fuzzy->kapitalis_besar), 'z' => 85], // Sangat Layak
        ];
        // ================
// 3. Defuzzifikasi (Weighted Average)
// ================
        $totalAtas = 0;
        $totalBawah = 0;

        foreach ($rules as $rule) {
            if ($rule['nilai'] > 0) {
                // α × Z
                $totalAtas += $rule['nilai'] * $rule['z'];
                // α
                $totalBawah += $rule['nilai'];
            }
        }

        // Weighted Average (Centroid)
        $z_final = $totalBawah > 0 ? $totalAtas / $totalBawah : 0;

        // Konversi ke persentase 0–100
        $persentase = $z_final;

        // Tentukan kategori
        if ($persentase < 40) {
            $kategori = "Tidak Layak";
        } elseif ($persentase < 70) {
            $kategori = "Layak";
        } else {
            $kategori = "Sangat Layak";
        }

        // ================
        // 4. Simpan ke hasil_fuzzy
        // ================
        $hasil = new HasilFuzzy();
        $hasil->saham_id = $this->id;
        $hasil->fuzzifikasi_id = $fuzzy->id;
        $hasil->nilai_z = $z_final;
        $hasil->persentase = $persentase;
        $hasil->kategori = $kategori;
        $hasil->interpretasi = "Saham {$this->kode_saham} termasuk kategori $kategori dengan skor " . number_format($persentase, 3) . "%";
        $hasil->save();

        return $hasil;

    }
}
