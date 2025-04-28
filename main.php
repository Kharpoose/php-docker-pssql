<?php

$host = '172.17.0.3'; // PostgreSQL konteynerinin IP adresi
$db = 'postgres';  // Veritabanı adı
$user = 'postgres'; // PostgreSQL kullanıcı adı
$pass = 'postgres'; // PostgreSQL şifre
$charset = 'utf8';

$dsn = "pgsql:host=$host;dbname=$db";
try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Bağlantı başarılı!<br>";

    // Test sorgusu
    $stmt = $pdo->query("SELECT NOW()");
    $now = $stmt->fetchColumn();
    echo "PostgreSQL zamanı: $now";

    // Kullanıcıları çek
    $stmt = $pdo->query("SELECT * FROM post");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<br>";
    foreach ($users as $user) {
        echo "ID: {$user['id']} - Name: {$user['created_by']} - Comment: {$user['comment']}<br>";
    }
} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}
?>



<!-- Kullanıcıdan ilan başlığı ve açıklaması alıyoruz -->
<form method="post">
    Başlık: <input type="text" name="baslik"><br><br>
    Açıklama: <textarea name="aciklama" rows="4" cols="40"></textarea><br><br>
    <button type="submit">İlanı Gönder</button>
</form>

<?php
// Eğer form gönderildiyse
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Inputları boş mu diye kontrol ediyoruz
    if (empty($_POST["baslik"]) || empty($_POST["aciklama"])) {
        echo "Lütfen tüm alanları doldurun!";
    } else {
        // Gelen verileri XSS saldırılarına karşı temizliyoruz
        $baslik = htmlspecialchars($_POST["baslik"]);
        $aciklama = htmlspecialchars($_POST["aciklama"]);

        // Şu an sadece verileri ekrana yazdırıyoruz
        echo "<h2>Gönderdiğiniz İlan:</h2>";
        echo "<strong>Başlık:</strong> " . $baslik . "<br>";
        echo "<strong>Açıklama:</strong> " . nl2br($aciklama); // \n karakterini <br> yapar
    }
}
?>
