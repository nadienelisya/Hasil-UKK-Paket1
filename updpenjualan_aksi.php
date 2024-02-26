<?php
include 'koneksi.php';
// menyimpan data kedalam variabel
        $idp = $_POST['PenjualanID'];
        $tanggal = $_POST['TanggalPenjualan'];                                          
// query SQL untuk insert data
mysqli_query($koneksi, "UPDATE penjualan SET TanggalPenjualan='$tanggal' where PenjualanID='$idp'");
// mengalihkan ke halaman index.php
header("location:penjualan.php");
?>