<?php
session_start();

// Kullanıcı giriş yapmış mı kontrol et
if (!isset($_SESSION['user'])) {
    header("Location: login-with-session.php");
    exit();
}
?>

<h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2>
<a href="logout.php">Logout</a>
