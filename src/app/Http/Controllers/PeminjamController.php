<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Server(
 *   url=L5_SWAGGER_CONST_HOST,
 *   description="API Server"
 * )
 * @OA\Tag(
 *   name="Peminjams",
 *   description="API untuk manajemen data peminjam"
 * )
 */
class PeminjamController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/peminjams",
     *   tags={"Peminjams"},
     *   summary="List semua peminjaman",
     *   security={{"ApiKeyAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="Berhasil mengambil data",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Peminjam"))
     *   )
     * )
     */
    public function index()
    {
        return Peminjam::all();
    }

    /**
     * @OA\Post(
     *   path="/api/peminjams",
     *   tags={"Peminjams"},
     *   summary="Tambah peminjaman baru",
     *   security={{"ApiKeyAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"barang_id", "nama_peminjam", "tanggal_pinjam", "tanggal_kembali"},
     *       @OA\Property(property="barang_id", type="integer"),
     *       @OA\Property(property="nama_peminjam", type="string"),
     *       @OA\Property(property="tanggal_pinjam", type="string", format="date"),
     *       @OA\Property(property="tanggal_kembali", type="string", format="date")
     *     )
     *   ),
     *   @OA\Response(response=201, description="Berhasil disimpan")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'nama_peminjam' => 'required|string',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $peminjam = Peminjam::create($data);
        return response()->json($peminjam, 201);
    }

    /**
     * @OA\Get(
     *   path="/api/peminjams/{id}",
     *   tags={"Peminjams"},
     *   summary="Ambil data peminjaman berdasarkan ID",
     *   security={{"ApiKeyAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200, description="Data ditemukan", @OA\JsonContent(ref="#/components/schemas/Peminjam")),
     *   @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show($id)
    {
        $peminjam = Peminjam::find($id);
        if (!$peminjam) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return $peminjam;
    }

    /**
     * @OA\Delete(
     *   path="/api/peminjams/{id}",
     *   tags={"Peminjams"},
     *   summary="Hapus data peminjam",
     *   security={{"ApiKeyAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=204, description="Berhasil dihapus"),
     *   @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function destroy($id)
    {
        $peminjam = Peminjam::find($id);
        if (!$peminjam) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $peminjam->delete();
        return response()->noContent();
    }
}
