<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Interview Simulator Game</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
  body {
    margin: 0;
    background: url('bg-office.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: 'Press Start 2P', cursive; /* font retro game */
    overflow: hidden;
  }

  .game-overlay {
    width: 100vw;
    height: 100vh;
    background: rgba(0,0,0,0.6);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 20px;
  }

  .dialog-box {
    background: rgba(20,20,20,0.9);
    border: 3px solid #00ffcc;
    border-radius: 15px;
    padding: 20px;
    color: #fff;
    font-size: 18px;
    min-height: 120px;
    animation: fadeIn 0.5s ease;
    box-shadow: 0 0 15px #00ffcc;
  }

  .choice {
    background: #00ffcc;
    border: none;
    padding: 12px 25px;
    margin: 10px 5px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.2s;
    box-shadow: 0 0 8px #00ffcc;
  }
  .choice:hover {
    background: #00d4aa;
    transform: scale(1.05);
  }

  @keyframes fadeIn {
    from {opacity: 0;}
    to {opacity: 1;}
  }
</style>
</head>
<body>

<div class="game-overlay">
  <div class="dialog-box" id="dialog">
    🎤 Selamat datang di Interview Simulator! Siapkah kamu memulai perjalanan ini?
  </div>
  <div>
    <button class="choice" onclick="nextDialog('yes')">💪 Siap!</button>
    <button class="choice" onclick="nextDialog('nervous')">😅 Masih nervous...</button>
  </div>
</div>

<audio id="bgm" src="bgm.mp3" autoplay loop></audio>
<audio id="click" src="click.wav"></audio>

<script>
  const dialog = document.getElementById('dialog');
  const clickSound = document.getElementById('click');

  function typeWriter(text, i = 0) {
    if (i < text.length) {
      dialog.innerHTML = text.substring(0, i+1);
      setTimeout(() => typeWriter(text, i+1), 30);
    }
  }

  function nextDialog(option) {
    clickSound.play();
    if (option === 'yes') {
      typeWriter("Bagus! 🎯 Mari kita mulai interview gamified ini!");
    } else {
      typeWriter("Tenang saja! 😎 Anggap ini latihan seru. Ayo kita coba!");
    }
  }
</script>
</body>
</html>
