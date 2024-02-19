<?php 
  require('../config/db.php');

  $UploadDir = 'image/';

  if(isset($_POST['upload'])){
    $conn = mysqli_connect('localhost', 'root', '', 'kbs');

    $datenow = Date('Y-m-d h:i:sa');
    $filename = md5(($_FILES['foto']['name']).$datenow);
    $tmpName = $_FILES['foto']['tmp_name'];
    $fileSize = $_FILES['foto']['size'];
    $fileType = $_FILES['foto']['type'];
    $filePath = $UploadDir . $filename.'.png';
    $result = move_uploaded_file($tmpName, $filePath);
    $namaBarang = $_POST['namaBarang'];
    $keterangan = $_POST['keterangan'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];
    $satuan = $_POST['satuan'];
    $stock = $_POST['stock'];

    $query = mysqli_query($conn, "INSERT INTO tabel_barang (namaBarang, gambar, satuan, keterangan, kategori, harga, stock, path, size) VALUES ('$namaBarang', '$filename', '$satuan', '$keterangan', '$kategori', '$harga', '$stock', '$filePath', '$fileSize')");

      if (!get_magic_quotes_gpc()) {
      $filename = addslashes($filename);
      $filePath = addslashes($filePath);
    }

    if($query){
      echo '
          <script>
            alert("Barang ditambahkan");
            window.location = "../admin.php"
          </script>
        ';
    }else{
      echo '
    <script>
        alert("Format Gambar Tidak Di Dukung (Format Harus .JPG, .JPEG, .PNG, dan .GIF)");
        window.location="../admin.php"
      </script>
    ';
    }
    mysqli_close($conn);
  }
?>

















  
  //     if($query){
  //       echo '
  //         <script>
  //           alert("Produk ditambahkan");
  //           window.location = "../admin.php"
  //         </script>
  //       ';
  //     }
  //   }
  // } else {
  //   echo '
  //     <script>
  //       alert("Format Gambar Tidak Di Dukung (Format Harus .JPG, .JPEG, .PNG, dan .GIF)");
  //       window.location="../admin.php"
  //     </script>
  //   ';
  // }


