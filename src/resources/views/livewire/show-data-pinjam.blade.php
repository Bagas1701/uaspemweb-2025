<div class="p-4">
    <br>
    <br>
    <br>
    <br>
    <h1 class="text-2xl font-bold mb-4">Data Pendaftaran Murid Ekskul </h1>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2">Barang</th>
                    <th class="border px-4 py-2">Nama Peminjam</th>
                    <th class="border px-4 py-2">Tanggal Pinjam</th>
                    <th class="border px-4 py-2">Tanggal Kembali</th>
                </tr>
            </thead>
            <tbody>
                @if ($pinjams->isEmpty())
                    <tr>
                        <td colspan="8" class="border px-4 py-2 text-center">Tidak ada data pinjam.</td>
                    </tr>
                     @else
                    @foreach ($pinjams as $data)
                        <tr>
                            <td class="border px-4 py-2">{{ $data->barang_id}}</td>
                            <td class="border px-4 py-2">{{ $data->nama_peminjam}}</td>
                            <td class="border px-4 py-2">{{ $data->tanggal_pinjam}}</td>
                            <td class="border px-4 py-2">{{ $data->tanggal_kembali}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>            
        </table>
    </div>
</div>