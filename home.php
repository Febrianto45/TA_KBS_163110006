<?php
require('config/db.php');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <title>KBS</title>
  <link rel="stylesheet" href="asset/css/style.css">
  <link rel="stylesheet" type="text/css" href="plugin/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="asset/css/main.css">
  <link rel="icon" type="image/gif/png" href="asset/img/logo.png">
</head>

<body>

  <?php include('component/nav.php'); ?>
  <div class="container-fluid" id="isi">

    <div class="row">
      <div class="col-xs-2 col-xs-offset-5" id="barang-laris">
        <h3 style="font-family: Blacksword; font-size:2.0em;"><strong>Selamat Datang</strong></h3>
      </div>
    </div>

    <!-- Laman Barang-->
  
  <div class="container" id="barang">
    <div class="tab-content">
      <!-- Umbi-Umbian -->
      <div id="umbi" class="tab-pane fade in active">
      <ul>
      <?php 
        require("config/db.php");
        $limit = 4;
        $sql = mysqli_query($conn, "SELECT count(idBarang) FROM tabel_barang WHERE kategori='umbi'");
        $row = mysqli_fetch_array($sql, MYSQLI_NUM);
        $rec_count = $row[0];
        if(isset($_GET['page'])){
          $page = $_GET['page'] + 1;
          $offset = $limit * $page;
        }else{
          $page = 0;
          $offset = 0;
        }
        $left_rec = $rec_count - ($page * $limit);
        $queryUmbi = "SELECT * FROM tabel_barang WHERE kategori='umbi' LIMIT $offset,$limit";
        $query_umbi = mysqli_query($conn, $queryUmbi);

        while($arrayUmbi = mysqli_fetch_array($query_umbi)){
          echo '
            <li>
              <a href="#'.$arrayUmbi['idBarang'].'">
                <img src="admin/proses/'.$arrayUmbi['path'].'" alt="'.$arrayUmbi['namaBarang'].'">
                <span></span>
              </a>
              <div class="overlay" id="'.$arrayUmbi['idBarang'].'">
                <a href="#" class="close"><i class="glyphicon glyphicon-remove"></i></a>
                <img src="admin/proses/'.$arrayUmbi['path'].'">
                <div class="keterangan">
                  <div class="container">
                    <h4><strong>'.$arrayUmbi['namaBarang'].'</strong></h4>
                    <p>'.$arrayUmbi['keterangan'].'</p>
                    <h5>Rp.'.$arrayUmbi['harga'].'</h5>
                    <h5 class="kg">satuan : ' . $arrayUmbi['satuan'] . '</h5>
                    <button type="button" class="btn btn-success">Stock : '.$arrayUmbi['stock'].'</button>
                    ';
              if(isset($_SESSION['idUser'])){
                if($arrayUmbi['stock'] > 0){
                  echo '
                  <a href="proses/beli.php?idBarang='.$arrayUmbi['idBarang'].'&idUser='.$iduser.'"><button type="button" class="btn btn-info">Masukkan Keranjang</button></a>
                ';
                }else{
                  echo '
                  <button type="button" class="btn btn-info disabled">Masukkan Keranjang</button>
                ';
                }
              }else{
                echo '
                  <button type="button" class="btn btn-info disabled">Masukkan Keranjang</button>
                ';
              }
              echo '
            </div>
          </div>
        </div>
      </li>  
          ';
        }
        ?>
      <div class="clear"></div>
    </ul>

    <div class="container-fluid" id="paging">
      <div class="paging">
      <?php 
      if($left_rec < $limit){
          $last = $page - 2;
          echo "<a href = \"?page=$last\"><button type='button' class='btn btn-primary left'>Previous</button></a>";
        }else if($page > 0){
          $last = $page - 2;
          echo "<a href = \"?page=$last\"><button type='button' class='btn btn-primary left'>Previous</button></a>";
          echo "<a href = \"?page=$page\"><button type='button' class='btn btn-primary right'>Next</button></a>";
        }else if( $page == 0 ) {
          echo "<a href = \"?page=$page\"><button type='button' class='btn btn-primary right'>Next</button></a>";
        }
      ?>
    </div>
    </div>
    </div>
        <!-- end of Umbi-Umbian -->

        <!-- Biji-Bijian -->
        <div id="biji" class="tab-pane fade">
          <ul>
            <?php
            require("config/db.php");

            $queryBiji = "SELECT * FROM tabel_barang WHERE kategori='biji' LIMIT 0,5";
            $query_biji = mysqli_query($conn, $queryBiji);

            while ($arrayBiji = mysqli_fetch_array($query_biji)) {
              echo '
            <li>
            <br>
        <a href="#' . $arrayBiji['idBarang'] . '">
          <img src="admin/proses/' . $arrayBiji['path'] . '" alt="' . $arrayBiji['namaBarang'] . '">
          <span></span>
        </a>
        <div class="overlay" id="' . $arrayBiji['idBarang'] . '">
          <a href="#" class="close"><i class="glyphicon glyphicon-remove"></i></a>
          <img src="admin/proses/' . $arrayBiji['path'] . '">
          <div class="keterangan">
            <div class="container">
              <h4><strong>' . $arrayBiji['namaBarang'] . '</strong></h4>
              <p>' . $arrayBiji['keterangan'] . '</p>
              <h5>Rp.' . $arrayBiji['harga'] . '</h5>
              <h5 class="kg">satuan : ' . $arrayBiji['satuan'] . '</h5>
              <button type="button" class="btn btn-success">Stock : ' . $arrayBiji['stock'] . '</button>
              ';
              if (isset($_SESSION['idUser'])) {
                if ($arrayBiji['stock'] > 0) {
                  echo '
                  <a href="proses/beli.php?idBarang=' . $arrayBiji['idBarang'] . '&idUser=' . $iduser . '"><button type="button" class="btn btn-info">Masukkan Keranjang</button></a>
                ';
                } else {
                  echo '
                  <button type="button" class="btn btn-info disabled">Masukkan Keranjang</button>
                ';
                }
              } else {
                echo '
                  <button type="button" class="btn btn-info disabled">Masukkan Keranjang</button>
                ';
              }
              echo '
            </div>
          </div>
        </div>
      </li>  
          ';
            }
            ?>
            <div class="clear"></div>
          </ul>
        </div>
        <!-- end of Biji-Bijian -->

        <!-- Buah-Buahan -->
        <div id="buah" class="tab-pane fade">
          <ul>
            <?php
            require("config/db.php");

            $queryBuah = "SELECT * FROM tabel_barang WHERE kategori='buah' LIMIT 0,5";
            $query_buah = mysqli_query($conn, $queryBuah);

            while ($arrayBuah = mysqli_fetch_array($query_buah)) {
              echo '
            <li>
            <br>
        <a href="#' . $arrayBuah['idBarang'] . '">
          <img src="admin/proses/' . $arrayBuah['path'] . '" alt="' . $arrayBuah['namaBarang'] . '">
          <span></span>
        </a>
        <div class="overlay" id="' . $arrayBuah['idBarang'] . '">
          <a href="#" class="close"><i class="glyphicon glyphicon-remove"></i></a>
          <img src="admin/proses/' . $arrayBuah['path'] . '">
          <div class="keterangan">
            <div class="container">
              <h4><strong>' . $arrayBuah['namaBarang'] . '</strong></h4>
              <p>' . $arrayBuah['keterangan'] . '</p>
              <h5>Rp.' . $arrayBuah['harga'] . '</h5>
              <h5 class="kg">satuan : ' . $arrayBuah['satuan'] . '</h5>
              <button type="button" class="btn btn-success">Stock : ' . $arrayBuah['stock'] . '</button>
              ';
              if (isset($_SESSION['idUser'])) {
                if ($arrayBuah['stock'] > 0) {
                  echo '
                  <a href="proses/beli.php?idBarang=' . $arrayBuah['idBarang'] . '&idUser=' . $iduser . '"><button type="button" class="btn btn-info">Masukkan Keranjang</button></a>
                ';
                } else {
                  echo '
                  <button type="button" class="btn btn-info disabled">Masukkan Keranjang</button>
                ';
                }
              } else {
                echo '
                  <button type="button" class="btn btn-info disabled">Masukkan Keranjang</button>
                ';
              }
              echo '
            </div>
          </div>
        </div>
      </li>  
          ';
            }
            ?>
            <div class="clear"></div>
          </ul>
        </div>
        <!-- end of buah-buahan -->

        <!-- Sayur-mayur -->
        <div id="sayur" class="tab-pane fade">
          <ul>
            <?php
            require("config/db.php");

            $querySayur = "SELECT * FROM tabel_barang WHERE kategori='sayur' LIMIT 0,5";
            $query_sayur = mysqli_query($conn, $querySayur);

            while ($arraySayur = mysqli_fetch_array($query_sayur)) {
              echo '
            <li>
            <br>
            <a href="#' . $arraySayur['idBarang'] . '">
              <img src="admin/proses/' . $arraySayur['path'] . '" alt="' . $arraySayur['namaBarang'] . '">
              <span></span>
            </a>
            <div class="overlay" id="' . $arraySayur['idBarang'] . '">
              <a href="#" class="close"><i class="glyphicon glyphicon-remove"></i></a>
              <img src="admin/proses/' . $arraySayur['path'] . '">
              <div class="keterangan">
                <div class="container">
                  <h4><strong>' . $arraySayur['namaBarang'] . '</strong></h4>
                  <p>' . $arraySayur['keterangan'] . '</p>
                  <h5>Rp.' . $arraySayur['harga'] . '</h5>
                  <h5 class="kg">satuan : ' . $arraySayur['satuan'] . '</h5>
                  <button type="button" class="btn btn-success">Stock : ' . $arraySayur['stock'] . '</button>
                  ';
              if (isset($_SESSION['idUser'])) {
                if ($arraySayur['stock'] > 0) {
                  echo '
                      <a href="proses/beli.php?idBarang=' . $arraySayur['idBarang'] . '&idUser=' . $iduser . '"><button type="button" class="btn btn-info">Masukkan Keranjang</button></a>
                    ';
                } else {
                  echo '
                      <button type="button" class="btn btn-info disabled">Masukkan Keranjang</button>
                    ';
                }
              } else {
                echo '
                      <button type="button" class="btn btn-info disabled">Masukkan Keranjang</button>
                    ';
              }
              echo '
                </div>
              </div>
            </div>
          </li>  
          ';
            }
            ?>
            <div class="clear"></div>
          </ul>
        </div>
        <!-- end of Sayur-mayur -->

        <!-- Lain-lain -->
        <div id="lain" class="tab-pane fade">
          <ul>
            <?php
            require("config/db.php");

            $queryLain = "SELECT * FROM tabel_barang WHERE kategori='lain' LIMIT 0,5";
            $query_lain = mysqli_query($conn, $queryLain);

            while ($arrayLain = mysqli_fetch_array($query_lain)) {
              echo '
            <li>
            <br>
        <a href="#' . $arrayLain['idBarang'] . '">
          <img src="admin/proses/' . $arrayLain['path'] . '" alt="' . $arrayLain['namaBarang'] . '">
          <span></span>
        </a>
        <div class="overlay" id="' . $arrayLain['idBarang'] . '">
          <a href="#" class="close"><i class="glyphicon glyphicon-remove"></i></a>
          <img src="admin/proses/' . $arrayLain['path'] . '">
          <div class="keterangan">
            <div class="container">
              <h4><strong>' . $arrayLain['namaBarang'] . '</strong></h4>
              <p>' . $arrayLain['keterangan'] . '</p>
              <h5>Rp.' . $arrayLain['harga'] . '</h5>
              <h5 class="kg">satuan : ' . $arrayLain['satuan'] . '</h5>
              <button type="button" class="btn btn-success">Stock : ' . $arrayLain['stock'] . '</button>
              ';
              if (isset($_SESSION['idUser'])) {
                if ($arrayLain['stock'] > 0) {
                  echo '
                  <a href="proses/beli.php?idBarang=' . $arrayLain['idBarang'] . '&idUser=' . $iduser . '"><button type="button" class="btn btn-info">Masukkan Keranjang</button></a>
                ';
                } else {
                  echo '
                  <button type="button" class="btn btn-info disabled">Masukkan Keranjang</button>
                ';
                }
              } else {
                echo '
                  <button type="button" class="btn btn-info disabled">Masukkan Keranjang</button>
                ';
              }
              echo '
            </div>
          </div>
        </div>
      </li>  
          ';
            }
            ?>
            <div class="clear"></div>
          </ul>
        </div>
        <!-- end of Lain-lain -->
      </div>
    </div>
    <!-- kontent end of produkumum -->
  </div>

  <?php include('component/footer.php'); ?>
  <script type="text/javascript" src="plugin/Javascript/jquery.min.js"></script>
  <script type="text/javascript" src="plugin/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript" src="asset/js/script.js"></script>
</body>

</html>