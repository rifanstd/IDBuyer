<?php 
// require files
require 'functions.php';

// cek apakah kasir sudah login
if (isset($_SESSION['isKasirLogin'])){
    if ($_SESSION['isKasirLogin']) {
	    header("Location: tambah-transaksi.php");
    }
}

?>

<!DOCTYPE html>
<html>
<html lang="">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSS Booststrap -->
	<link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="css\style.css">

	<title>Login Kasir</title>
</head>
<body class="body-login">

	<!-- Login -->
	<div class="container mt-5 login">
		<div class="row text-center">
			<div class="col">
				<h1>LOGIN KASIR</h1>
			</div>
		</div>
		<form action="" method="post">
			<div class="mb-3 text-center">
				<span>Untuk login sebagai kasir, silahkan login sebagai admin terlebih dahulu dan buat akun kasir anda sendiri.</span>
			</div>
			<div class="mb-3">
				<label for="username" class="form-label">Username</label>
				<input type="text" class="form-control" id="username" name="username" placeholder="Inputkan username anda!">
			</div>
			<div class="mb-3">
				<label for="password" class="form-label">Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Inputkan password anda!">
			</div>
			<div class="d-flex justify-content-center">
				<button type="submit" class="btn btn-success" name="submit-login">Login</button>
			</div>
		</form>
		<p class="text-center mt-2"><a href="login-admin.php">Login sebagai admin</a></p>
	</div>
	<!-- End of Login -->

	<!-- execute -->
	<div class="container text-center">
		<?php if (isset($_POST["submit-login"])) { ?>
			<?php $username = $_POST['username'] ?>
			
			<?php if(loginKasir($_POST) > 0 ) { ?>
			    <?php
				$idKasir = querySelect("SELECT idKasir FROM kasir WHERE usernameKasir = '$username'")[0]['idKasir'];
				$_SESSION['isKasirLogin'] = true;
				$_SESSION['idKasirSession'] = $idKasir;
				
				echo "
				<script>
				alert('Berhasil login');
				document.location.href = 'tambah-transaksi.php';
				</script>
				";
				
				exit;
				?>
			<?php } elseif(loginKasir($_POST) === 0) { ?>
				<p style="color: red; font-weight: bold;">Username yang anda masukkan salah!</p>
			<?php } elseif(loginKasir($_POST) === (-1)) { ?>
				<p style="color: red; font-weight: bold;">Password yang anda masukkan salah!</p>
			<?php } ?>
		<?php } ?>
	</div>
	<!-- end of execute -->

	<!-- Javascript Bootstrap -->
	<script src="bootstrap\js\bootstrap.min.js"></script>
</body>
</html>