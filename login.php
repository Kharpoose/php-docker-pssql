<?php
session_start();

$host = '172.17.0.3';
$db   = 'postgres';
$user = 'postgres';
$pass = 'postgres';

$dsn = "pgsql:host=$host;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['mail'];
        $password = $_POST['password_id'];
        $email = $username;

        $stmt = $pdo->prepare("SELECT * FROM login WHERE mail = :mail");
        $stmt->execute([':mail' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['password_id'] === $password) {
            $_SESSION['user'] = $user['mail'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Kullanıcı adı veya şifre hatalı.";
        }
    }

} catch (PDOException $e) {
    echo "Veritabanı hatası: " . $e->getMessage();
}
?>

<h2>Login</h2>
<?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
<form method="post">
    Kullanıcı Adı: <input type="text" name="username" required><br><br>
    Şifre: <input type="password" name="password" required><br><br>
    <button type="submit">Giriş Yap</button>
</form>
