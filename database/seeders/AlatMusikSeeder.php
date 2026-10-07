<?php

namespace Database\Seeders;

use App\Models\AlatMusik;
use Illuminate\Database\Seeder;

class AlatMusikSeeder extends Seeder
{
    public function run(): void
    {
        $alatMusiks = [
            [
                'nama_alat' => 'Angklung',
                'daerah_id' => 1, // Jawa Barat
                'kategori_id' => 2, // Pukul
                'deskripsi' => 'Angklung adalah alat musik multitonal (bernada ganda) yang secara tradisional berkembang dalam masyarakat Sunda di Pulau Jawa bagian barat.',
                'harga' => 150000,
                'stok' => 20,
            ],
            [
                'nama_alat' => 'Gamelan',
                'daerah_id' => 2, // Jawa Tengah
                'kategori_id' => 2, // Pukul
                'deskripsi' => 'Gamelan adalah ensembel musik yang biasanya menonjolkan metalofon, gambang, gendang, dan gong.',
                'harga' => 5000000,
                'stok' => 5,
            ],
            [
                'nama_alat' => 'Sasando',
                'daerah_id' => 3, // Jawa Timur
                'kategori_id' => 1, // Petik
                'deskripsi' => 'Sasando adalah alat musik petik dari Nusa Tenggara Timur yang berbentuk seperti harpa.',
                'harga' => 750000,
                'stok' => 10,
            ],
            [
                'nama_alat' => 'Suling Bambu',
                'daerah_id' => 1, // Jawa Barat
                'kategori_id' => 3, // Tiup
                'deskripsi' => 'Suling adalah alat musik tradisional Indonesia yang terbuat dari bambu.',
                'harga' => 50000,
                'stok' => 50,
            ],
            [
                'nama_alat' => 'Rebab',
                'daerah_id' => 2, // Jawa Tengah
                'kategori_id' => 4, // Gesek
                'deskripsi' => 'Rebab adalah alat musik gesek yang biasanya digunakan dalam gamelan Jawa.',
                'harga' => 450000,
                'stok' => 15,
            ],
            [
                'nama_alat' => 'Kolintang',
                'daerah_id' => 6, // Sulawesi Selatan
                'kategori_id' => 2, // Pukul
                'deskripsi' => 'Kolintang adalah alat musik pukul yang berasal dari Minahasa, Sulawesi Utara.',
                'harga' => 2500000,
                'stok' => 8,
            ],
        ];

        foreach ($alatMusiks as $alatMusik) {
            AlatMusik::create($alatMusik);
        }
    }
}