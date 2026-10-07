<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama_kategori' => 'Alat Musik Petik', 'deskripsi' => 'Alat musik yang dimainkan dengan cara dipetik'],
            ['nama_kategori' => 'Alat Musik Pukul', 'deskripsi' => 'Alat musik yang dimainkan dengan cara dipukul'],
            ['nama_kategori' => 'Alat Musik Tiup', 'deskripsi' => 'Alat musik yang dimainkan dengan cara ditiup'],
            ['nama_kategori' => 'Alat Musik Gesek', 'deskripsi' => 'Alat musik yang dimainkan dengan cara digesek'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
