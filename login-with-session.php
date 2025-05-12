<?php
session_start(); // Oturum başlat
$host = 'training2025-db-instance-1.c25mkwu8gg8k.us-east-1.rds.amazonaws.com';     // PostgreSQL konteynerinin IP adresi
$db   = 'salesdb';        // Veritabanı adı
$user = 'karpuz';        // Kullanıcı adı
$pass = 'training2025-karpuz';        // Şifre
$charset = 'utf8';         // Karakter seti

// PDO bağlantı cümlesi
$dsn = "pgsql:host=$host;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $username;

        $stmt = $pdo->prepare("SELECT * FROM login WHERE mail = :mail");
        $stmt->execute([':mail' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['password_id'] === $password) {
            $_SESSION['user'] = $user['mail']; // Oturum aç
            header("Location: dashboard.php"); // Yönlendir
            exit();
        } else {
            $error = "Kullanıcı adı veya şifre yanlış.";
        }
        
    }
} catch (PDOException $e) {
    echo "Veritabanı hatasi: " . $e->getMessage();  
}
?>

<h2>Login</h2>
<?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
<form method="post">
    Kullanıcı Adı: <input type="text" name="username" required><br><br>
    Şifre: <input type="password" name="password" required><br><br>
    <button type="submit">Giriş Yap</button>
</form>
