<?php

namespace App\Filament\Admin\Resources\PeminjamResource\Pages;

use App\Filament\Admin\Resources\PeminjamResource;
use Filament\Actions;
use App\Models\Barang;
use Filament\Resources\Pages\CreateRecord;

class CreatePeminjam extends CreateRecord
{
    protected static string $resource = PeminjamResource::class;

    protected function afterCreate(): void
    {
        // Update status barang jadi "dipinjam"
        $barang = Barang::find($this->record->barang_id);
        if ($barang) {
            $barang->status = 'dipinjam';
            $barang->save();
        }
    }
}
