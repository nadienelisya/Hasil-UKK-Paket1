<?php

include 'koneksi.php';
// menyimpan data kedalam variabel
$id = $_POST['ProdukID'];
$nama = $_POST['NamaProduk'];
$harga = $_POST['Harga'];
$stok = $_POST['Stok'];                                          
// query SQL untuk insert data
mysqli_query($koneksi, "UPDATE produk SET NamaProduk='$nama',Harga='$harga',Stok='$stok'where ProdukID='$id'");
// mengalihkan ke halaman index.php
header("location:produk.php");

?>