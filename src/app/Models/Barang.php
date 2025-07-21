<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';
     protected $fillable = [
        'nama',
        'image',
        'status',
    ];

     // Relasi: 1 barang bisa dipinjam banyak kali
    public function peminjams()
    {
        return $this->hasMany(Peminjam::class);
    }
}
