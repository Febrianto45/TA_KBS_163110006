<!DOCTYPE html>
<html>
<?php
    session_start();
    if (!isset($_SESSION['idAdmin'])) {
        header('location: index.php');
    }
    ?>
    <?php
    require("../config/db.php");
    ?>
<head>
    <title>KBS TRANSAKSI</title>
</head>
<body>
    <center>
        <h2>DATA LAPORAN TRANSAKSI</h2>
        <h4>KBS</h4>
    </center>
    
    <center>
        <div id="transaksi" class="tab-pane fade">
            <div class="row">
                <div class="col-xs-11 col-offset-xs-1">
                    <h3 class="table-title"><strong>Tabel Transaksi</strong></h3>
                    <table class="table table-hover">
                        <table border="1" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="10%" class="id-transaksi text-center">ID Transaksi</th>
                                    <th class="nama-user text-center">Nama Pembeli</th>
                                    <th class="text-center" style="width:30vw">Daftar Barang</th>
                                    <th class="status">Status</th>
                                    <th class="id-transaksi">Total</th>
                                    <th class="alamat-user">Alamat User</th>
                                    <th class="id-transaksi">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_SESSION['idUser']));
                                $idUser = $_SESSION['idUser'] = $_SESSION['idUser'];
                                $conn = mysqli_connect('localhost', 'root', '', 'kbs');
                                $queryBarang = mysqli_query($conn, "SELECT * FROM tabel_transaksi WHERE idUser='$idUser'");
                                $jumlah = mysqli_num_rows($queryBarang);
                                if ($jumlah == 0) {
                                    echo '';
                                } else {
                                    while ($arrayBarang = mysqli_fetch_array($queryBarang)) {
                                        $queryUser = mysqli_query($conn, "SELECT namaUser, alamat FROM tabel_user WHERE idUser='$idUser'");
                                        $arrayUser = mysqli_fetch_array($queryUser);
                                        if($arrayBarang['status'] == 0) {
                                            $status = '<span class="badge badge-info">BARU</span>';
                                        } else if ($arrayBarang['status'] == 1) {
                                            $status = '<span class="badge badge-success">BARANG DI KIRIM</span>';
                                        } else if ($arrayBarang['status'] == 2) {
                                            $status = '<span class="badge badge-danger">BARANG AMBIL DI TEMPAT</span>';
                                        }
                                        echo '
                            <tr>
                            <td class="id-transaksi text-center">' . $arrayBarang['idTransaksi'] . '</td>
                            <td class="nama-user text-center">' . $arrayUser['namaUser'] . '</td>
                            <td class="nama-barang text-center" style="width:30vw">' . $arrayBarang['daftarBarang'] . '</td>
                            <td class="status text-center">'. $status .'</td>
                            <td class="id-transaksi text-center">Rp. ' . $arrayBarang['total'] . '</td>
                            <td class="alamat-user text-left">' . $arrayUser['alamat'] . '</td>
                            <td class="id-transaksi text-center">' . $arrayBarang['tanggal'] . '</td>
                            </tr>
                            ';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </table>
                </div>
            </div>
        </div>
    </center>
    <script>
        window.print();
    </script>
</body>
</html>