<?php
include 'koneksi.php';
// menyimpan data kedalam variabel
$idd = $_POST['DetailID'];
$idp = $_POST['PenjualanID'];
$idpr = $_POST['ProdukID'];
$jumlah = $_POST['JumlahProduk'];                                          
// query SQL untuk insert data
mysqli_query($koneksi, "UPDATE detail_penjualan SET PenjualanID='$idp',ProdukID='$idpr',JumlahProduk='$jumlah' where DetailID='$idd'");
// mengalihkan ke halaman index.php
header("location:detail_penjualan.php");
?>