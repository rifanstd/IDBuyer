<?php 
// require files
require 'functions.php';

// cek apakah admin sudah login
if (!isset($_SESSION['isAdminLogin'])) {
	header("Location: login-admin.php");
}

// ambil data transaksi yang mau di hapus
$idTransaksi = $_GET['idTransaksi'];

if (hapusTransaksi($idTransaksi) > 0) {
	echo "
	<script>
	alert('Data berhasil dihapus');
	document.location.href = 'data-transaksi.php';
	</script>
	";
}
else  {
	echo "
	<script>
	alert('Gagal menghapus data!');
	document.location.href = 'data-transaksi.php';
	</script>
	";
}


?>