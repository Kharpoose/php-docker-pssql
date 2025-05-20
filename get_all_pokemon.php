<?php
header('Content-Type: application/json');

$host = 'training2025-db-instance-1.c25mkwu8gg8k.us-east-1.rds.amazonaws.com';  // Burayı kendi Docker network ya da host adresinle değiştir
$port = '5432';
$dbname = 'salesdb';  // Pokemon veritabanı adı
$user = 'karpuz';      // Kullanıcı adı
$password = 'training2025-karpuz';  // Şifre

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Bağlantı hatası: ' . $e->getMessage()]);
    exit;
}

// Tüm Pokémonları çek
$stmt = $pdo->query("SELECT * FROM pokemon");

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);
