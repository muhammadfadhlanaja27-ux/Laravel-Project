<?php
include "koneksi.php";
$id_tamu = $_GET['id_tamu'];
$query = mysqli_query($con, "DELETE FROM tbl_tamu WHERE id_tamu='$id_tamu' ");
header("Location: view-bukutamu.php");
?>