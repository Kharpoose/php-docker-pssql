<?php
session_start();
session_unset();     // Tüm oturum verilerini temizle
session_destroy();   // Oturumu sonlandır
header("Location: login-with-session.php");
exit();
