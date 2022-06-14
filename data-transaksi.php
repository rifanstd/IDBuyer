<?php 
// require files
require 'functions.php';

// cek apakah admin sudah login
if (!isset($_SESSION['isAdminLogin'])) {
	header("Location: login-admin.php");
}

// select All data
$selectAll = "SELECT * FROM transaksi ORDER BY idTransaksi DESC";
$dataTransaksi = querySelect($selectAll);

?>

<!DOCTYPE html>
<html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSS Booststrap -->
	<link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="css\style.css">

	<title>Data Transaksi (Admin)</title>
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
		<h1 class="display-5">Data Transaksi Madani Shop</h1>
	</div>
	<!-- End of Jumbotron -->

	<!-- Show Data transaksi -->
	<?php if ($dataTransaksi == 0) { ?>
		<p class="text-center fw-bold">Tidak ada data dalam database.</p>
	<?php } else { ?>
		<div class="container table-responsive justify-content-center">
			<table class="table text-center table-hover table-bordered border-dark">
				<thead class="bg-success" style="color: white;">
					<tr>
						<td scope="col">ID Transaksi</td>
						<td scope="col">ID Kasir</td>
						<td scope="col">Tanggal</td>
						<td scope="col">Jumlah Barang</td>
						<td scope="col">Total Harga</td>
						<td scope="col">Action</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($dataTransaksi as $data) : ?>
						<tr class="align-middle">
							<td scope="col"><?php echo $data['idTransaksi']; ?></td>
							<td scope="col"><?php echo $data['idKasir']; ?></td>
							<td scope="col"><?php echo $data['tanggalTransaksi']; ?></td>
							<td scope="col"><?php echo $data['jumlahBarang']; ?></td>
							<td scope="col"><?php echo $data['totalHarga']; ?></td>
							<td scope="col">
								<a href="detail-transaksi.php?idTransaksi=<?php echo $data['idTransaksi']; ?>" style="text-decoration: none;">
									<button class="btn btn-success" type="submit" style="font-size: 12px;">Detail</button>
								</a>
								<a href="hapus-transaksi.php?idTransaksi=<?php echo $data['idTransaksi']; ?>" style="text-decoration: none;" onclick="return confirm('Apakah anda yakin ingin menghapus data transaksi <?php echo $data['idTransaksi']; ?>?')">
									<button class="btn btn-danger" type="submit" style="font-size: 12px;">Hapus</button>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	<?php } ?>
	<!-- End of show data transaksi -->


	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>