<?php
// Geçerli saati alıyoruz (0-23 arası saat)
date_default_timezone_set('Asia/Tokyo');
$saat = date("H"); // Örn: 14

echo "<p>Şu an saat: $saat:00</p>";

if ($saat >= 9 && $saat < 17) {
    echo "🟢 Mesai saatindesiniz.";
} elseif ($saat >= 17 && $saat < 22) {
    echo "🟡 Mesai dışı ama ofis açık.";
} else {
    echo "🔴 Ofis kapalı.";
}
?>
