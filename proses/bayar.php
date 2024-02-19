<?php 
  require('../config/db.php');
  $idUser = $_GET['idUser'];
  $total = $_GET['total'];
  $queryTrolly = mysqli_query($conn, "SELECT * FROM tabel_trolly WHERE idUser='$idUser'");
  $tanggal = date("Y-m-d H:i:s");

  $barang = "";
  while($data = mysqli_fetch_array($queryTrolly)){
    $queryBarang = mysqli_query($conn, "SELECT * FROM tabel_barang WHERE idBarang='$data[idBarang]'");
    $arrayBarang = mysqli_fetch_array($queryBarang);
    $kategori = $arrayBarang['kategori'];
    $namaBarang = $arrayBarang['namaBarang'];
    $jumlah = $data['jumlah'];
    $jumlahBarang = $arrayBarang['stock'] - $data['jumlah'];
    $updateJumlah = mysqli_query($conn, "UPDATE tabel_barang SET stock='$jumlahBarang' WHERE idBarang='$data[idBarang]'");
    $barang = $barang . $namaBarang.", Kategori : " .$kategori.", Jumlah : " . $jumlah. "<br>";
  }

  $queryInsert = mysqli_query($conn, "INSERT INTO tabel_transaksi (idUser, daftarBarang, tanggal, total) VALUES ('$idUser', '$barang', '$tanggal', '$total')");

  $query = mysqli_query($conn, "DELETE FROM tabel_trolly WHERE idUser='$idUser'");

  if($query){
    echo '
      <script>
      alert("Terima Kasih sudah Berbelanja.pembayaran Di Rekening ABC 034xxxxxxx dilakukan Tempo waktu 24 jam setelah Pemesana atau bayar di tempat. Semoga anda nyaman dengan layanan kami.!");
      window.location = "../datab.php";
      </script>
    ';
  }
?>