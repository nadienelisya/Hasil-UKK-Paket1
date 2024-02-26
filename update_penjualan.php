<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("location:login.php");
} else {
  ?>
<?php
include 'koneksi.php';
$id         = $_GET['PenjualanID'];
$penjualan  = mysqli_query($koneksi, "select * from penjualan where PenjualanID='$id'");
$d        = mysqli_fetch_array($penjualan);
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
						<h1>Produk</h1>
					</div>
					<div class="card-body">
					<form action="updpenjualan_aksi.php" method="post" name="form1">
					<table width="25%" border="0">
                    <?php
    include "koneksi.php";
    if (isset($_POST["ok"])) {
        $idp = $_POST['PenjualanID'];
        $tanggal = date("Y-m-d");   

        $simpan=mysqli_query($koneksi, "update penjualan set
        TanggalPenjualan='$tanggal'
        where PenjualanID='$idp'");

        if ($simpan) {
           header("location:penjualan.php");
        } else {
            echo "<div class='alert alert-danger'>Gagal Merubah Data!</div> ";
        }
    }
?>
                            <div class="form-group">
								<label for="idpenjualan">ID Penjualan</label>
								<input type="text" name="PenjualanID" value="<?php echo $d['PenjualanID']; ?>" class="form-control" id="Penjualan ID" placeholder="id penjualan" readonly>
                            </div>

                            <div class="form-group">
								<label for="tanggalpenjualan">Tanggal Penjualan</label>
								<input type="date" name="TanggalPenjualan" value="<?php echo $d['TanggalPenjualan']; ?>" class="form-control" id="TanggalPenjualan" placeholder="tanggal penjualank">
							</div>

							<button type="submit" name="ok" class="btn btn-primary">Submit</button>
							<a href="penjualan.php" class="btn btn-danger">Cancel</button>
                            
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