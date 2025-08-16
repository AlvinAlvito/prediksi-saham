<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Saham;

class SahamSeeder extends Seeder
{
    public function run(): void
    {
        $json = file_get_contents(database_path('data/saham.json'));
        $data = json_decode($json, true);

        foreach ($data as $row) {
            $saham = Saham::create([
                'kode_saham' => $row['Kode Saham'],
                'nama_saham' => $row['Nama Saham'],
                'per'        => (float) $row['PER'],
                'roe'        => (float) $row['ROE (%)'],
                'volume'     => (int) str_replace(',', '', $row['Volume (Avg) Lembar']),
                'market_cap' => (float) str_replace(',', '', $row['Market Cap (IDR Triliun)']),
            ]);

            // ⬇️ langsung jalankan fuzzifikasi setelah insert
            $saham->prosesFuzzy();

        }
    }
}
