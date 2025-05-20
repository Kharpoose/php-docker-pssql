function fetchPokemon() {
  const name = document.getElementById("nameInput").value;

  fetch(`get_pokemon.php?name=${encodeURIComponent(name)}`)
    .then(res => res.json())
    .then(data => {
      const resultDiv = document.getElementById("result");
      resultDiv.innerHTML = "";

      // data'nın array olup olmadığını kontrol et
      if (!Array.isArray(data)) {
        if (data.error) {
          resultDiv.textContent = data.error;
        } else {
          resultDiv.textContent = "Bilinmeyen bir hata oluştu.";
        }
        return;
      }

      if (data.length === 0) {
        resultDiv.textContent = "Pokemon bulunamadı.";
        return;
      }

      const p = data[0];

      // Burada p.name undefined olabilir, kontrol edelim
      if (!p.name) {
        resultDiv.textContent = "Geçersiz veri alındı.";
        return;
      }

      resultDiv.innerHTML = `
        <h2>${p.name} (${p.type})</h2>
        <p>HP: ${p.hp}</p>
        <p>${p.attack_1_name}: ${p.attack_1_damage} hasar (Enerji: ${p.attack_1_energy})</p>
        <p>${p.attack_2_name}: ${p.attack_2_damage} hasar (Enerji: ${p.attack_2_energy})</p>
      `;
    })
    .catch(err => {
      document.getElementById("result").textContent = "Hata oluştu: " + err;
    });
}
