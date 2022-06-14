<?php 
// require files
require 'functions.php';



?>

<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSS Booststrap -->
	<link href="bootstrap\css\bootstrap.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="css\style.css">

	<title>Tambah Kasir</title>
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
		<h1 class="display-5">Tambah Data Kasir Madani Shop</h1>
	</div>
	<!-- End of Jumbotron -->

	<!-- Form tambah data barang -->
	<div class="container" style="max-width: 500px;">
		<form action="" method="post">
			<div class="mb-3">
				<label for="nama" class="form-label">Nama</label>
				<input type="text" class="form-control" id="nama" name="nama" placeholder="Inputkan nama kasir disini!">
			</div>
			<div class="mb-3">
				<label for="username" class="form-label">Username</label>
				<input type="text" class="form-control" id="username" name="username" placeholder="Inputkan username disini!">
			</div>
			<div class="mb-3">
				<label for="password" class="form-label">Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Inputkan password disini!">
			</div>
			<div class="mb-3">
				<label for="confirm-password" class="form-label">Confirm Password</label>
				<input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Inputkan konfirmasi password disini!">
			</div>
			<button type="submit" class="btn btn-success" name="submit-tambahkan">Tambahkan</button>
		</form>
	</div>
	<!-- End form -->

	<!-- execute -->
	<?php
	if (isset($_POST['submit-tambahkan'])) {
		if (empty($_POST['nama']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['confirm-password'])) {
			echo "
			<script>
			alert('Tidak boleh ada field yang kosong. Gagal menambahkan data!');
			document.location.href = 'tambah-kasir.php';
			</script>
			";
		} else {
			if ($_POST['password'] != $_POST['confirm-password']) {
				echo "
				<script>
				alert('Password dan Konfirmasi Password harus sama persis! Tidak boleh berbeda! Gagal menambahkan data!');
				document.location.href = 'tambah-kasir.php';
				</script>
				";
			}
			else {
				if (tambahKasir($_POST) > 0) {
					echo "
					<script>
					alert('Berhasil menambahkan data kasir!');
					document.location.href = 'tambah-kasir.php';
					</script>
					";
				}
				else {
					echo "
					<script>
					alert('Gagal menambahkan data kasir!');
					document.location.href = 'tambah-admin.php';
					</script>
					";
				}
			}
		}
	}


	?>
	<!-- end of execute -->



	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>
</html>