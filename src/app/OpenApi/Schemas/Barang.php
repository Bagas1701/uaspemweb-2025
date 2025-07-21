<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Barang",
 *     type="object",
 *     title="Barang",
 *     required={"id", "nama", "image", "status"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nama", type="string", example="Laptop Asus"),
 *     @OA\Property(property="image", type="string", example="images/laptop-asus.jpg"),
 *     @OA\Property(property="status", type="string", enum={"tersedia", "dipinjam"}, example="tersedia"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-21T10:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-21T11:00:00Z")
 * )
 */
class Barang {}
