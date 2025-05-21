let playerCurrentHp = 0;
let opponentCurrentHp = 0;

function attack(num) {
    const atkDamage = parseInt(playerPokemon[`attack_${num}_damage`]);
    const atkEnergy = parseInt(playerPokemon[`attack_${num}_energy`]);

    if (energy < atkEnergy) {
        alert("エネルギーが足りません！");
        return;
    }

    opponentCurrentHp -= atkDamage;
    energy -= atkEnergy;
    updateEnergyDisplay();

    if (opponentCurrentHp < 0) opponentCurrentHp = 0;
    document.getElementById('opponentHp').textContent = `HP: ${opponentCurrentHp}`;

    if (opponentCurrentHp <= 0) {
        document.getElementById('result').textContent = "勝利！";
        disableButtons();
    } else {
        botTurn();
    }
}

function wait() {
    energy += 1;
    updateEnergyDisplay();
    botTurn();
}

function botTurn() {
    const num = Math.random() < 0.5 ? 1 : 2;
    const atkDamage = parseInt(opponentPokemon[`attack_${num}_damage`]);

    playerCurrentHp -= atkDamage;
    if (playerCurrentHp < 0) playerCurrentHp = 0;
    document.getElementById('playerHp').textContent = `HP: ${playerCurrentHp}`;

    if (playerCurrentHp <= 0) {
        document.getElementById('result').textContent = "敗北...";
        disableButtons();
    }
}

function disableButtons() {
    document.querySelectorAll('button').forEach(btn => btn.disabled = true);
}
