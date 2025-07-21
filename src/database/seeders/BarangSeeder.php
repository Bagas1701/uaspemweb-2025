<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangList = [
            ['nama' => 'Laptop Asus', 'image' => ''],
            ['nama' => 'Proyektor Epson', 'image' => ''],
            ['nama' => 'Speaker JBL', 'image' => ''],
        ];

        foreach ($barangList as $data) {
            Barang::create([
                'nama' => $data['nama'],
                'image' => $data['image'],
                'status' => 'tersedia',
            ]);
        }
    }
}
