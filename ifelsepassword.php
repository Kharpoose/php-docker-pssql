<?php
session_start();
date_default_timezone_set('Asia/Tokyo'); // Japonya saat dilimi

// İlk adım: Kullanıcı formu doldurduysa...
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["email"])) {
    $email = $_POST["email"];

    // Normalde burada email sistemine kod gönderilirdi
    // Biz sadece session'a kaydedeceğiz
    $_SESSION['reset_email'] = $email;
    $_SESSION['reset_code'] = rand(100000, 999999);   // 6 haneli rastgele sayı
    $_SESSION['reset_time'] = time();                 // Kodun oluşturulma zamanı (timestamp)

    echo "Şifre sıfırlama kodunuz: <strong>" . $_SESSION['reset_code'] . "</strong><br>";
    echo "5 dakika içinde <a href=''>kodunuzu</a> girerek şifrenizi sıfırlayın.<br><br>";
}
?>

<!-- Email girme formu -->
<h3>Şifre Sıfırlama İsteği</h3>
<form method="post">
    Email adresiniz: <input type="email" name="email" required>
    <button type="submit">Kod Gönder</button>
</form>

<hr>

<!-- Kod girme ve kontrol etme -->
<?php
// Kod kontrolü bölümü
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["code"])) {
    $gelenKod = $_POST["code"];
    $orijinalKod = $_SESSION["reset_code"] ?? null;
    $tarih = $_SESSION["reset_time"] ?? 0;
    $simdi = time();

    if ($simdi - $tarih > 300) {
        echo "<p style='color:red'>⚠️ Kodun süresi doldu. Lütfen yeniden isteyin.</p>";
        session_unset(); // kodu sil
    } elseif ($gelenKod == $orijinalKod) {
        echo "<p style='color:green'>✅ Kod doğrulandı. Yeni şifrenizi oluşturabilirsiniz.</p>";
        $_SESSION['reset_confirmed'] = true;
    } else {
        echo "<p style='color:red'>❌ Kod yanlış. Lütfen tekrar deneyin.</p>";
    }
}
?>

<h3>Kod Gir</h3>
<form method="post">
    Size gelen 6 haneli kod: <input type="text" name="code" required>
    <button type="submit">Kod Doğrula</button>
</form>

<hr>

<!-- Yeni şifre formu -->
<?php
if ($_SESSION['reset_confirmed'] ?? false): ?>
    <h3>Yeni Şifre Oluştur</h3>
    <form method="post">
        Yeni şifre: <input type="password" name="sifre1" required><br>
        Tekrar şifre: <input type="password" name="sifre2" required><br>
        <button type="submit" name="yenisifre">Şifreyi Güncelle</button>
    </form>
<?php endif; ?>

<?php
// Yeni şifre kaydetme simülasyonu
if (isset($_POST["yenisifre"])) {
    $s1 = $_POST["sifre1"];
    $s2 = $_POST["sifre2"];

    if (strlen($s1) < 8) {
        echo "<p style='color:red'>⚠️ Şifre en az 8 karakter olmalı.</p>";
    } elseif ($s1 !== $s2) {
        echo "<p style='color:red'>❌ Şifreler uyuşmuyor.</p>";
    } else {
        echo "<p style='color:green'>✅ Şifreniz başarıyla güncellendi.</p>";
        // Veritabanına kaydetme işlemi burada yapılırdı.
        session_destroy(); // işlem bitti, oturumu kapat
    }
}
?>
<h1>Bu bir H1</h1>
<h2>Bu bir H2</h2>
<h3>Bu bir H3</h3>
<h4>Bu bir H4</h4>
<h5>Bu bir H5</h5>
<h6>Bu bir H6</h6>
