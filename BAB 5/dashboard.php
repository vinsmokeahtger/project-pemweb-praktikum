<?php
session_start();
$login = isset($_SESSION["user"]);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Musik Kita Studio</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav class="navbar">
    <div class="logo">🎵 Musik Kita Studio</div>
    <ul class="nav-links">
      <li><a href="index.php">Beranda</a></li>
      <li><a href="dashboard.php" class="active">Dashboard</a></li>
      <?php if ($login): ?>
        <li><a href="logout.php">Logout (<?= $_SESSION['user'] ?>)</a></li>
      <?php else: ?>
        <li><a href="login.php">Login</a></li>
      <?php endif; ?>
      <li><a href="register.php">Register</a></li>
    </ul>
  </nav>

  <section class="landing bg-photo-dashboard">
    <div class="overlay">
      <h1>Daftar Studio Musik</h1>
      <p>Pilih studio terbaik untuk sesi latihan atau rekamanmu.</p>
    </div>
  </section>

  <section class="info grid">
    <?php
      $studios = [
        ["Studio A", "Ruang kedap suara dengan drum set dan ampli gitar.", 150000, "studio a.jpg"],
        ["Studio B", "Dilengkapi piano elektrik, mic condenser, dan mixer.", 120000, "studio b.jpg"],
        ["Studio C", "Untuk latihan band kecil dengan akustik menawan.", 100000, "studio c.jpeg"]
      ];

      foreach ($studios as $s) {
        echo "<div class='card'>
                <img src='{$s[3]}' alt='{$s[0]}'>
                <h3>{$s[0]}</h3>
                <p>{$s[1]}</p>
                <p><strong>Rp" . number_format($s[2], 0, ',', '.') . " / jam</strong></p>";
        if ($login) {
          echo "<button class='btn sewaBtn'>Sewa Sekarang</button>";
        } else {
          echo "<p style='color: gray;'>Login untuk menyewa studio</p>";
        }
        echo "</div>";
      }
    ?>
  </section>

  <div id="sewaModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Konfirmasi Penyewaan</h2>
      <p>Apakah kamu yakin ingin menyewa studio ini?</p>
      <button class="btn" id="confirmBtn">Ya, Sewa Sekarang</button>
    </div>
  </div>

  <footer>
    <p>© <?= date("Y") ?> Musik Kita Studio</p>
  </footer>

  <script>
    const modal = document.getElementById("sewaModal");
    const closeBtn = document.getElementsByClassName("close")[0];
    const confirmBtn = document.getElementById("confirmBtn");
    const sewaButtons = document.querySelectorAll(".sewaBtn");

    sewaButtons.forEach(btn => {
      btn.addEventListener("click", () => modal.style.display = "block");
    });
    closeBtn.onclick = () => modal.style.display = "none";
    window.onclick = e => { if (e.target == modal) modal.style.display = "none"; };
    confirmBtn.onclick = () => {
      alert("Studio berhasil dipesan! 🎶");
      modal.style.display = "none";
    };
  </script>
</body>
</html>
