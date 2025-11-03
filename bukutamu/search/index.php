<!DOCTYPE html>
<html>
<head>
<title>Belajar PHP</title>
</head>

<body>
 <h1>Pencarian Barang - Share28s.COM</h1>
 
 <form method="GET" action="index.php" >
  <label>Kata Pencarian : </label>
  <input type="text" name="kata_cari" value="<?php if(isset($_GET['kata_cari'])) { echo $_GET['kata_cari']; } ?>"  />
  <button type="submit">Cari</button>
 </form>
 <br/>
 <table border="1">
  <thead>
   <tr>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Jumlah</th>
   </tr>
  </thead>

  <tbody>
   <?php
   //untuk menyambungkan dengan file koneksi.php
   include('koneksi.php');
    //jika kita klik cari, maka yang tampil query cari ini
    if(isset($_GET['kata_cari'])) {
     //menampung variabel kata_cari dari form pencarian
     $kata_cari = $_GET['kata_cari'];
     // mencari data dengan query
     $query = "SELECT * FROM barang WHERE kode_barang like '%".$kata_cari."%' OR nama_barang like '%".$kata_cari."%' OR jumlah like '%".$kata_cari."%' ORDER BY kode_barang ASC";
    } else {
     //jika tidak ada pencarian, default yang dijalankan query ini
     $query = "SELECT * FROM barang ORDER BY kode_barang ASC";
    }
    $result = mysqli_query($koneksi, $query);
    if(!$result) {
     die("Query Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
    }
    //kalau ini melakukan foreach atau perulangan
    while ($row = mysqli_fetch_assoc($result)) {
   ?>
   <tr>
    <td><?php echo $row['kode_barang']; ?></td>
    <td><?php echo $row['nama_barang']; ?></td>
    <td><?php echo $row['jumlah']; ?></td>
   </tr>
   <?php
   }
   ?>
  </tbody>
 </table>
</body>
</html>