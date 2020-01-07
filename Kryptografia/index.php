<?php
require_once 'php/visits.php';
$counter = getVisitsCounter();
session_start();

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>Zakamarki Kryptografii</title>
  <link rel="Shortcut icon" href="img/icon.png"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="Stylesheet" type="text/css" href="css/styles.css"/>
  <link rel="Stylesheet" type="text/css" href="css/desktop.css"/>
</head>
<body>
<nav>
  <div id="visit-counter">
    <p>Odwiedzono <span><?php echo $counter ?></span> <?php echo($counter == 1 ? "raz" : "razy") ?>
    </p>
  </div>
  <div id="user-menu">
    <?php if (isset($_SESSION['username'])) : ?>
      <p>Zalogowano jako <span><?php echo $_SESSION['username']; ?></span></p>
      <a class="user-menu-button" href="index.php?logout='1'">Wyloguj</a>
    <?php else: ?>
      <a class="user-menu-button" href="auth/login.php">Zaloguj</a>
      <a class="user-menu-button" href="auth/register.php">Zarejestruj</a>
    <?php endif ?>
  </div>
</nav>
<header class="all-center photo-background">
  <a class="all-center">
    <h1>Zakamarki Kryptografii</h1>
    <h2>Aleksandra Malinowska</h2>
  </a>
</header>
<main class="all-center">
  <div>
    <a href="articles/szyfrowanie.php" class="all-center">
      <p class="menu-header">Algorytm szyfrowania probabilistycznego</p>
    </a>
    <a href="articles/schemat-progowy.php" class="all-center">
      <p class="menu-header">Schemat progowy dzielenia sekretu Shamira</p>
    </a>
  </div>
</main>
<footer class="all-center">
  <p>2020 &copy; AM. Wszystkie prawa zastrzeżone. <a href="php/cookie-policy.php">Polityka cookies</a></p>
</footer>
<?php include("php/cookies.php"); ?>
</body>
</html>
