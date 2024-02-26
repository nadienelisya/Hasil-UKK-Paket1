<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("location:login.php");
} else {
  ?>
<?php
include 'koneksi.php';
$id         = $_GET['ProdukID'];
$produk  = mysqli_query($koneksi, "select * from produk where ProdukID='$id'");
$d        = mysqli_fetch_array($produk);
// membuat function untuk set aktif radio button
function active_radio_button($value,$input){
    // apabilan value dari radio sama dengan yang di input
    $result =  $value==$input?'checked':'';
    return $result;
}
?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

	<title> Kasir</title>
</head>
<!-- <style>
body {background-color:#D2A58E;}
</style> -->
<body>
	<div class="container">

		<div class="row">
			<div class="col-md-4 offset-md-4">

				<div class="card mt-5">
					<div class="card-title text-center">
						<h1>Penjualan</h1>
					</div>
					<div class="card-body">
					<form action="updproduk_aksi.php" method="post" name="form1">
					<table width="25%" border="0">
                    <?php
    include "koneksi.php";
    if (isset($_POST["ok"])) {
        $id=$_POST['ProdukID'];
        $nama=$_POST['NamaProduk'];
        $harga=$_POST['Harga'];
        $stok=$_POST['Stok'];

        $simpan=mysqli_query($koneksi, "update produk set
        NamaProduk='$nama',
        Harga='$harga',
        Stok='$stok'
        where ProdukID='$id'");

        if ($simpan) {
           header("location:produk.php");
        } else {
            echo "<div class='alert alert-danger'>Gagal Merubah Data!</div> ";
        }
    }
?>

							<div class="form-group">
								<label for="idproduk">ID Produk</label>
								<input type="text" name="ProdukID" value="<?php echo $d['ProdukID']; ?>" class="form-control" id="ProdukID" placeholder="id produk" readonly>

							</div>
							<div class="form-group">
								<label for="namaproduk">Nama Produk</label>
								<input type="text" value="<?php echo $d['NamaProduk'];?>" name="NamaProduk" class="form-control" id="NamaProduk" placeholder="nama produk">
								
							</div>
							<div class="form-group">
								<label for="harga">Harga</label>
								<input type="text" value="<?php echo $d['Harga'];?>" name="Harga" class="form-control" id="Harga" placeholder="harga">

							</div>
							<div class="form-group">
								<label for="stok">Stok</label>
								<input type="text" value="<?php echo $d['Stok'];?>" name="Stok" class="form-control" id="Stok" placeholder="stok">
							</div>

							<button type="submit" name="ok" class="btn btn-primary">Submit</button>
							<a href="produk.php" class="btn btn-danger">Cancel</button>
                            
						</form>


					</div>
				</div>
			</div>

		</div>

	</div>
</body>
<?php
}
?>