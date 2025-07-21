<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Peminjam extends Model
{
    use HasFactory;
    protected $table = 'peminjams';
     protected $fillable = [
        'barang_id',
        'nama_peminjam',
        'tanggal_pinjam',
        'tanggal_kembali',
    ];

     // Relasi ke tabel barangs
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // Event model untuk mengubah status barang otomatis
    protected static function booted()
    {
        static::created(function ($peminjam) {
            if ($peminjam->barang) {
                $peminjam->barang->update(['status' => 'dipinjam']);
            }
        });

        static::deleted(function ($peminjam) {
            if ($peminjam->barang) {
                $peminjam->barang->update(['status' => 'tersedia']);
            }
        });
    }
}
