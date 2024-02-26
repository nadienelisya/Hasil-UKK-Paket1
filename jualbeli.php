<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("location:login.php");
} else {
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
			<?php 
include ("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $PenjualanID = $_POST['PenjualanID'];
    $TanggalPenjualan = date("Y-m-d");
    $DetailID = $_POST['DetailID'];
    $ProdukID = $_POST['ProdukID'];
    $JumlahProduk = $_POST['JumlahProduk'];
    
    // Query untuk mengurangi stok produk
    $queryStok = "SELECT Stok, Harga FROM produk WHERE ProdukID = '$ProdukID'";
    $resultStok = mysqli_query($koneksi, $queryStok);
    $rowStok = mysqli_fetch_assoc($resultStok);
    $stok_produk = $rowStok['Stok'];
    $Harga = $rowStok['Harga'];

    // Hitung subtotal
    $sub = $Harga * $JumlahProduk;

    if ($stok_produk >= $JumlahProduk) {
        // Kurangi stok produk
        $stok_baru = $stok_produk - $JumlahProduk;
        
        // Update stok produk di database
        $queryUpdateStok = "UPDATE produk SET Stok = '$stok_baru' WHERE ProdukID = '$ProdukID'";
        mysqli_query($koneksi, $queryUpdateStok);
        
        // Simpan data ke tabel detail_penjualan
        $queryDetail = "INSERT INTO detail_penjualan (DetailID, PenjualanID, ProdukID, JumlahProduk, SubTotal) VALUES ('$DetailID', '$PenjualanID', '$ProdukID', '$JumlahProduk','$sub')";
        mysqli_query($koneksi, $queryDetail);
        
        // Hitung total harga dari semua barang yang ada dalam penjualan
        $queryTotal = "SELECT SUM(SubTotal) AS TotalHarga FROM detail_penjualan WHERE PenjualanID = '$PenjualanID'";
        $resultTotal = mysqli_query($koneksi, $queryTotal);
        $rowTotal = mysqli_fetch_assoc($resultTotal);
        $totalHarga = $rowTotal['TotalHarga'];
        
        // Simpan data ke tabel penjualan
        $queryPenjualan = "INSERT INTO penjualan (PenjualanID, TanggalPenjualan, TotalHarga) VALUES ('$PenjualanID', '$TanggalPenjualan', '$totalHarga')";
        mysqli_query($koneksi, $queryPenjualan);
    
        // Redirect atau lakukan tindakan lain setelah berhasil menyimpan
        header("Location: detail_penjualan.php");
        exit();
    } else {
        // Stok produk tidak mencukupi
        echo "Stok produk tidak mencukupi untuk transaksi ini.";
    }
}
?>
				<div class="card mt-5">
					<div class="card-title text-center">
						<h1>Kasir Penjualan</h1>
					</div>
					<div class="card-body">
					<form action=" " method="post" name="form1">
					<table width="25%" border="0">
							<div class="form-group">
								<label for="detailid">ID Detail</label>
								<input type="text" name="DetailID" class="form-control" id="DetailID" placeholder="id detail">
							</div>

							<div class="form-group">
								<label for="idproduk">ID Penjualan</label>
								<input type="text" name="PenjualanID" class="form-control" id="Penjualan ID" placeholder="id penjualan">

							</div>
							<div class="form-group">
								<label for="tanggalpenjualan">Tanggal Penjualan</label>
								<input type="date" name="TanggalPenjualan" class="form-control" id="TanggalPenjualan" placeholder="tanggal penjualan">
							</div>
							
							<div class="form-group">
								<label for="produkid">ID Produk</label>
								<select name="ProdukID" class="form-control">
                    <option disabled selected>Pilih</option>
                    <?php
                      $t_produk = mysqli_query($koneksi, "select ProdukID, NamaProduk from produk");
                      foreach ($t_produk as $produk) {
                        echo "<option value=$produk[ProdukID]>$produk[NamaProduk]</option>";
                      }            
                      ?>
                      </select>

							</div>
                            <div class="form-group">
								<label for="jumlahproduk">Jumlah Produk</label>
								<input type="text" name="JumlahProduk" class="form-control" id="JumlahProduk" placeholder="jumlah produk">
							</div>

							<button type="submit" name="ok" class="btn btn-primary">Submit</button>
							<a href="dashboard.php" class="btn btn-secondary">Kembali</button></a>
							
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