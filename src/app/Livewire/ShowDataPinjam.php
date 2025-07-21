<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Peminjam;

class ShowDataPinjam extends Component
{

    public function render()
    {
        $pinjams = Peminjam::with('barang')->orderBy('created_at', 'desc')->get();

        return view('livewire.show-data-pinjam',[
            'pinjams' => $pinjams
        ]);
    }
}
