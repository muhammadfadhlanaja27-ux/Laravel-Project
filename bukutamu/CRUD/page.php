<?php
$page = $_GET['page'];
switch ($page) {
    case "view-bukutamu":
      include "view-bukutamu.php";
      break;
    case "index":
        include "index.php";
      break;
    default:
      echo "Halaman tidak ditemukan";
  }
?>