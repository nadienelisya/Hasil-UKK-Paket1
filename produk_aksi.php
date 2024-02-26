<?php
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
    $id = $_POST['ProdukID'];
    $nama = $_POST['NamaProduk'];
	$harga = $_POST['Harga'];
	$stok = $_POST['Stok'];
 
// menginput data ke database
mysqli_query($koneksi,"insert into produk values('$id','$nama','$harga','$stok')");
 
// mengalihkan halaman kembali ke index.php
header("location:produk.php");

?>