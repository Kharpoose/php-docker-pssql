<?php
session_start(); // Session'ı başlat

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sabit kullanıcı bilgileri
    $correctUsername = 'admin';
    $correctPassword = '1234';

    if ($username === $correctUsername && $password === $correctPassword) {
        $_SESSION['user'] = $username; // Kullanıcıyı oturuma kaydet
        header("Location: dashboard.php"); // Dashboard sayfasına yönlendir
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!-- HTML Form -->
<form method="post" action="login-with-session.php">
    <label>Username:</label>
    <input type="text" name="username"><br><br>

    <label>Password:</label>
    <input type="password" name="password"><br><br>

    <button type="submit">Login</button>
</form>

<?php if (isset($error)): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>
