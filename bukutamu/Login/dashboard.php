<?php
session_start();
echo "Selamat datang " . $_SESSION['username'] . "<br>";
echo "Anda login sebagai " . $_SESSION['hak_akses'] . "<br>";
echo '<a href="logout.php">Logout</a>';
?>