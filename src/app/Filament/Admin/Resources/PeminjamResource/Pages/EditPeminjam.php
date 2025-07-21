<?php

namespace App\Filament\Admin\Resources\PeminjamResource\Pages;

use App\Filament\Admin\Resources\PeminjamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Barang;

class EditPeminjam extends EditRecord
{
    protected static string $resource = PeminjamResource::class;

    protected function beforeDelete(): void
    {
    // Kembalikan status barang jika peminjaman dihapus
    $barang = Barang::find($this->record->barang_id);
    if ($barang) {
        $barang->status = 'tersedia';
        $barang->save();
        }
    }
}

