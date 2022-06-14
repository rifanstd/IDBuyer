<?php 
// require files
require 'functions.php';

// cek apakah admin/kasir sudah login
if (isset($_SESSION['isAdminLogin'])) {
	header("Location: data-barang.php");
} elseif (isset($_SESSION['isKasirLogin'])){
	header("Location: tambah-transaksi.php");
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
	<link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">

	<title>User Login</title>
</head>
<body>

	<!-- Jumbotron -->
	<div class="jumbotron mt-5 text-center">
		<h1 class="display-4">User Login</h1>
		<p class="lead">Sikahkan pilih jenis user untuk login!</p>
		<hr class="my-4">
	</div>
	<!-- End of Jumbotron -->

	<!-- container pilih jenis login -->
	<div class="container mt-5" style="max-width: 1000px;">
		<div class="row d-flex justify-content-center text-center">
			<div class="col-lg">
				<a href="login-admin.php">
					<img src="img/admin-user.png" alt="" style="width: 50%;">
				</a>
			</div>
			<div class="col-lg mt-3 mt-lg-0">
				<a href="login-kasir.php">
					<img src="img/kasir-user.png" alt="" style="width: 50%;">
				</a>
			</div>

		</div>
	</div>
	<!-- end of pilih jenis login -->

	<!-- Javascript Bootstrap -->
	<script src="bootstrap\js\bootstrap.min.js"></script>
</body>
</html>