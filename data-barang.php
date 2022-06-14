<?php 
// require files
require 'functions.php';

// cek apakah admin sudah login
if (!isset($_SESSION['isAdminLogin'])) {
	header("Location: login-admin.php");
}

// get data barang
$dataBarang = querySelect("SELECT * FROM barang");

// apakah sudah ada barang di database?
$barangAda = false;
if ($dataBarang != 0) {
	$barangAda = true;
}

?>

<!DOCTYPE html>
<html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSS Booststrap -->
	<link href="bootstrap\css\bootstrap.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="css\style.css">

	<title>Data Barang (Admin)</title>
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
		<h1 class="display-5">Data Barang Madani Shop</h1>
	</div>
	<!-- End of Jumbotron -->

	<!-- Tambah data Barang -->
	<div class="container">
		<div class="row">
			<div class="col">
				<form action="" method="">
					<a href="tambah-barang.php">
						<button type="button" class="btn btn-success">Tambah Barang</button>
					</a>
				</form>
			</div>
		</div>
	</div>
	<!-- End tambah barang -->

	<!-- Tabel Data Barang -->
	<div class="container table-responsive mt-3">
		<?php if (!$barangAda) { ?>
			<p class="text-center">Tidak ada data barang di database!</p>
		<?php } else { ?>
			<table class="table text-center table-hover table-bordered border-dark">
				<thead class="bg-success" style="color: white;">
					<tr>
						<td scope="col">ID</td>
						<td scope="col">Nama</td>
						<td scope="col">Stok</td>
						<td scope="col">Harga(Rp)</td>
						<td scope="col">Action</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($dataBarang as $data) : ?>
						<?php $namaBarangEach = $data['namaBarang']; ?>
						<tr>
							<td scope="col"><?php echo $data['idBarang']; ?></td>
							<td scope="col"><?php echo $data['namaBarang']; ?></td>
							<td scope="col"><?php echo $data['stokBarang']; ?></td>
							<td scope="col"><?php echo $data['hargaBarang']; ?></td>
							<td scope="col"> 
								<a href="edit-barang.php?idBarang=<?php echo $data['idBarang']; ?>" class="style-action-edit">Edit</a> | 
								<a href="hapus-barang.php?idBarang=<?php echo $data['idBarang']; ?>" class="style-action-hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data <?php echo $namaBarangEach; ?>?')">Hapus</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php } ?>
	</div>
	<!-- End tabel -->

	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>