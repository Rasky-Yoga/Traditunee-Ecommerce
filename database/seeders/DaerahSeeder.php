<?php

namespace Database\Seeders;

use App\Models\Daerah;
use Illuminate\Database\Seeder;

class DaerahSeeder extends Seeder
{
    public function run(): void
    {
        $daerahs = [
            ['nama_daerah' => 'Jawa Barat', 'deskripsi' => 'Alat musik tradisional dari Jawa Barat'],
            ['nama_daerah' => 'Jawa Tengah', 'deskripsi' => 'Alat musik tradisional dari Jawa Tengah'],
            ['nama_daerah' => 'Jawa Timur', 'deskripsi' => 'Alat musik tradisional dari Jawa Timur'],
            ['nama_daerah' => 'Bali', 'deskripsi' => 'Alat musik tradisional dari Bali'],
            ['nama_daerah' => 'Sumatera Barat', 'deskripsi' => 'Alat musik tradisional dari Sumatera Barat'],
            ['nama_daerah' => 'Sulawesi Selatan', 'deskripsi' => 'Alat musik tradisional dari Sulawesi Selatan'],
        ];

        foreach ($daerahs as $daerah) {
            Daerah::create($daerah);
        }
    }
}
