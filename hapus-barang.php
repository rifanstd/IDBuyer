<?php 
// require files
require 'functions.php';


// cek apakah admin sudah login
if (!isset($_SESSION['isAdminLogin'])) {
	header("Location: login-admin.php");
}

// ambil data barang yang mau di hapus
$idBarang = $_GET['idBarang'];

if (hapusBarang($idBarang) > 0) {
	echo "
	<script>
	alert('Data berhasil dihapus');
	document.location.href = 'data-barang.php';
	</script>
	";
}
else  {
	echo "
	<script>
	alert('Gagal menghapus data!');
	document.location.href = 'data-barang.php';
	</script>
	";
}

?>