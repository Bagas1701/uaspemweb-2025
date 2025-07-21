<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Peminjam;
use App\Models\Barang;


class PeminjamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil satu barang yang tersedia
        $barang = Barang::where('status', 'tersedia')->first();
        if ($barang) {
            Peminjam::create([
                'barang_id' => $barang->id,
                'nama_peminjam' => 'Andi Wijaya',
                'tanggal_pinjam' => date('Y-m-d'), // Hari ini
                'tanggal_kembali' => date('Y-m-d', strtotime('+7 days')), // 7 hari ke depan
            ]);

            // Tandai barang sudah dipinjam
            $barang->update(['status' => 'dipinjam']);
        }
    }
}
