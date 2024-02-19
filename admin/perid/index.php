<?php
  require("../config/db.php");
?>
<!DOCTYPE html>
<html lang="id" dir="ltr">
  <head>
  <title>KBS</title>
  </head>
  <body>
<center>
    <h2>Selamat Datang di KBS</h2>
    <h3>Tabel Data KBS</h3>
    <?php
      $sql = "SELECT * FROM tabel_transaksi ORDER BY idTransaksi DESC";
      $queryBarang = mysqli_query($conn, $sql);
      if($arrayBarang['status'] == 0) {
        $status = '<span class="badge badge-info">BARU</span>';
    } else if ($arrayBarang['status'] == 1) {
        $status = '<span class="badge badge-success">BARANG DI KIRIM</span>';
    } else if ($arrayBarang['status'] == 2) {
        $status = '<span class="badge badge-danger">BARANG AMBIL DI TEMPAT</span>';
    }
      $strTbl = "";
      $strTbl .= "<table border='1'>";
      $strTbl .= "<tr>";
      $strTbl .= "<th>No</th>";
      $strTbl .= "<th>Tanggal/Time</th>";
      $strTbl .= "<th>idTransaksi</th>";
      $strTbl .= "<th>idUser</th>";
      $strTbl .= "<th>Daftar Barang</th>";
      $strTbl .= "<th>Status</th>";
      $strTbl .= "<th>Total</th>";
      $strTbl .= "<th>Aksi</th>";
      $strTbl .= "</tr>";

      $nomor = 1;

      if (mysqli_num_rows($queryBarang) > 0) {
        while ($data = mysqli_fetch_assoc($queryBarang)) {

          $strTbl .= "<tr>";
          $strTbl .= "<td>". $nomor."</td>";
          $strTbl .= "<td>". $data['tanggal']."</td>";
          $strTbl .= "<td>". $data['idTransaksi'] ."</td>";
          $strTbl .= "<td>". $data['idUser'] ."</td>";
          $strTbl .= "<td>". $data['daftarBarang'] ."</td>";
          $strTbl .= "<td>". $status ."</td>";
          $strTbl .= "<td>". $data['total'] ."</td>";
          $strTbl .= "<td><a href='detail.php?idTransaksi=".$data['idTransaksi']."'>Lihat</a></td>";
          $strTbl .= "</tr>";
          $nomor++;
        }
      } else {
        $strTbl .="<tr><td colspan='4'>Ooouppsss... Maaf, data masih kosong.</td></tr>";
      }
      $strTbl .= "</table>";
      print($strTbl);
?>

<p>Copyright @ KBS</p>
</center>
  </body>
</html>
