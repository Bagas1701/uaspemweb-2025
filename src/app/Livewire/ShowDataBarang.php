<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barang;

class ShowDataBarang extends Component
{
    public function render()
    {
        $barangs = Barang::orderBy('created_at', 'desc')->get();
        return view('livewire.show-data-barang',[
            'barangs' => $barangs
        ]);
    }
}
