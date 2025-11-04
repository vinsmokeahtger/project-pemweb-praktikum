<?php
session_start();

$usersFile = 'users.json';
if (!file_exists($usersFile)) {
  file_put_contents($usersFile, json_encode([]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST["username"]);
  $password = $_POST["password"];

  $users = json_decode(file_get_contents($usersFile), true);
  $found = false;

  foreach ($users as $user) {
    if ($user["username"] === $username && password_verify($password, $user["password"])) {
      $_SESSION["user"] = $username;
      $found = true;
      break;
    }
  }

  if ($found) {
    header("Location: index.php");
    exit;
  } else {
    $error = "Username atau password salah!";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Musik Kita Studio</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav class="navbar">
    <div class="logo">🎵 Musik Kita Studio</div>
    <ul class="nav-links">
      <li><a href="index.php">Beranda</a></li>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="login.php" class="active">Login</a></li>
      <li><a href="register.php">Register</a></li>
    </ul>
  </nav>

  <section class="form-section">
    <h2>Masuk ke Akun Anda</h2>

    <?php if (isset($error)): ?>
      <p style="color: red; text-align:center;"><?= $error ?></p>
    <?php endif; ?>

    <form action="" method="post" class="form-box">
      <label>Username</label>
      <input type="text" name="username" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <input type="submit" value="Login" class="btn">
    </form>

    <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
  </section>

  <footer>
    <p>© <?= date("Y") ?> Musik Kita Studio</p>
  </footer>
</body>
</html>
