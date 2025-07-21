
 <div class="p-8">
    <br>
    <br>
    <br>
    <br>
    <h2 class="text-2xl font-bold mb-4">Barang yg tersedia/sudah dipinjam</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($barangs as $barang)
            <div class="border rounded-xl shadow p-4 bg-white">
                <h3 class="text-lg font-semibold">{{ $barang->nama }}</h3>
                <p class="text-sm text-gray-600">{{ $barang->status }}</p>
                @if($barang->image)
                    <img src="{{ asset('storage/' . $barang->image) }}" class="mx-auto mt-2 w-full h-32 object-contain rounded bg-white" />
                @else
                    <p class="text-xs text-gray-400">Gambar tidak tersedia</p>
                @endif
            </div>
        @endforeach
    </div>
</div>
