<?php
include "koneksi.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kategori = mysqli_real_escape_string($con, $_POST['kategori']);
    
    // INSERT tanpa id_kategori karena AUTO_INCREMENT
    $query = "INSERT INTO tbl_kategori (kategori, tanggal_input) VALUES ('$kategori', NOW())";
    
    if(mysqli_query($con, $query)) {
        header("Location: kategori.php");
        exit();
    } else {
        echo "<h3>Error Database:</h3>";
        echo mysqli_error($con);
        echo "<br><br><a href='kategori.php'>Kembali</a>";
    }
} else {
    header("Location: kategori.php");
    exit();
}
?>