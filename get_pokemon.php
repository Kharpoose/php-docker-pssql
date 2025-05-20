<?php
header('Content-Type: application/json');

$host = 'training2025-db-instance-1.c25mkwu8gg8k.us-east-1.rds.amazonaws.com';
$port = '5432';
$dbname = 'salesdb';
$user = 'karpuz';
$password = 'training2025-karpuz';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Bağlantı hatası: ' . $e->getMessage()]);
    exit;
}

$name = $_GET['name'] ?? '';

if (empty($name)) {
    echo json_encode([]);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM pokemon WHERE name = :name");
$stmt->execute(['name' => $name]);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);
