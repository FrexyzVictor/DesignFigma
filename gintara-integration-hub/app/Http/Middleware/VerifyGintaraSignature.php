<?php

namespace App\Http\Middleware;

use App\Models\ClientApp;
use Closure;
use Illuminate\Http\Request;

class VerifyGintaraSignature
{
    public function handle(Request $request, Closure $next)
    {
        $clientName = $request->header('X-Gintara-Client');
        $apiKey     = $request->header('X-Gintara-Api-Key');
        $timestamp  = $request->header('X-Gintara-Timestamp');
        $signature  = $request->header('X-Gintara-Signature');

        if (!$clientName || !$apiKey || !$timestamp || !$signature) {
            return response()->json(['message' => 'Header autentikasi tidak lengkap.'], 401);
        }

        // Validasi timestamp, tolak kalau selisih lebih dari 5 menit (anti replay attack)
        $requestTime = strtotime($timestamp);
        if (!$requestTime || abs(time() - $requestTime) > 300) {
            return response()->json(['message' => 'Timestamp tidak valid atau kadaluarsa.'], 401);
        }

        $client = ClientApp::where('app_name', $clientName)
            ->where('api_key', $apiKey)
            ->where('is_active', true)
            ->first();

        if (!$client) {
            return response()->json(['message' => 'API key tidak dikenali atau tidak aktif.'], 401);
        }

        // Hitung ulang signature: hmac_sha256(payload + timestamp + secret)
        $payload = $request->getContent();
        $expectedSignature = hash_hmac('sha256', $payload . $timestamp, $client->api_secret);

        if (!hash_equals($expectedSignature, $signature)) {
            return response()->json(['message' => 'Signature tidak valid.'], 401);
        }

        // Simpan info client biar bisa dipakai di controller kalau perlu
        $request->attributes->set('client_app', $client);

        return $next($request);
    }
}