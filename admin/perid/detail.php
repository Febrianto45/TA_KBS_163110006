<?php
require("../config/db.php");

if (isset($_GET['idTransaksi'])) {
    $idTransaksi = $_GET['idTransaksi'];
} else {
    header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="id" dir="ltr">
<head>
    <title>KBS</title>
</head>
<body>
    <h2>Selamat Datang di KBS</h2>
    <h3>Tabel Data KBS</h3>
    <?php

    $sql = "SELECT * FROM tabel_transaksi WHERE idTransaksi='$idTransaksi'";
    $queryBarang = mysqli_query($conn, $sql);

    $strTbl = "";
    $strTbl .= "<table width= '30%'>";
    if (mysqli_num_rows($queryBarang) > 0) {
        $data = mysqli_fetch_assoc($queryBarang);
        $strTbl .= "<tr>";
        $strTbl .= "<td>Tanggal/Time</td>";
        $strTbl .= "<td>:</td>";
        $strTbl .= "<td>". $data['tanggal'] ."</td>";
        $strTbl .= "</tr>";

        $strTbl .= "<tr>";
        $strTbl .= "<td>idTransaksi</td>";
        $strTbl .= "<td>:</td>";
        $strTbl .= "<td>". $data['idTransaksi'] ."</td>";
        $strTbl .= "</tr>";

        $strTbl .= "<tr>";
        $strTbl .= "<td>idUser</td>";
        $strTbl .= "<td>:</td>";
        $strTbl .= "<td>". $data['idUser'] ."</td>";
        $strTbl .= "</tr>";

        $strTbl .= "<tr>";
        $strTbl .= "<td>Daftar Barang</td>";
        $strTbl .= "<td>:</td>";
        $strTbl .= "<td>". $data['daftarBarang'] ."</td>";
        $strTbl .= "</tr>";

        $strTbl .= "<tr>";
        $strTbl .= "<td>Status</td>";
        $strTbl .= "<td>:</td>";
        $strTbl .= "<td>". $data['status'] ."</td>";
        $strTbl .= "</tr>";

        $strTbl .= "<tr>";
        $strTbl .= "<td>Total</td>";
        $strTbl .= "<td>:</td>";
        $strTbl .= "<td>". $data['total'] ."</td>";
        $strTbl .= "</tr>";
    } else {
        $strTbl .="<tr><td colspan='2'>Ooouppsss... Maaf, data masih kosong.</td></tr>";
    }
    $strTbl .= "</table>";
    $strTbl .= "<a href='index.php'>Kembali</a>";

    print($strTbl);
    ?>
    <p>Copyright @ KBS</p>
</body>
</html>
