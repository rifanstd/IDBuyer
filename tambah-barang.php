<?php 
// require files
require 'functions.php';

// cek apakah admin sudah login
if (!isset($_SESSION['isAdminLogin'])) {
	header("Location: login-admin.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<!-- CSS Booststrap -->
	<link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="css\style.css">

	<title>Tambah Barang (Admin)</title>
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
		<h1 class="display-5">Tambah Data Barang Madani Shop</h1>
	</div>
	<!-- End of Jumbotron -->

	<!-- Form tambah data barang -->
	<div class="container" style="max-width: 500px;">
		<form action="" method="post">
			<div class="mb-3">
				<label for="namaBarang" class="form-label">Nama Barang</label>
				<input type="text" class="form-control" id="namaBarang" name="namaBarang" placeholder="Inputkan nama barang disini!">
			</div>
			<div class="mb-3">
				<label for="jumlah" class="form-label">Jumlah</label>
				<input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Inputkan jumlah barang disini">
			</div>
			<div class="mb-3">
				<label for="harga" class="form-label">Harga (Rp)</label>
				<input type="number" min="1" class="form-control" id="harga" name="harga" placeholder="Inputkan harga barang disini">
			</div>
			<button type="submit" class="btn btn-success" name="submit-tambahkan">Tambahkan</button>
		</form>
	</div>
	<!-- End form -->

	<!-- Execute tambah barang -->
	<div class="container" style="max-width: 500px;">
		<?php if (isset($_POST['submit-tambahkan'])) { ?>
			<?php 
			if (empty($_POST['namaBarang']) || empty($_POST['jumlah']) || empty($_POST['harga'])) {
				echo "
				<script>
				alert('Tidak boleh ada field yang kosong. Gagal menambahkan data!');
				document.location.href = 'tambah-barang.php';
				</script>
				";
			} else {
				if (tambahBarang($_POST) != 0){
					echo "
					<script>
					alert('Data berhasil ditambahkan!');
					document.location.href = 'data-barang.php';
					</script>
					";
				} elseif (tambahBarang($_POST) == 0) {
					echo "
					<script>
					alert('Barang dengan nama tersebut sudah ada di database. Silahkan lakukan pengeditan di halaman Data Barang jika ingin menubah data. Data gagal ditambahkan!');
					document.location.href = 'tambah-barang.php';
					</script>
					";
				}
			}
			?>
		<?php } ?>
	</div>
	<!-- end of execute -->




	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>
</html>