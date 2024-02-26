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

				<div class="card mt-5">
					<div class="card-title text-center">
						<h1>Produk</h1>
					</div>
					<div class="card-body">
					<form action="produk_aksi.php" method="post" name="form1">
					<table width="25%" border="0">
							<div class="form-group">
								<label for="idproduk">ID Produk</label>
								<input type="text" name="ProdukID" class="form-control" id="ProdukID" placeholder="id produk">

							</div>
							<div class="form-group">
								<label for="namaproduk">Nama Produk</label>
								<input type="text" name="NamaProduk" class="form-control" id="NamaProduk" placeholder="nama produk">
							</div>
							<div class="form-group">
								<label for="harga">Harga</label>
								<input type="text" name="Harga" class="form-control" id="Harga" placeholder="harga">

							</div>
							<div class="form-group">
								<label for="stok">Stok</label>
								<input type="text" name="Stok" class="form-control" id="Stok" placeholder="stok">
							</div>

							<button type="submit" name="ok" class="btn btn-primary">Submit</button>
							<a href="produk.php" class="btn btn-secondary">Kembali</button>
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