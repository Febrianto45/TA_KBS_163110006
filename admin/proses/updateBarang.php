<?php 
  $conn = mysqli_connect('localhost', 'root', '', 'kbs');

  $harga = $_POST['harga'];
  $stock = $_POST['stock'];
  $id= $_POST['idBarang'];

  if($harga == 0 && $stock > 0){
    $query = mysqli_query($conn, "UPDATE tabel_barang SET stock='$stock' WHERE idBarang='$id' ");
      if($query){
        echo'
        <script>
        alert("Stock telah diupdate");
        window.location = "../admin.php";
        </script>
        ';
      }
  }else if($harga > 0 && $stock > 0){
    $query = mysqli_query($conn, "UPDATE tabel_barang SET harga='$harga', stock='$stock' WHERE idBarang='$id' ");
    if($query){
      echo'
      <script>
      alert("Data telah diupdate");
      window.location = "../admin.php";
      </script>
      ';
    }
  }else if($harga > 0 && $stock == 0){
    $query = mysqli_query($conn, "UPDATE tabel_barang SET harga='$harga' WHERE idBarang='$id' ");
    if($query){
      echo'
      <script>
      alert("Harga telah diupdate");
      window.location = "../admin.php";
      </script>
      ';
    }
  }  else{
      echo'
      <script>
      alert("Form Tidak boleh kosong !");
      window.location = "../admin.php";
      </script>
      ';
    }

?>