<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("location:login.php");
} else {
  ?>
<?php
include 'koneksi.php';
$id         = $_GET['DetailID'];
$detail  = mysqli_query($koneksi, "select * from detail_penjualan where DetailID='$id'");
$d        = mysqli_fetch_array($detail);
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
					<form action="" method="post" name="form1">
					<table width="25%" border="0">
					<?php
include "koneksi.php";

if (isset($_POST["ok"])) {
    $DetailID = $_POST['DetailID'];
    $PenjualanID = $_POST['PenjualanID'];
    $ProdukID = $_POST['ProdukID'];
    $JumlahProduk = $_POST['JumlahProduk'];
    
    // Pastikan untuk melakukan validasi dan pembersihan data sebelum digunakan dalam kueri SQL

    // Misalnya, Anda dapat menggunakan fungsi mysqli_real_escape_string untuk membersihkan data dari potensi serangan SQL injection
    $DetailID = mysqli_real_escape_string($koneksi, $DetailID);
    $PenjualanID = mysqli_real_escape_string($koneksi, $PenjualanID);
    $ProdukID = mysqli_real_escape_string($koneksi, $ProdukID);
    $JumlahProduk = mysqli_real_escape_string($koneksi, $JumlahProduk);

    // Ambil nilai harga produk dari database berdasarkan ProdukID yang dipilih
    $queryHarga = "SELECT Harga FROM produk WHERE ProdukID = '$ProdukID'";
    $resultHarga = mysqli_query($koneksi, $queryHarga);
    $rowHarga = mysqli_fetch_assoc($resultHarga);
    $hargaProduk = $rowHarga['Harga'];

    // Hitung SubTotal
    $subTotal = $hargaProduk * $JumlahProduk;

    $simpan = mysqli_query($koneksi, "UPDATE detail_penjualan SET
        PenjualanID='$PenjualanID',
        ProdukID='$ProdukID',
        JumlahProduk='$JumlahProduk',
        SubTotal='$subTotal'
        WHERE DetailID='$DetailID'");

    if ($simpan) {
        // Perbarui TotalHarga di tabel penjualan
        $queryTotalHarga = "SELECT SUM(SubTotal) AS TotalHarga FROM detail_penjualan WHERE PenjualanID = '$PenjualanID'";
        $resultTotalHarga = mysqli_query($koneksi, $queryTotalHarga);
        $rowTotalHarga = mysqli_fetch_assoc($resultTotalHarga);
        $totalHarga = $rowTotalHarga['TotalHarga'];

        // Update TotalHarga di tabel penjualan
        $updateTotalHarga = mysqli_query($koneksi, "UPDATE penjualan SET TotalHarga = '$totalHarga' WHERE PenjualanID = '$PenjualanID'");

        if ($updateTotalHarga) {
            header("location:detail_penjualan.php");
            exit(); // Pastikan untuk keluar setelah melakukan redirect
        } else {
            // Tambahkan pesan kesalahan jika penyimpanan gagal
            $errorMessage = "Gagal Memperbarui TotalHarga: " . mysqli_error($koneksi);
            echo "<div class='alert alert-danger'>$errorMessage</div>";
        }
    } else {
        // Tambahkan pesan kesalahan jika penyimpanan gagal
        $errorMessage = "Gagal Menyimpan Data Detail Penjualan: " . mysqli_error($koneksi);
        echo "<div class='alert alert-danger'>$errorMessage</div>";
    }
}
?>


							<div class="form-group">
								<label for="detailid">ID Detail</label>
								<input type="text" name="DetailID" value="<?php echo $d['DetailID']; ?>" class="form-control" id="DetailID" placeholder="id detail" readonly>
							</div>

                            <div class="form-group">
								<label for="penjualanid">ID Penjualan</label>
								<input type="text" name="PenjualanID" value="<?php echo $d['PenjualanID']; ?>" class="form-control" id="Penjualan ID" placeholder="id penjualan" readonly>
                            </div>			

							<div class="form-group">
								<label for="produkid">ID Produk</label>
                                <input type="text" name="ProdukID" value="<?php echo $d['ProdukID']; ?>" class="form-control">
                            </div>

                            <div class="form-group">
								<label for="jumlahproduk">Jumlah Produk</label>
								<input type="text" name="JumlahProduk" value="<?php echo $d['JumlahProduk']; ?>" class="form-control" id="JumlahProduk" placeholder="jumlah produk">
							</div>

							<button type="submit" name="ok" class="btn btn-primary">Submit</button>
							<a href="detail_penjualan.php" class="btn btn-danger">Cancel</button>
                            
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