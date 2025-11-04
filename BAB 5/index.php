<?php
session_start();
$login = isset($_SESSION["user"]);
?>
<?php
  $page = "index";
  date_default_timezone_set("Asia/Jakarta");
  $jam = date("H");
  if ($jam < 12) $greet = "Selamat pagi! Semangat bermusik hari ini 🎶";
  elseif ($jam < 18) $greet = "Selamat siang! Yuk latihan bareng temanmu 🎸";
  else $greet = "Selamat malam! Saatnya bermusik santai 🎤";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Musik Kita Studio</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
 <nav class="navbar">
    <div class="logo">🎵 Musik Kita Studio</div>
    <ul class="nav-links">
      <li><a href="index.php" class="active">Beranda</a></li>
      <li><a href="dashboard.php">Dashboard</a></li>
      <?php if ($login): ?>
        <li><a href="logout.php">Logout (<?= $_SESSION['user'] ?>)</a></li>
      <?php else: ?>
        <li><a href="login.php">Login</a></li>
      <?php endif; ?>
      <li><a href="register.php">Register</a></li>
    </ul>
  </nav>

  <section class="landing bg-photo-index">
    <div class="overlay">
      <h1>Selamat Datang di Musik Kita Studio</h1>
      <p>Tempat terbaik untuk latihan musik dengan fasilitas profesional dan suasana nyaman.</p>
      <a href="dashboard.php" id="lihatStudio" class="btn">Lihat Studio</a>
      <div id="welcome-message"><?= $greet ?></div>
      <br>
      <button id="promoBtn" class="btn">Lihat Promo Spesial</button>
    </div>
  </section>

  <div id="promo-banner"><strong>🔥 Promo Spesial:</strong> Diskon 20% untuk penyewaan studio di hari Jumat!</div>
  <div id="toast"></div>

  <div id="promoModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>🎉 Promo Spesial!</h2>
      <p>Dapatkan diskon 20% untuk penyewaan studio setiap hari Jumat! Yuk, buruan booking sebelum kehabisan slot 🎶</p>
    </div>
  </div>

  <section class="info">
    <div class="card">
      <h3>Studio Modern</h3>
      <p>Dilengkapi peralatan musik terkini, ruang akustik terbaik, dan fasilitas rekaman.</p>
    </div>
    <div class="card">
      <h3>Harga Terjangkau</h3>
      <p>Latihan mulai dari Rp100.000 per jam, dengan berbagai paket menarik.</p>
    </div>
    <div class="card">
      <h3>Lokasi Strategis</h3>
      <p>Mudah diakses dari pusat kota, dengan area parkir luas dan nyaman.</p>
    </div>
  </section>

  <footer>
    <p>© <?= date("Y") ?> Musik Kita Studio | Semua Hak Dilindungi</p>
  </footer>

  <script>
    function showToast(message) {
      const toast = document.getElementById('toast');
      toast.textContent = message;
      toast.className = 'show';
      setTimeout(() => toast.className = toast.className.replace('show', ''), 3500);
    }
    window.onload = () => showToast('Selamat datang di Musik Kita Studio 🎵');

    const modal = document.getElementById("promoModal");
    const btn = document.getElementById("promoBtn");
    const span = document.getElementsByClassName("close")[0];
    btn.onclick = () => { modal.style.display = "block"; showToast("Promo terbuka! 🎉"); }
    span.onclick = () => modal.style.display = "none";
    window.onclick = (e) => { if (e.target == modal) modal.style.display = "none"; }

    const lihatStudio = document.getElementById('lihatStudio');
    lihatStudio.addEventListener('mouseover', () => {
      lihatStudio.style.backgroundColor = '#2563eb';
      lihatStudio.style.color = 'white';
    });
    lihatStudio.addEventListener('mouseout', () => {
      lihatStudio.style.backgroundColor = 'white';
      lihatStudio.style.color = '#1d4ed8';
    });
  </script>
</body>
</html>
