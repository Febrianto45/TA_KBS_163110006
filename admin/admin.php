<?php
session_start();
if (!isset($_SESSION['idAdmin'])) {
  header('location: index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Laman Admin</title>
  <link rel="stylesheet" type="text/css" href="../plugin/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../asset/css/admin.css">
  <style id="jsbin-css">
    body {
      background-color: #F2F2F2;
      font-family: helvetica;
    }

    #wrapper {
      text-align: center;
      margin: 0px auto;
      padding: 0px;
      width: 760px;
    }

    #wrapper p {
      border: 1px solid #999;
      padding: 20px;
      margin: 20px;
      background: #fff;
    }
    #tombolScrollTop {
      cursor: pointer;
      position: fixed;
      left: 93%;
      bottom: 50px;
      border: 3px solid #585858;
      background-color: teal;
      color: #ffffff;
      border-radius: 100%;
      height: 75px;
      width: 75px;
      font-size: 12px;
      display: none;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-2" id="sideLeft">
        <h4><strong>Administrator</strong></h4>
        <ul class="nav nav-pills nav-stacked" id="data">
          <li class="active"><a data-toggle="tab" href="#user">User</a></li>
          <li><a data-toggle="tab" href="#barang">Barang</a></li>
          <li><a data-toggle="tab" href="#transaksi">Transaksi</a></li>
          <li><a data-toggle="tab" href="#komen">Komentar</a></li>
          <li><a data-toggle="tab" href="#admin">Admin</a></li>
          <li><a href="proses/logout.php">
              <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-log-out"></span>Logout</button></a>
          </li>
        </ul>
      </div>
      <div class="col-xs-10">
        <div class="tab-content">

          <!-- tabel user -->
          <div id="user" class="tab-pane fade in active">
            <div class="row">
              <div class="col-xs-11 col-offset-xs-1">
                <h3 class="table-title"><strong>Tabel User</strong></h3>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th class="id-user ">ID User</th>
                      <th class="nama-user ">Nama</th>
                      <th class="telp-user ">Nomor Telp</th>
                      <th class="email-user ">Email</th>
                      <th class="alamat-user ">Alamat</th>
                      <th class="hapus "></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'kbs');
                    $queryUser = mysqli_query($conn, "SELECT * FROM tabel_user ORDER BY idUser ASC");
                    while ($arrayUser = mysqli_fetch_array($queryUser)) {
                      echo '
                          <tr>
                            <td class="id-user ">' . $arrayUser['idUser'] . '</td>
                            <td class="nama-user ">' . $arrayUser['namaUser'] . '</td>
                            <td class="telp-user ">' . $arrayUser['telpon'] . '</td>
                            <td class="email-user text-justify">' . $arrayUser['email'] . '</td>
                            <td class="alamat-user text-left">' . $arrayUser['alamat'] . '</td>
                            <td class="hapus"><a href="proses/hapusUser.php?idUser=' . $arrayUser['idUser'] . '">
                              <button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                            </a></td>
                          </tr>
                        ';
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- end of table user -->

          <!-- komentar -->
          <div id="komen" class="tab-pane fade">
            <div class="row">
              <div class="col-xs-11 col-offset-xs-1">
                <h3 class="table-title"><strong>Tabel Komentar</strong></h3>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th class="id-user ">ID Komentar</th>
                      <th class="nama-user ">Nama</th>
                      <th class="email-user ">Email</th>
                      <th class="alamat-user ">Pesan</th>
                      <th class="hapus "></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'kbs');
                    $queryKomen = mysqli_query($conn, "SELECT * FROM tabel_komentar ORDER BY idKomen ASC");
                    $jumlahKomen = mysqli_num_rows($queryKomen);
                    if ($jumlahKomen == 0) {
                      echo '
                            <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="width: 50vw">Belum Ada Komentar</td>
                            <td></td>
                          </tr>
                        ';
                    } else {
                      while ($arrayKomen = mysqli_fetch_array($queryKomen)) {
                        echo '
                            <tr>
                              <td class="id-user ">' . $arrayKomen['idKomen'] . '</td>
                              <td class="nama-user ">' . $arrayKomen['nama'] . '</td>
                              <td class="email-user text-justify">' . $arrayKomen['email'] . '</td>
                              <td class="alamat-user text-left">' . $arrayKomen['pesan'] . '</td>
                              <td class="hapus"><a href="proses/hapusKomen.php?idKomen=' . $arrayKomen['idKomen'] . '">
                                <button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                              </a></td>
                            </tr>
                          ';
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- komentar -->

          <!-- tabel barang -->
          <div id="barang" class="tab-pane fade">
            <h3 class="table-title"><strong>Tabel Barang</strong></h3>
            <button type="button" class="btn btn-success" id="tambah-data-barang" data-toggle="modal" data-target="#form-barang">Add Barang</button>

            <!-- modal form-admin -->
            <div class="modal fade" id="form-barang" role="dialog">
              <div class="modal-content" style="width:40vw;margin-top:10vh; margin-left:30vw">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 style="margin-left:150px"><strong>Tambahkan Barang</strong></h4>
                </div>
                <div class="modal-body">
                  <form action="proses/tambahBarang.php" method="post" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="namaBarang">Nama Barang</label>
                      <input type="text" class="form-control" name="namaBarang" id="namaBarang">
                    </div>
                    <div class="form-group">
                      <label for="foto">Foto Barang</label>
                      <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                    <div class="form-group">
                      <label for="harga">Harga</label>
                      <input type="number" class="form-control" name="harga" id="harga">
                    </div>
                    <div class="form-group">
                      <label for="kategori">Kategori</label>
                      <select class="form-control" id="kategori" name="kategori">
                        <option value="umbi">Umbi-Umbian</option>
                        <option value="biji">Biji-Bijian</option>
                        <option value="buah">Buah-Buahan</option>
                        <option value="sayur">Sayur-Mayur</option>
                        <option value="lain">Lain-lain</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="satuan">Satuan</label>
                      <select class="form-control" id="satuan" name="satuan">
                        <option value="0,1 kg">0,1 kg</option>
                        <option value="0,5 kg">0,5 kg</option>
                        <option value="1 kg">1 kg</option>
                        <option value="2 kg">2 kg</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="stock">Stock Barang</label>
                      <input type="number" class="form-control" id="stock" name="stock">
                    </div>
                    <div class="form-group">
                      <label for="pesan">Keterangan : </label>
                      <textarea class="form-control" name="keterangan" style="resize:vertical"></textarea>
                    </div>
                    <button type="reset" data-dismiss="modal" class="btn btn-primary">Batal</button>
                    <button type="submit" name="upload" class="btn btn-primary">Tambahkan</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- end of modal -->

            <div class="container">
              <h4 class="draf-kategori">Kategori : </h4>
              <ul class="nav nav-pills" style="margin-left: 15vw;">
                <li class="dropdown active item-kategori">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Kategori<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a data-toggle="tab" href="#tabel-umbi">Umbi-Umbian</a></li>
                    <li><a data-toggle="tab" href="#tabel-biji">Biji-Bijian</a></li>
                  </ul>
                </li>
                <li class="item-kategori"><a data-toggle="tab" href="#tabel-buah">Buah-Buahan</a></li>
                <li class="item-kategori"><a data-toggle="tab" href="#tabel-sayur">Sayur-Mayur</a></li>
                <li class="item-kategori"><a data-toggle="tab" href="#tabel-lain">Lain-lain</a></li>
              </ul>
            </div>
            <div class="tab-content">
              <div id="tabel-umbi" class="tab-pane fade">
                <div class="row">
                  <div class="col-xs-11 col-offset-xs-1">
                    <table class="table table-condensed" style="width:80vw">
                      <thead>
                        <tr>
                          <th class="id-barang text-center">ID Barang</th>
                          <th class="nama-barang text-center">Nama Barang</th>
                          <th class="keterangan-barang text-center">Keterangan</th>
                          <th class="harga-barang text-center">Harga</th>
                          <th class="satuan-barang text-center">Satuan</th>
                          <th class="stock-barang text-center">Stock</th>
                          <th class="gambar">Gambar Barang</th>
                          <th class="hapus"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'kbs');
                        $kategori = 'umbi';
                        $query = mysqli_query($conn, "SELECT idBarang, namaBarang, keterangan, harga, satuan, stock, path FROM tabel_barang WHERE kategori='$kategori' ");
                        while ($array = mysqli_fetch_array($query)) {
                          echo '
                          <tr>
                          <td class="id-barang text-center">' . $array['idBarang'] . '</td>
                          <td class="nama-barang text-center">' . $array['namaBarang'] . '</td>
                          <td class="keterangan-barang text-justify">' . $array['keterangan'] . '</td>
                          <td class="harga-barang text-center">' . $array['harga'] . '</td>
                          <td class="satuan-barang text-center">' . $array['satuan'] . '</td>
                          <td class="stock-barang text-center">' . $array['stock'] . '</td>
                          <td class="gambar"><img src="proses/' . $array['path'] . '" style="width: 15vw; height:30vh"></td>
                          <td class="hapus"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal' . $array['idBarang'] . '"><i class="glyphicon glyphicon-pencil"></i></button></td>
                        </tr>
                      ';
                          echo '
                  <!-- edit barang -->
                    <div class="modal fade" id="modal' . $array['idBarang'] . '" role="dialog">
                      <div class="modal-content" style="width:40vw;margin-top:10vh; margin-left:30vw">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 style="margin-left:150px"><strong>Edit Barang</strong></h4>
                        </div>
                        <div class="modal-body">
                            <form action="proses/updateBarang.php" method="post" role="form">
                            <input type="hidden" name="idBarang" value="' . $array['idBarang'] . '">
                            <div class="form-group">
                              <label for="harga">Harga (Jangan diisi apabila Harga tetap)</label>
                              <input type="number" class="form-control" name="harga" id="harga">
                            </div>
                            <div class="form-group">
                              <label for="stock">Stock Barang (Jangan diisi apabila Stock tetap)</label>
                              <input type="number" class="form-control" id="stock" name="stock">
                            </div>
                            <button type="reset" data-dismiss="modal" class="btn btn-primary">Batal</button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- end of modal edit barang -->
                      ';
                        }
                        ?>
                        </>
                    </table>
                  </div>
                </div>
              </div>
              <div id="tabel-biji" class="tab-pane fade">
                <div class="row">
                  <div class="col-xs-11 col-offset-xs-1">
                    <table class="table table-condensed" style="width:80vw">
                      <thead>
                        <tr>
                          <th class="id-barang text-center">ID Barang</th>
                          <th class="nama-barang text-center">Nama Barang</th>
                          <th class="keterangan-barang text-center">Keterangan</th>
                          <th class="harga-barang text-center">Harga</th>
                          <th class="satuan-barang text-center">Satuan</th>
                          <th class="stock-barang text-center">Stock</th>
                          <th class="gambar">Gambar Barang</th>
                          <th class="hapus"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'kbs');
                        $kategori = 'biji';
                        $query = mysqli_query($conn, "SELECT idBarang, namaBarang, keterangan, harga, satuan, stock, path FROM tabel_barang WHERE kategori='$kategori' ");
                        while ($array = mysqli_fetch_array($query)) {
                          echo '
                            <tr>
                              <td class="id-barang text-center">' . $array['idBarang'] . '</td>
                              <td class="nama-barang text-center">' . $array['namaBarang'] . '</td>
                              <td class="keterangan-barang text-justify">' . $array['keterangan'] . '</td>
                              <td class="harga-barang text-center">' . $array['harga'] . '</td>
                              <td class="satuan-barang text-center">' . $array['satuan'] . '</td>
                              <td class="stock-barang text-center">' . $array['stock'] . '</td>
                              <td class="gambar"><img src="proses/' . $array['path'] . '" style="width: 15vw; height: 30vh"></td>
                              <td class="hapus"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal' . $array['idBarang'] . '"><i class="glyphicon glyphicon-pencil"></i></button></td>
                            </tr>
                            ';
                          echo '
                      <!-- edit barang -->
                        <div class="modal fade" id="modal' . $array['idBarang'] . '" role="dialog">
                          <div class="modal-content" style="width:40vw;margin-top:10vh; margin-left:30vw">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 style="margin-left:150px"><strong>Edit Barang</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form action="proses/updateBarang.php" method="post" role="form">
                                <input type="hidden" name="idBarang" value="' . $array['idBarang'] . '">
                                <div class="form-group">
                                  <label for="harga">Harga (Jangan diisi apabila Harga tetap)</label>
                                  <input type="number" class="form-control" name="harga" id="harga">
                                </div>
                                <div class="form-group">
                                  <label for="stock">Stock Barang (Jangan diisi apabila Stock tetap)</label>
                                  <input type="number" class="form-control" id="stock" name="stock">
                                </div>
                                <button type="reset" data-dismiss="modal" class="btn btn-primary">Batal</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- end of modal edit barang -->
                          ';
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div id="tabel-buah" class="tab-pane fade">
                <div class="row">
                  <div class="col-xs-11 col-offset-xs-1">
                    <table class="table table-condensed" style="width:80vw">
                      <thead>
                        <tr>
                          <th class="id-barang text-center">ID Barang</th>
                          <th class="nama-barang text-center">Nama Barang</th>
                          <th class="keterangan-barang text-center">Keterangan</th>
                          <th class="harga-barang text-center">Harga</th>
                          <th class="satuan-barang text-center">Satuan</th>
                          <th class="stock-barang text-center">Stock</th>
                          <th class="gambar">Gambar Barang</th>
                          <th class="hapus"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'kbs');
                        $kategori = 'buah';
                        $query = mysqli_query($conn, "SELECT idBarang, namaBarang, keterangan, harga, satuan, stock, path FROM tabel_barang WHERE kategori='$kategori' ");
                        while ($array = mysqli_fetch_array($query)) {
                          echo '
                            <tr>
                              <td class="id-barang text-center">' . $array['idBarang'] . '</td>
                              <td class="nama-barang text-center">' . $array['namaBarang'] . '</td>
                              <td class="keterangan-barang text-justify">' . $array['keterangan'] . '</td>
                              <td class="harga-barang text-center">' . $array['harga'] . '</td>
                              <td class="satuan-barang text-center">' . $array['satuan'] . '</td>
                              <td class="stock-barang text-center">' . $array['stock'] . '</td>
                              <td class="gambar"><img src="proses/' . $array['path'] . '" style="width: 15vw; height: 30vh"></td>
                              <td class="hapus"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal' . $array['idBarang'] . '"><i class="glyphicon glyphicon-pencil"></i></button></td>
                            </tr>
                          ';
                          echo '
                      <!-- edit barang -->
                        <div class="modal fade" id="modal' . $array['idBarang'] . '" role="dialog">
                          <div class="modal-content" style="width:40vw;margin-top:10vh; margin-left:30vw">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 style="margin-left:150px"><strong>Edit Barang</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form action="proses/updateBarang.php" method="post" role="form">
                                <input type="hidden" name="idBarang" value="' . $array['idBarang'] . '">
                                <div class="form-group">
                                  <label for="harga">Harga (Jangan diisi apabila Harga tetap)</label>
                                  <input type="number" class="form-control" name="harga" id="harga">
                                </div>
                                <div class="form-group">
                                  <label for="stock">Stock Barang (Jangan diisi apabila Stock tetap)</label>
                                  <input type="number" class="form-control" id="stock" name="stock">
                                </div>
                                <button type="reset" data-dismiss="modal" class="btn btn-primary">Batal</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- end of modal edit barang -->
                          ';
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div id="tabel-sayur" class="tab-pane fade">
                <div class="row">
                  <div class="col-xs-11 col-offset-xs-1">
                    <table class="table table-condensed" style="width:80vw">
                      <thead>
                        <tr>
                          <th class="id-barang text-center">ID Barang</th>
                          <th class="nama-barang text-center">Nama Barang</th>
                          <th class="keterangan-barang text-center">Keterangan</th>
                          <th class="harga-barang text-center">Harga</th>
                          <th class="satuan-barang text-center">Satuan</th>
                          <th class="stock-barang text-center">Stock</th>
                          <th class="gambar">Gambar Barang</th>
                          <th class="hapus"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'kbs');
                        $kategori = 'sayur';
                        $query = mysqli_query($conn, "SELECT idBarang, namaBarang, keterangan, harga, satuan, stock, path FROM tabel_Barang WHERE kategori='$kategori' ");
                        while ($array = mysqli_fetch_array($query)) {
                          echo '
                            <tr>
                              <td class="id-barang text-center">' . $array['idBarang'] . '</td>
                              <td class="nama-barang text-center">' . $array['namaBarang'] . '</td>
                              <td class="keterangan-barang text-justify">' . $array['keterangan'] . '</td>
                              <td class="harga-barang text-center">' . $array['harga'] . '</td>
                              <td class="satuan-barang text-center">' . $array['satuan'] . '</td>
                              <td class="stock-barang text-center">' . $array['stock'] . '</td>
                              <td class="gambar"><img src="proses/' . $array['path'] . '" style="width: 15vw; height: 30vh"></td>
                              <td class="hapus"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal' . $array['idBarang'] . '"><i class="glyphicon glyphicon-pencil"></i></button></td>
                            </tr>
                          ';
                          echo '
                            <!-- edit barang -->
                        <div class="modal fade" id="modal' . $array['idBarang'] . '" role="dialog">
                          <div class="modal-content" style="width:40vw;margin-top:10vh; margin-left:30vw">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 style="margin-left:150px"><strong>Edit Barang</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form action="proses/updateBarang.php" method="post" role="form">
                                <input type="hidden" name="idBarang" value="' . $array['idBarang'] . '">
                                <div class="form-group">
                                  <label for="harga">Harga (Jangan diisi apabila Harga tetap)</label>
                                  <input type="number" class="form-control" name="harga" id="harga">
                                </div>
                                <div class="form-group">
                                  <label for="stock">Stock Barang (Jangan diisi apabila Stock tetap)</label>
                                  <input type="number" class="form-control" id="stock" name="stock">
                                </div>
                                <button type="reset" data-dismiss="modal" class="btn btn-primary">Batal</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- end of modal edit barang -->
                          ';
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div id="tabel-lain" class="tab-pane fade">
                <div class="row">
                  <div class="col-xs-11 col-offset-xs-1">
                    <table class="table table-condensed" style="width:80vw">
                      <thead>
                        <tr>
                          <th class="id-barang text-center">ID Barang</th>
                          <th class="nama-barang text-center">Nama Barang</th>
                          <th class="keterangan-barang text-center">Keterangan</th>
                          <th class="harga-barang text-center">Harga</th>
                          <th class="satuan-barang text-center">Satuan</th>
                          <th class="stock-barang text-center">Stock</th>
                          <th class="gambar">Gambar Barang</th>
                          <th class="hapus"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'kbs');
                        $kategori = 'lain';
                        $query = mysqli_query($conn, "SELECT idBarang, namaBarang, keterangan, harga, satuan, stock, path FROM tabel_barang WHERE kategori='$kategori' ");
                        while ($array = mysqli_fetch_array($query)) {
                          echo '
                            <tr>
                              <td class="id-barang text-center">' . $array['idBarang'] . '</td>
                              <td class="nama-barang text-center">' . $array['namaBarang'] . '</td>
                              <td class="keterangan-barang text-justify">' . $array['keterangan'] . '</td>
                              <td class="harga-barang text-center">' . $array['harga'] . '</td>
                              <td class="satuan-barang text-center">' . $array['satuan'] . '</td>
                              <td class="stock-barang text-center">' . $array['stock'] . '</td>
                              <td class="gambar"><img src="proses/' . $array['path'] . '" style="width: 15vw; height: 30vh"></td>
                              <td class="hapus"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal' . $array['idBarang'] . '"><i class="glyphicon glyphicon-pencil"></i></button></td>
                            </tr>
                          ';
                          echo '
                            <!-- edit barang -->
                        <div class="modal fade" id="modal' . $array['idBarang'] . '" role="dialog">
                          <div class="modal-content" style="width:40vw;margin-top:10vh; margin-left:30vw">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 style="margin-left:150px"><strong>Edit Barang</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form action="proses/updateBarang.php" method="post" role="form">
                                <input type="hidden" name="idBarang" value="' . $array['idBarang'] . '">
                                <div class="form-group">
                                  <label for="harga">Harga (Jangan diisi apabila Harga tetap)</label>
                                  <input type="number" class="form-control" name="harga" id="harga">
                                </div>
                                <div class="form-group">
                                  <label for="stock">Stock Barang (Jangan diisi apabila Stock tetap)</label>
                                  <input type="number" class="form-control" id="stock" name="stock">
                                </div>
                                <button type="reset" data-dismiss="modal" class="btn btn-primary">Batal</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- end of modal edit barang -->
                          ';
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- end of tabel barang -->

        <!-- tabel transaksi -->
        </div>
          <div id="transaksi" class="tab-pane fade">
            <div class="row">
              <div class="col-xs-11 col-offset-xs-1">
                <h3 class="table-title"><strong>Tabel Transaksi</strong></h3>
                <button type="button" class="btn btn-default" class="print" onclick="return confirm('Yakin Data Akan Di Cetak');">
                  <a href="proses/printTransaksi.php?idTransaksi=' . $arrayBarang['idTransaksi'] . '" style="text-decoration:none">Cetak Print</button></a><br>
                <table class="table table-hover"><br>
                  <thead>
                    <tr>
                      <th class="id-transaksi text-center">ID Transaksi</th>
                      <th class="nama-user text-center">Nama Pembeli</th>
                      <th class="text-center" style="width:30vw">Daftar Barang</th>
                      <th class="status">Status</th>
                      <th class="id-transaksi">Total</th>
                      <th class="alamat-user">Alamat User</th>
                      <th class="id-transaksi">Tanggal/Time</th>
                      <th class="hapus text-center"></th>
                      <th class="cetak text-center"></th>
                    </tr>
                  </thead>
                  <tbody>
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
                            <td></td>
                            <td></td>
                            <td style="width: 50vw">Belum Ada Transaksi</td>
                            <td></td>
                            <td></td>
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
                            <td class="id-transaksi text-center">' . $arrayBarang['idTransaksi'] . '</td>
                            <td class="nama-user text-center">'. $arrayUser['namaUser'] .'</td>
                            <td class="nama-barang text-center" style="width:30vw">' . $arrayBarang['daftarBarang'] . '</td>
                            <td class="status text-center">'. $status .'</td>
                            <td class="id-transaksi text-center">Rp. ' . $arrayBarang['total'] . '</td>
                            <td class="alamat-user text-left">' . $arrayUser['alamat'] . '</td>
                            <td class="id-transaksi text-center">' . $arrayBarang['tanggal'] . '</td>
                            <td class="hapus"><a href="proses/hapusTransaksi.php?idTransaksi=' . $arrayBarang['idTransaksi'] . '"><button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button></a></td>
                            </tr>
                          ';
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- end of tabel transaksi -->

          <div id="admin" class="tab-pane fade">
            <div class="row">
              <div class="col-xs-11 col-offset-xs-1">
                <h3 class="table-title"><strong>Tabel Admin</strong></h3>
                <button type="button" class="btn btn-success" id="tambah-data-admin" data-toggle="modal" data-target="#form-admin">Add Admin</button>

                <!-- modal form-admin -->
                <div class="modal fade" id="form-admin" role="dialog">
                  <div class="modal-content" style="width:40vw;margin-top:10vh; margin-left:30vw">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 style="margin-left:150px"><strong>Tambahkan Admin</strong></h4>
                    </div>
                    <div class="modal-body">
                      <form action="proses/tambahAdmin.php" method="post" role="form">
                        <div class="form-group">
                          <label for="id-admin">ID Admin</label>
                          <input type="text" class="form-control" id="id-admin" name="idadmin">
                        </div>
                        <div class="form-group">
                          <label for="nama-admin">Nama</label>
                          <input type="text" class="form-control" id="nama-admin" name="namaadmin">
                        </div>
                        <div class="form-group">
                          <label for="email-admin">Email</label>
                          <input type="email" class="form-control" id="email-admin" name="emailadmin">
                        </div>
                        <div class="form-group">
                          <label for="password-admin">Password</label>
                          <input type="password" class="form-control" id="password-admin" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- end of modal -->

                <table class="table table-hover" id="tabel-admin">
                  <thead>
                    <tr>
                      <th class="id-transaksi text-center">ID Admin</th>
                      <th class="nama-user text-center">Nama</th>
                      <th class="email-user text-center">Email</th>
                      <th class="hapus text-center"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'kbs');
                    $queryAdmin = mysqli_query($conn, "SELECT * FROM tabel_admin");
                    while ($arrayAdmin = mysqli_fetch_array($queryAdmin)) {
                      echo '
                      <tr>
                        <td class="id-transaksi text-center">' . $arrayAdmin['idAdmin'] . '</td>
                        <td class="nama-user text-center">' . $arrayAdmin['namaAdmin'] . '</td>
                        <td class="email-user text-center">' . $arrayAdmin['email'] . '</td>
                        <td class="hapus">
                          <a href="proses/hapusAdmin.php?idAdmin=' . $arrayAdmin['idAdmin'] . '">
                              <button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                          </a>
                          </td>
                      </tr> 
                    ';
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="../plugin/Javascript/jquery.min.js"></script>
    <script type="text/javascript" src="../plugin/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
    </script>
    <input type="button" value="Scroll Top" id="tombolScrollTop" onclick="scrolltotop()">
    <script id="jsbin-javascript">
      $(document).ready(function() {
        $(window).scroll(function() {
          if ($(window).scrollTop() > 100) {
            $('#tombolScrollTop').fadeIn();
          } else {
            $('#tombolScrollTop').fadeOut();
          }
        });
      });
      function scrolltotop() {
        $('html, body').animate({
          scrollTop: 0
        }, 500);
      }
    </script>
</body>
</html>