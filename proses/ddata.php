<?php
if (isset($_SESSION['idUser']));
error_reporting(0);
$idUser = $_SESSION['idUser']; $_SESSION['idUser'];
$conn = mysqli_connect('localhost', 'root', '', 'kbs');
  $queryBarang = mysqli_query($conn, "SELECT * FROM tabel_transaksi WHERE idUser='$idUser'");
$jumlah = mysqli_num_rows($queryBarang);
if ($jumlah == 0) {
    echo '
        <tr>
        <td></td>
        <td style="width: 50vw">Belum Ada Transaksi</td>
        <td></td>
        </tr>
    ';
} else {
$conn = mysqli_connect('localhost', 'root', '', 'kbs');
    while ($arrayBarang = mysqli_fetch_array($queryBarang)) {
    $queryUser = mysqli_query($conn, "SELECT namaUser, alamat FROM tabel_user WHERE idUser='$idUser'");
    $arrayUser = mysqli_fetch_array($queryUser);
    echo '';
    }
}

// ubah status
if(isset($_POST['simpan']) && $_POST['simpan'] == 'simpan_status') {
    $idtransaksi = $_POST['idTransaksi'];

    $query = "UPDATE tabel_transaksi SET status = '$idtransaksi' WHERE idUser = '$idUser'";
    $arrayBarang = mysqli_query($conn,$query);

    if($arrayBarang) {
        $_SESSION['pesan_sukses'] = "Status Barang berhasil diubah";
        header('location:datab.php');
    } else {
        echo "Gagal Update status barang"; die;
    }
}
?>