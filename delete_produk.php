<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("location:login.php");
} else {
    include "koneksi.php";
    if (isset($_GET['ProdukID'])) {
        $id    =$_GET['ProdukID'];
    }
    else{
        echo "Oops! No ID Selected";
    }
    
    if (!empty($id) && $id != "") {
        $hapus =mysqli_query($koneksi, "DELETE FROM produk WHERE ProdukID='$id'");
            ?>
                <script language="JavaScript">
                alert('Good! Data Produk Berhasil Dihapus...');
                document.location='produk.php';
                </script>
            <?php        
    }
}
?>