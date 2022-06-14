<?php 
// require files
require 'functions.php';

// cek apakah kasir belum login
if (!isset($_SESSION['isKasirLogin'])){
	header("Location: login-kasir.php");
} elseif (isset($_SESSION['isKasirLogin']) && isset($_SESSION['idKasirSession'])) {
	$idKasirSession = $_SESSION['idKasirSession'];
}


if (querySelect("SELECT * FROM transaksi") > 0) {
	// get indeks terakhir data transaksi
	$getLastIndex = (int)querySelect("SELECT idTransaksi FROM transaksi ORDER BY idTransaksi DESC LIMIT 1")[0]["idTransaksi"]+1;
}
else {
	$getLastIndex = 1;
}

// select data barang
$dataBarang = querySelect("SELECT * FROM barang");

// cek tombol simpan di klik atau belum
if((!isset($_POST["submit-simpan"]) && !isset($_POST["submit-add"])) || isset($_POST["submit-batal"])) {
	if (isset($_SESSION['jumlahBeliSementara'])) {
		$jumlahBeliSementara = $_SESSION['jumlahBeliSementara'];
	}
	$idTransaksi = $getLastIndex;
	$dataGagalTransaksi = querySelect("SELECT * FROM detail_transaksi WHERE idTransaksi = '$getLastIndex'");

	if ($dataGagalTransaksi != 0) {
		foreach ($dataGagalTransaksi as $data) {
			$idBarang = $data['idBarang'];
			$stokBarangNow = (int)querySelect("SELECT stokBarang FROM barang WHERE idBarang = '$idBarang'")[0]['stokBarang'];
			$stokBarangThen = $stokBarangNow + $jumlahBeliSementara;
			mysqli_query($conn, "UPDATE barang SET stokBarang = '$stokBarangThen' WHERE idBarang = '$idBarang'");
		}
	}
	mysqli_query($conn, "DELETE FROM detail_transaksi WHERE idTransaksi = '$getLastIndex'");
}

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

	<title>Tambah Transaksi</title>
</head>
<body>
	<!-- section nav bar -->
	<section>
		<nav class="navbar navbar-expand-lg navbar-dark bg-success">
			<div class="container">
				<span class="navbar-brand" href="index.php">IDBuyer (Kasir)</span>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
						<li class="nav-item">
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
		<h1 class="display-5">Sistem Informasi Penjualan Madani Shop</h1>
		<h2 class="display-5 fs-1">ID Transaksi : <?php echo $getLastIndex; ?></h2>
	</div>
	<!-- End of Jumbotron -->

	<!-- Tambah Barang -->
	<div class="container-md p-5">
		<div class="row mt-3">
			<span>Tanggal : <?php echo date("d-m-Y"); ?></span>
		</div>
		<div class="row mt-3">
			<form action="" method="post" class="d-flex">
				<div class="col-6 d-flex me-4">
					<select name="list-barang" class="form-select">
						<option value="" selected hidden>Cari Barang ...</option>
						<?php foreach ($dataBarang as $data) : ?>
							<option value="<?php echo $data["idBarang"];?>"><?php echo $data["namaBarang"]?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-4 d-flex me-2">
					<input type="number" min='1' class="form-control" id="jumlah" aria-describedby="jumlah" name="jumlah" placeholder="Jumlah Barang">
				</div>
				<div class="col-2 ms-auto">
					<button type="submit" name="submit-add" class="btn btn-success me-auto">Tambah</button>
				</div>
			</form>
		</div>
		
		<div class="row mt-3">
			<div class="col">
				<table class="table text-center table-hover table-bordered border-dark">
					<thead class="bg-thead" style="color: black;">
						<tr>
							<th scope="col">ID Barang</th>
							<th scope="col">Nama</th>
							<th scope="col">Jumlah</th>
							<th scope="col">Harga(Rp)</th>
						</tr>
					</thead>
					<?php if(isset($_POST["submit-add"])) { ?>
						<?php if (!empty($_POST["list-barang"] && !empty($_POST["jumlah"]))) { ?>
							<?php 
							$jumlahBarangPilih = (int)$_POST['jumlah'];
							$idBarangPilih = (int)$_POST['list-barang'];
							$namaBarangPilih = querySelect("SELECT namaBarang FROM barang WHERE idBarang = '$idBarangPilih'")[0]['namaBarang'];
							$stokBarangPilih = (int)querySelect("SELECT stokBarang FROM barang WHERE idBarang = '$idBarangPilih'")[0]['stokBarang'];
							?>
							<?php if ($jumlahBarangPilih > $stokBarangPilih) { ?>
								<p>Stok barang tidak cukup. Sisa stok <?php echo $namaBarangPilih.' : '.$stokBarangPilih; ?></p>
								<?php $dataDetailTransaksi = querySelect("SELECT * FROM detail_transaksi WHERE idTransaksi = '$getLastIndex' ORDER BY idDetailTransaksi DESC");?>
								<?php if($dataDetailTransaksi != 0) { ?>
									<tbody>
										<?php foreach ($dataDetailTransaksi as $data) : ?>
											<?php $idBarang = $data['idBarang']; ?>
											<tr class="align-middle">
												<td scope="col"><?php echo $data['idBarang']; ?></td>
												<td scope="col"><?php echo $data['namaBarang']; ?></td>
												<td scope="col"><?php echo $data['jumlahBarang']; ?></td>
												<td scope="col"><?php echo $data['hargaBarang']; ?></td>
											</tr>
										<?php endforeach; ?>
										<tr class="align-middle">
											<?php $totalHarga = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(hargaBarang) FROM detail_transaksi WHERE idTransaksi = '$getLastIndex'"));?>
											<td scope="col" colspan="4">
												<?php echo 'Total Harga(Rp) : '.$totalHarga[0];?>
											</td>
										</tr>
									</tbody>
								<?php } ?>
							<?php } else { ?>
								<?php if(queryInsertTransaksi($_POST, $getLastIndex) > 0) { ?>
									<?php $dataDetailTransaksi = querySelect("SELECT * FROM detail_transaksi WHERE idTransaksi = '$getLastIndex' ORDER BY idDetailTransaksi DESC");?>
									<?php if($dataDetailTransaksi != 0) { ?>
										<tbody>
											<?php foreach ($dataDetailTransaksi as $data) : ?>
												<?php $idBarang = $data['idBarang']; ?>
												<tr class="align-middle">
													<td scope="col"><?php echo $data['idBarang']; ?></td>
													<td scope="col"><?php echo $data['namaBarang']; ?></td>
													<td scope="col"><?php echo $data['jumlahBarang']; ?></td>
													<td scope="col"><?php echo $data['hargaBarang']; ?></td>
												</tr>
											<?php endforeach; ?>
											<tr class="align-middle">
												<?php $totalHarga = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(hargaBarang) FROM detail_transaksi WHERE idTransaksi = '$getLastIndex'"));?>
												<td scope="col" colspan="4">
													<?php echo 'Total Harga(Rp) : '.$totalHarga[0];?>
												</td>
											</tr>
										</tbody>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						<?php } else { ?>
							<?php $dataDetailTransaksi = querySelect("SELECT * FROM detail_transaksi WHERE idTransaksi = '$getLastIndex' ORDER BY idDetailTransaksi DESC");?>
							<?php if($dataDetailTransaksi != 0) { ?>
								<tbody>
									<?php foreach ($dataDetailTransaksi as $data) : ?>
										<?php $idBarang = $data['idBarang']; ?>
										<tr class="align-middle">
											<td scope="col"><?php echo $data['idBarang']; ?></td>
											<td scope="col"><?php echo $data['namaBarang']; ?></td>
											<td scope="col"><?php echo $data['jumlahBarang']; ?></td>
											<td scope="col"><?php echo $data['hargaBarang']; ?></td>
										</tr>
									<?php endforeach; ?>
									<tr class="align-middle">
										<?php $totalHarga = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(hargaBarang) FROM detail_transaksi WHERE idTransaksi = '$getLastIndex'"));?>
										<td scope="col" colspan="4">
											<?php echo 'Total Harga(Rp) : '.$totalHarga[0];?>
										</td>
									</tr>
								</tbody>
							<?php } ?>
						<?php } ?>
					<?php } ?>
				</table>
			</div>
		</div>
		<div class="row mt-1">
			<div class="col">
				<a href="tambah-transaksi.php">
					<form action="" method="post">
						<button type="submit" name="submit-simpan" class="btn btn-success me-auto">Simpan</button>
					</form>
				</a>
			</div>
			<div class="col d-flex justify-content-end">
				<a href="tambah-transaksi.php">
					<form action="" method="post">
						<button type="submit" name="submit-batal" class="btn btn-danger me-auto">Batalkan</button>
					</form>
				</a>
			</div>
			<?php 
			if (isset($_POST["submit-simpan"])) {
				$dataDetailTransaksiNew = querySelect("SELECT * FROM detail_transaksi WHERE idTransaksi = '$getLastIndex'");

				if ($dataDetailTransaksiNew > 0) {
					$totalJumlahBarang = 0;
					$totalHargaBarang = 0;

					$tanggal = date("Y-m-d");

					foreach ($dataDetailTransaksiNew as $data) {
						$totalJumlahBarang += $data['jumlahBarang'];
						$totalHargaBarang += $data['hargaBarang'];
					}

					mysqli_query($conn, "INSERT INTO transaksi VALUES('', '$idKasirSession', '$tanggal', '$totalJumlahBarang', '$totalHargaBarang')");

					echo "
					<script>
					alert('Data transaksi berhasil ditambahkan');
					document.location.href = 'tambah-transaksi.php';
					</script>
					";
				}
				// header("Location: tambah-transaksi.php");
				exit;
			} elseif (isset($_POST["submit-batal"])){
				echo "
				<script>
				alert('Transaksi dibatalkan!');
				document.location.href = 'tambah-transaksi.php';
				</script>
				";
				exit;
			}
			?>
		</div>
	</div>
	<!-- End of tambah barang -->

	<!-- Javascript Bootstrap -->
	<script src="bootstrap\js\bootstrap.min.js"></script>
</body>
</html>