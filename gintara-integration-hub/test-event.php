<?php

// --- ISI SESUAI DATA KAMU ---
$clientName = 'management';
$apiKey     = 'key-management-XnpVU7rM';
$apiSecret  = 'C0Bl1YaJuzx986Io7GNf5CxMknYwmfU5';

$payload = json_encode([
    'event_id'         => 'EVT-' . date('Ymd') . '-' . rand(100000, 999999),
    'event_type'       => 'customer.created',
    'source_app'       => 'management',
    'entity_type'      => 'customer',
    'source_record_id' => '2',
    'timestamp'        => date('Y-m-d H:i:s'),
    'data' => [
        'nama'           => 'Siti Aminah',
        'telepon'        => '08987654321',
        'alamat'         => 'Kuningan',
        'paket'          => '20 Mbps',
        'harga'          => 200000,
        'pppoe_username' => 'gnt-002',
        'status'         => 'aktif',
    ],
]);

$timestamp = date('c');
$signature = hash_hmac('sha256', $payload . $timestamp, $apiSecret);

// --- Kirim request langsung dari PHP, gak perlu copy-paste curl ---
$ch = curl_init('http://127.0.0.1:8000/api/v1/events');

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    "X-Gintara-Client: {$clientName}",
    "X-Gintara-Api-Key: {$apiKey}",
    "X-Gintara-Timestamp: {$timestamp}",
    "X-Gintara-Signature: {$signature}",
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Status: {$httpCode}\n";
echo "Response: {$response}\n";