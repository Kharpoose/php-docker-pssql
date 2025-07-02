<!-- Kullanıcıdan yaş alıyoruz -->
<form method="post">
    Yaşınızı girin: <input type="number" name="yas"  required>
    <button type="submit">Gönder</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $yas = $_POST["yas"]; // Formdan gelen yaş verisini al

    // Yaş değeri sayı mı ve mantıklı mı kontrol et
    if (!is_numeric($yas) ||$yas > 130) {
        echo "<p style='color:red;'>Lütfen geçerli bir yaş girin.</p>";
    } else {
        if ($yas <= 0) {
            echo "<p style='color:red;'> 🍑 portakalda vitaminsin.</p>";
        } elseif ($yas <= 12) {
            echo "<p>👶 Çocuk kategorisindesiniz.</p>";
        } elseif ($yas <= 17) {
            echo "<p>🧒 Genç kategorisindesiniz.</p>";
        } elseif ($yas < 65) {
            echo "<p>🧑 Yetişkin kategorisindesiniz.</p>";
        } else {
            echo "<p>👴 Yaşlı kategorisindesiniz.</p>";
        }
    }
}
?>
