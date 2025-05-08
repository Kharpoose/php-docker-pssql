<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login-with-session.php"); // Giriş yapılmadıysa login sayfasına dön
    exit();
}
?>

<h2>Hoş geldin, <?php echo $_SESSION['user']; ?>!</h2>
<p>Burada kullanıcıya özel içerik gösterebilirsin.</p>

<a href="logout.php">Çıkış Yap</a>
