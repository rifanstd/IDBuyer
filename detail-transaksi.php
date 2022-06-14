<?php 
// require files
require 'functions.php';

// cek apakah admin sudah login
if (!isset($_SESSION['isAdminLogin'])) {
	header("Location: login-admin.php");
}

// ambil data transaksi yang ingin di tampilkan
$idTransaksi = $_GET['idTransaksi'];
$dataTransaksi = querySelect("SELECT * FROM transaksi WHERE idTransaksi = '$idTransaksi'");
$idKasir = $dataTransaksi[0]['idKasir'];
$namaKasir = querySelect("SELECT namaKasir FROM kasir WHERE idKasir = '$idKasir'")[0]['namaKasir'];
$dataDetailTransaksi = querySelect("SELECT * FROM detail_transaksi WHERE idTransaksi = '$idTransaksi'");


?>


<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSS Booststrap -->
	<link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="css\style.css">

	<title>Detail Transaksi</title>
</head>
<body>
	<!-- section nav bar -->
	<section>
		<nav class="navbar navbar-expand-lg navbar-dark bg-success">
			<div class="container">
				<span class="navbar-brand">IDBuyer (Admin)</span>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
						<li class="nav-item me-4">
							<a class="nav-link active" aria-current="page" href="data-barang.php">Home</a>
						</li>
						<li class="nav-item me-4">
							<a class="nav-link active" aria-current="page" href="data-barang.php">Data Barang</a>
						</li>
						<li class="nav-item me-4">
							<a class="nav-link active" aria-current="page" href="data-transaksi.php">Data Transaksi</a>
						</li>
						<li class="nav-item me-4 dropdown">
							<a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Data User
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="tambah-admin.php">Tambah Data Admin</a></li>
								<li><a class="dropdown-item" href="tambah-kasir.php">Tambah Data Kasir</a></li>
							</ul>
						</li>
						<li class="nav-item me-4">
							<a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</section>
	<!-- end of navbar -->

	<!-- Jumbotron -->
	<div class="jumbotron mt-5 mb-5 text-center">
		<h1 class="display-5">Detail Transaksi Madani Shop</h1>
		<h2 class="display-5 fs-1">ID Transaksi : <?php echo $idTransaksi ?></h2>
	</div>
	<!-- End of Jumbotron -->

	<!-- Detail -->
	<div class="container-fluid fs-5">
		<div class="container">
			<table>
				<tr>
					<td>ID Transaksi</td>
					<td><?php echo " : ".$idTransaksi; ?></td>
				</tr>
				<tr>
					<td>ID Kasir</td>
					<td><?php echo " : ".$dataTransaksi[0]['idKasir']; ?></td>
				</tr>
				<tr>
					<td>Nama Kasir</td>
					<td><?php echo " : ".$namaKasir; ?></td>
				</tr>
				<tr>
					<td>Tanggal Transaksi</td>
					<td><?php echo " : ".$dataTransaksi[0]['tanggalTransaksi']; ?></td>
				</tr>
				<tr>
					<td>Total Barang</td>
					<td><?php echo " : ".$dataTransaksi[0]['jumlahBarang']; ?></td>
				</tr>
				<tr>
					<td>Total Transaksi (Rp)</td>
					<td><?php echo " : ".$dataTransaksi[0]['totalHarga']; ?></td>
				</tr>
				<tr></tr>
			</table>
		</div>
		<div class="container mt-3">
			<div class="row">
				<div class="col fw-bold">Rincian : </div>
			</div>
			<div class="row">
				<div class="col">
					<div class="container table-responsive mt-2">
						<table class="table text-center table-hover table-bordered border-dark">
							<thead class="bg-success" style="color: white;">
								<tr>
									<td scope="col">ID Barang</td>
									<td scope="col">Nama</td>
									<td scope="col">Jumlah</td>
									<td scope="col">Harga(Rp)</td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($dataDetailTransaksi as $data) : ?>
									<?php $namaBarangEach = $data['namaBarang']; ?>
									<tr>
										<td scope="col"><?php echo $data['idBarang']; ?></td>
										<td scope="col"><?php echo $data['namaBarang']; ?></td>
										<td scope="col"><?php echo $data['jumlahBarang']; ?></td>
										<td scope="col"><?php echo $data['hargaBarang']; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>	
			</div>
			<div class="row mb-5">
				<div class="col">
					<form>
						<a href="data-transaksi.php">
							<button type="button" class="btn btn-success">Kembali</button>
						</a>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- End of detail -->


	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>