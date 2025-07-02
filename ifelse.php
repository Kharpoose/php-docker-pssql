<form method="post">
    Bir sayı girin: <input type="number" name="sayi">
    <button type="submit">Gönder</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sayi = $_POST["sayi"];

    if ($sayi < 0) {
        echo "Negatif sayı";
    } elseif ($sayi == 0) {
        echo "Sıfır";
    } elseif ($sayi > 0 && $sayi < 100) {
        echo "Pozitif ve küçük bir sayı";
    } else {
        echo "Büyük sayı";
    }
}
?>
