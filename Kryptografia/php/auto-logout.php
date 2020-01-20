<?php
$sessionTime = 5;
//$sessionTime = 60*5; // 5 min
if (isset($_SESSION['timestamp']) && time() - $_SESSION['timestamp'] > $sessionTime && isset($_SESSION['username'])) {
  session_unset();
  session_destroy();
} else {
  $_SESSION['timestamp'] = time();
}