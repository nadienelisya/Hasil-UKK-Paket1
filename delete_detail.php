<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("location:login.php");
} else {
 
    include "koneksi.php";
    if (isset($_GET['DetailID'])) {
        $id    =$_GET['DetailID'];
    }
    else{
        echo "Oops! No ID Selected";
    }
    
    if (!empty($id) && $id != "") {
        $hapus =mysqli_query($koneksi, "DELETE FROM detail_penjualan WHERE DetailId='$id'");
            ?>
                <script language="JavaScript">
                alert('Good! Data Produk Berhasil Dihapus...');
                document.location='detail_penjualan.php';
                </script>
            <?php        
    }
}
?>