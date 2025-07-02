<?php
session_start();

// Oturum kontrolü
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

echo "<h2>Hoş geldin, " . $_SESSION['user'] . "</h2>";
echo "<p>Aşağıda örnek ilanlar listeleniyor:</p>";

// Veritabanı bağlantısı
$host = '172.17.0.3';
$db   = 'postgres';
$user = 'postgres';
$pass = 'postgres';

$dsn = "pgsql:host=$host;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Soft delete olmayan ilanları getir
    $stmt = $pdo->query("SELECT * FROM post WHERE deleted_at IS NULL ORDER BY id DESC");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($posts as $post) {
        echo "<hr>";
        echo "<strong>Başlık:</strong> " . htmlspecialchars($post['created_by']) . "<br>";
        echo "<strong>Açıklama:</strong> " . nl2br(htmlspecialchars($post['comment'])) . "<br>";
    }

} catch (PDOException $e) {
    echo "Veritabanı hatası: " . $e->getMessage();
}
?>

<br><br>
<a href="logout.php">Çıkış Yap</a>
