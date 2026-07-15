<?php

$ch = curl_init('http://127.0.0.1:8001/api/integration/invoices/update');

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'no_invoice' => 'TEST-001',
    'jumlah'     => 100000,
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error    = curl_error($ch);
curl_close($ch);

$output = "HTTP Status: {$httpCode}\n";
$output .= "Response: {$response}\n";
if ($error) {
    $output .= "cURL Error: {$error}\n";
}

file_put_contents('hasil-test.txt', $output);
echo "Selesai, cek file hasil-test.txt\n";