<?php
session_start();
$login = isset($_SESSION["user"]);


$usersFile = 'users.json';
if (!file_exists($usersFile)) {
  file_put_contents($usersFile, json_encode([])); // buat file kosong
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fullname = trim($_POST["fullname"]);
  $email = trim($_POST["email"]);
  $username = trim($_POST["username"]);
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  $users = json_decode(file_get_contents($usersFile), true);


  foreach ($users as $user) {
    if ($user["username"] === $username) {
      $error = "Username sudah terdaftar!";
      break;
    }
  }

  if (!isset($error)) {
    $users[] = [
      "fullname" => $fullname,
      "email" => $email,
      "username" => $username,
      "password" => $password
    ];

    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
    $_SESSION["user"] = $username;
    header("Location: dashboard.php");
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Musik Kita Studio</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
   <nav class="navbar">
    <div class="logo">🎵 Musik Kita Studio</div>
    <ul class="nav-links">
      <li><a href="index.php">Beranda</a></li>
      <li><a href="dashboard.php">Dashboard</a></li>
      <?php if ($login): ?>
        <li><a href="logout.php">Logout (<?= $_SESSION['user'] ?>)</a></li>
      <?php else: ?>
        <li><a href="login.php">Login</a></li>
      <?php endif; ?>
      <li><a href="register.php" class="active">Register</a></li>
    </ul>
  </nav>

  <section class="form-section">
    <h2>Buat Akun Baru</h2>

    <?php if (isset($error)): ?>
      <p style="color: red; text-align:center;"><?= $error ?></p>
    <?php endif; ?>

    <form action="" method="post" class="form-box">
      <label>Nama Lengkap</label>
      <input type="text" name="fullname" required>

      <label>Email</label>
      <input type="email" name="email" required>

      <label>Username</label>
      <input type="text" name="username" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <input type="submit" value="Daftar Sekarang" class="btn">
    </form>

    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
  </section>

  <footer>
    <p>© <?= date("Y") ?> Musik Kita Studio</p>
  </footer>
</body>
</html>
