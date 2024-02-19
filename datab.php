<?php
require('config/db.php');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>KIOS BU SUM</title>
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" type="text/css" href="plugin/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="asset/css/main.css">
    <link rel="stylesheet" type="text/css" href="asset/css/keranjang.css">
    <link rel="icon" type="image/gif/png" href="asset/img/logo.png">
</head>

<body>
    <?php include('component/nav.php'); ?>

    <?php include('proses/ddata.php'); ?>

<div class="container-fluid" id="datab">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <h1 class="h3 mb-4 text-gray-700">Data Barang</h1>
                    </thead>
                    <tbody>
                <tr>
                <th style="width:20vw">ID Transaksi</a></th>
                <th style="width:60vw">Daftar Barang</th>
                <th style="width:20vw">Total</th>
                <th style="width:35vw">Tanggal/Time</a></th>
                <th style="width:25vw">Status</th>
                <th style="width:20vw">Actions</th>
                </tr>

        <?php
        if (isset($_SESSION['idUser']));
            error_reporting(0);
                $idUser = $_SESSION['idUser'];
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
                    if($arrayBarang['status'] == 0) {
                            $status = '<span class="badge badge-info">BARU</span>';
                    } else if ($arrayBarang['status'] == 1) {
                            $status = '<span class="badge badge-success">BARANG DI KIRIM</span>';
                    } else if ($arrayBarang['status'] == 2) {
                            $status = '<span class="badge badge-danger">BARANG AMBIL DI TEMPAT</span>';
                    }
                    echo '
                            <tr>
                            <td class="id-transaksi text-center"style="width:20vw">' . $arrayBarang['idTransaksi'] . '</td>
                            <td class="nama-barang text-center" style="width:50vw">' . $arrayBarang['daftarBarang'] . '</td>
                            <td class="id-transaksi text-center"style="width:20vw">Rp.' . $arrayBarang['total'] . '</td>
                            <td class="id-transaksi text-center"style="width:35vw">' . $arrayBarang['tanggal'] . '</td>
                            <td class="id-transaksi text-center"style="width:35vw">' . $status . '</td>
                            <td button class="btn btn-primary btn-sm mb-1 center-block" data-toggle="modal" data-target="#modalbeli">Validasi Data Barang</button></td>
                        ';
                }
            }
        ?>
        <!--td><a href="datav.php?idTransaksi=' . $arrayBarang['idTransaksi'] . '"><button type="button" class="btn btn-primary btn-sm mb-1">Confir Barang</a></td-->
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalbeli" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form action="datab.php" method="POST" role="form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Comfir pembelian barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <td><p>Terima Kasih sudah Berbelanja.pembayaran Di Rekening ABC 034xxxxxxx dilakukan Tempo waktu 24 jam setelah Pemesana atau bayar di tempat. Semoga anda nyaman dengan layanan kami.!<p></td>
                    <label for="idTransaksi">PILIHAN</label>
                    <select name="idTransaksi" id="idTransaksi" class="form-control" required>
                    <option value="">--Pilih --</option>
                    <option value="1">Barang Di Kirim</option>
                    <option value="2">Barang Ambil Di tempat</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button name="simpan" value="simpan_status" class="btn btn-primary">Lanjut</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
                </div>
            </div>
</div>
<?php include('component/footer.php'); ?>
<script type="text/javascript" src="plugin/Javascript/jquery.min.js"></script>
<script type="text/javascript" src="plugin/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="asset/js/script.js"></script>
</body>
</html>