<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Handle the submission of the contact form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submit(Request $request)
    {
        // 1. Validasi input dari form
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Jika validasi gagal, kembalikan response error
        if ($validator->fails()) {
            return response()->json(['message' => 'Harap isi semua kolom yang diperlukan dengan benar.', 'errors' => $validator->errors()], 422);
        }

        // 2. Kirim data ke API eksternal
        try {
            $apiBaseUrl = config('services.api.base_url');
            $response = Http::post("{$apiBaseUrl}/contact", $request->only(['name', 'email', 'subject', 'content']));

            // Periksa apakah request ke API berhasil
            if ($response->successful()) {
                return response()->json(['message' => 'Pesan Anda telah berhasil dikirim!'], 200);
            }
            
            // Jika API mengembalikan error
            return response()->json(['message' => 'Gagal mengirim pesan. Silakan coba lagi nanti.'], $response->status());

        } catch (\Exception $e) {
            // Tangani jika ada masalah koneksi ke API
            report($e); // Laporkan error untuk debugging
            return response()->json(['message' => 'Terjadi kesalahan pada server. Tidak dapat terhubung ke layanan pengiriman.'], 503);
        }
    }
}