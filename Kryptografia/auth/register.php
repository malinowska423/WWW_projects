<?php
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>Zakamarki Kryptografii | Zarejestruj się</title>
  <link rel="Shortcut icon" href="../img/icon.png"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="Stylesheet" type="text/css" href="../css/styles.css"/>
  <link rel="Stylesheet" type="text/css" href="../css/desktop.css"/>
  <link rel="Stylesheet" type="text/css" href="../css/auth.css"/>
</head>
<body>
<header class="all-center photo-background">
  <a class="all-center" href="../index.php">
    <h1>Zakamarki Kryptografii</h1>
    <h2>Aleksandra Malinowska</h2>
  </a>
</header>
<main class="all-center">
  <h1>Zarejestruj się</h1>
  <form method="post" action="register.php">
    <label>Nazwa użytkownika
      <input class="form-in" type="text" name="username" maxlength="50">
    </label>
    <label>E-mail
      <input class="form-in" type="email" name="email" maxlength="50">
    </label>
    <label>Hasło
      <input class="form-in" type="password" name="password" minlength="8" maxlength="50">
    </label>
    <?php include('errors.php'); ?>
    <input class="btn-submit" type="submit" value="Rozpocznij" name="register">
  </form>
  <p class="redirect">Masz już konto? <a href="login.php">Zaloguj się</a></p>
</main>
<footer class="all-center">
  <p>2020 &copy; AM. Wszystkie prawa zastrzeżone.</p>
</footer>
<script src="input-effect.js"></script>
</body>
</html>

