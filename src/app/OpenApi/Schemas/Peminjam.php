<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Peminjam",
 *     type="object",
 *     title="Peminjam",
 *     required={"id", "barang_id", "nama_peminjam", "tanggal_pinjam", "tanggal_kembali"},
 *     
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=1,
 *         description="ID peminjaman"
 *     ),
 *     
 *     @OA\Property(
 *         property="barang_id",
 *         type="integer",
 *         example=2,
 *         description="ID barang yang dipinjam"
 *     ),
 *     
 *     @OA\Property(
 *         property="nama_peminjam",
 *         type="string",
 *         example="Ahmad Fauzi",
 *         description="Nama dari peminjam"
 *     ),
 *     
 *     @OA\Property(
 *         property="tanggal_pinjam",
 *         type="string",
 *         format="date",
 *         example="2025-07-21",
 *         description="Tanggal peminjaman"
 *     ),
 *     
 *     @OA\Property(
 *         property="tanggal_kembali",
 *         type="string",
 *         format="date",
 *         example="2025-07-28",
 *         description="Tanggal pengembalian"
 *     ),
 *     
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-07-21T10:00:00Z",
 *         readOnly=true,
 *         description="Waktu pencatatan data"
 *     ),
 *     
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-07-21T11:00:00Z",
 *         readOnly=true,
 *         description="Waktu pembaruan data terakhir"
 *     )
 * )
 */
class Peminjam {}
