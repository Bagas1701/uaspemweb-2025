<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Helper\EncryptionHelper;
use OpenApi\Annotations as OA;

class BarangController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/barangs",
     *     operationId="getBarangs",
     *     tags={"Barangs"},
     *     summary="Get all barangs",
     *     description="Returns a list of all barangs.",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="string", example="eyJpdiI6Ik...")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $data = Barang::all();

        $responseData = [
            'message' => 'success',
            'data' => $data,
        ];

        $encryptResponse = EncryptionHelper::encrypt(json_encode($responseData));

        return response()->json(['data' => $encryptResponse]);
    }

    /**
     * @OA\Post(
     *     path="/api/barangs",
     *     operationId="storeBarang",
     *     tags={"Barangs"},
     *     summary="Create a new barang",
     *     description="Stores a new barang and returns encrypted response",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama", "image", "status"},
     *             @OA\Property(property="nama", type="string", example="Proyektor Epson"),
     *             @OA\Property(property="image", type="string", example="proyektor.jpg"),
     *             @OA\Property(property="status", type="string", enum={"tersedia", "dipinjam"}, example="tersedia")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Barang created",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="string", example="eyJpdiI6Ik...")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'image' => 'required|string',
            'status' => 'required|in:tersedia,dipinjam',
        ]);

        $barang = Barang::create($validated);

        $responseData = [
            'message' => 'Barang created successfully',
            'data' => $barang,
        ];

        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));

        return response()->json(['data' => $encryptedResponse]);
    }

    /**
     * @OA\Get(
     *     path="/api/barangs/{id}",
     *     operationId="getBarangById",
     *     tags={"Barangs"},
     *     summary="Get a barang by ID",
     *     description="Returns a single barang",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Barang ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(@OA\Property(property="data", type="string"))
     *     ),
     *     @OA\Response(response=404, description="Barang not found")
     * )
     */
    public function show($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $responseData = [
            'message' => 'success',
            'data' => $barang,
        ];

        $encrypted = EncryptionHelper::encrypt(json_encode($responseData));

        return response()->json(['data' => $encrypted]);
    }

    /**
     * @OA\Put(
     *     path="/api/barangs/{id}",
     *     operationId="updateBarang",
     *     tags={"Barangs"},
     *     summary="Update a barang",
     *     description="Updates an existing barang",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Barang ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="nama", type="string", example="Speaker JBL"),
     *             @OA\Property(property="image", type="string", example="speaker.jpg"),
     *             @OA\Property(property="status", type="string", enum={"tersedia", "dipinjam"}, example="dipinjam")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated successfully")
     * )
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $validated = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'image' => 'sometimes|string',
            'status' => 'sometimes|in:tersedia,dipinjam',
        ]);

        $barang->update($validated);

        $responseData = [
            'message' => 'Barang updated successfully',
            'data' => $barang,
        ];

        $encrypted = EncryptionHelper::encrypt(json_encode($responseData));

        return response()->json(['data' => $encrypted]);
    }

    /**
     * @OA\Delete(
     *     path="/api/barangs/{id}",
     *     operationId="deleteBarang",
     *     tags={"Barangs"},
     *     summary="Delete a barang",
     *     description="Deletes a barang by ID",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Barang ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(response=200, description="Barang deleted successfully")
     * )
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $barang->delete();

        $responseData = [
            'message' => 'Barang deleted successfully',
            'data' => ['id' => $id],
        ];

        $encrypted = EncryptionHelper::encrypt(json_encode($responseData));

        return response()->json(['data' => $encrypted]);
    }

    /**
     * @OA\Post(
     *     path="/api/barangs/decrypt",
     *     operationId="decryptBarangResponse",
     *     tags={"Barangs"},
     *     summary="Decrypt encrypted barang data",
     *     description="Decrypts the encrypted barang response.",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"data"},
     *             @OA\Property(property="data", type="string", example="eyJpdiI6IjFPU2h...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Decrypted response",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(response=400, description="Decrypt Failed")
     * )
     */
    public function decryptResponse(Request $request)
    {
        $encryptData = $request->input('data');

        try {
            $decryptedJson = EncryptionHelper::decrypt($encryptData);
            $decoded = json_decode($decryptedJson, true);

            return response()->json($decoded);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Decrypt Failed',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
