//グルーバル変数でポケモンのデータを格納
let pokemonData = null;

function fetchPokemon(name) {
  //const name = document.getElementById("nameInput").value;

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

      pokemonData = p;

      resultDiv.innerHTML = `
        <h2>${p.name} (${p.type})</h2>
        <p>HP: ${p.hp}</p>
        <p>${p.attack_1_name}: ${p.attack_1_damage} hasar (Enerji: ${p.attack_1_energy})</p>
        <p>${p.attack_2_name}: ${p.attack_2_damage} hasar (Enerji: ${p.attack_2_energy})</p>
      `;
      
      // document.getElementById("pokename").textContent = `${p.name} (${p.type})`;
      // document.getElementById("pokehp").textContent = `HP: ${p.hp}`;
      // document.getElementById("attack_1_name").textContent = `${p.attack_1_name}`;
      // document.getElementById("attack_1_damage").textContent = `${p.attack_1_damage}`;
      // document.getElementById("attack_1_energy").textContent = `${p.attack_1_energy}`;
      // document.getElementById("attack_2_name").textContent = `${p.attack_2_name}`;
      // document.getElementById("attack_2_damage").textContent = `${p.attack_2_damage}`;
      // document.getElementById("attack_2_energy").textContent = `${p.attack_2_energy}`;
    })



    .catch(err => {
      document.getElementById("result").textContent = "Hata oluştu: " + err;
    });
}

