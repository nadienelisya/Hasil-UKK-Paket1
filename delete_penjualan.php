<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("location:login.php");
} else {

    include "koneksi.php";
    if (isset($_GET['PenjualanID'])) {
        $id    =$_GET['PenjualanID'];
    }
    else{
        echo "Oops! No ID Selected";
    }
    
    if (!empty($id) && $id != "") {
        $hapus =mysqli_query($koneksi, "DELETE FROM penjualan WHERE PenjualanID='$id'");
            ?>
                <script language="JavaScript">
                alert('Good! Data Produk Berhasil Dihapus...');
                document.location='penjualan.php';
                </script>
            <?php        
    }
}
?>