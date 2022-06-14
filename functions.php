<?php
// start session
session_start();

// connect to db
$conn = mysqli_connect("localhost", "root", "", "id_buyer");

// functions show data transaksi
function querySelect($query){
	global $conn;

	$result = mysqli_query($conn, $query);

	$rows = [];

	// Check if table is none data
	if (mysqli_num_rows($result) == 0) {
		return 0;
	}
	else {
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		return $rows;
	}
}

// Function insert
function queryInsertTransaksi($data, $id){
	global $conn;

	$idTransaksi = $id;
	$idBarang = $data['list-barang'];
	$namaBarang = querySelect("SELECT namaBarang FROM barang WHERE idBarang = '$idBarang'")[0]['namaBarang'];
	$jumlahBarang = (int)$data['jumlah'];

	$dataHargaBarang = querySelect("SELECT hargaBarang FROM barang WHERE idBarang = '$idBarang'");
	$hargaBarang = $jumlahBarang * (int)$dataHargaBarang[0]["hargaBarang"];

	$oldData = querySelect("SELECT * FROM detail_transaksi WHERE idBarang = '$idBarang' AND idTransaksi = '$idTransaksi'");

	if ($oldData > 0){
		$jumlahBarangNew = $jumlahBarang + (int)$oldData[0]["jumlahBarang"];
		$hargaBarangNew  = ($hargaBarang/$jumlahBarang) * $jumlahBarangNew;
		mysqli_query($conn, "UPDATE detail_transaksi SET jumlahBarang = '$jumlahBarangNew', hargaBarang = $hargaBarangNew WHERE idBarang = '$idBarang' AND idTransaksi = '$idTransaksi'");

		$jumlahBeliSementara = $jumlahBarangNew;
		$_SESSION['jumlahBeliSementara'] = $jumlahBeliSementara;
		$stokBarangSementara = (int)querySelect("SELECT stokBarang FROM barang WHERE idBarang = '$idBarang'")[0]['stokBarang'] - $jumlahBeliSementara;
		mysqli_query($conn, "UPDATE FROM barang SET stokBarang = '$stokBarangSementara' WHERE idBarang = '$idBarang'");
		return 1;
	}

	$sqlInsert = "INSERT INTO detail_transaksi VALUES('', '$idTransaksi', '$idBarang', '$namaBarang', '$jumlahBarang', '$hargaBarang')";

	mysqli_query($conn, $sqlInsert);

	$jumlahBeliSementara = $jumlahBarang;
	$_SESSION['jumlahBeliSementara'] = $jumlahBeliSementara;
	$stokBarangSementara = (int)querySelect("SELECT stokBarang FROM barang WHERE idBarang = '$idBarang'")[0]['stokBarang'] - $jumlahBeliSementara;
	mysqli_query($conn, "UPDATE barang SET stokBarang = '$stokBarangSementara' WHERE idBarang = '$idBarang'");

	return mysqli_affected_rows($conn);
}

// Function login
function loginKasir($data){
	global $conn;

	$username = $data["username"];
	$password = md5($data["password"]);

	$cekUsernameExist = mysqli_query($conn, "SELECT usernameKasir,passwordKasir FROM kasir WHERE usernameKasir = '$username'");

	// check apakah username ada
	if (mysqli_num_rows($cekUsernameExist) === 1) {
		$row = mysqli_fetch_assoc($cekUsernameExist);

		// check username
		if ($row["passwordKasir"] === $password) {
			return 1;
		}
		else {
			return -1;
		}
	}
	else {
		return 0;
	}
}

// Function login
function loginAdmin($data){
	global $conn;

	$username = $data["username"];
	$password = md5($data["password"]);

	$cekUsernameExist = mysqli_query($conn, "SELECT usernameAdmin,passwordAdmin FROM admin WHERE usernameAdmin = '$username'");

	// check apakah username ada
	if (mysqli_num_rows($cekUsernameExist) === 1) {
		$row = mysqli_fetch_assoc($cekUsernameExist);

		// check username
		if ($row["passwordAdmin"] === $password) {
			return 1;
		}
		elseif (password_verify($password, $row["passwordAdmin"])){
			return 2;
		}
		else {
			return -1;
		}
	}
	else {
		return 0;
	}
}

// Function tambah barang
function tambahBarang($data){
	global $conn;

	$namaBarang = htmlspecialchars($data['namaBarang']);
	$jumlahBarang = (int)$data['jumlah'];
	$hargaBarang = $data['harga'];

	// cek apakah barang sudah ada
	$barangSudahAda = querySelect("SELECT * FROM barang WHERE namaBarang LIKE '%$namaBarang%'");

	// kalau sudah ada
	if ($barangSudahAda != 0){
		return 0;
	}

	mysqli_query($conn, "INSERT INTO barang VALUES('', '$namaBarang', '$jumlahBarang', '$hargaBarang')");

	return mysqli_affected_rows($conn);
}

// function edit barang
function editBarang($data, $idBarang){
	global $conn;

	$namaBarang = $data['namaBarang'];
	$jumlahBarang = $data['jumlah'];
	$hargaBarang = $data['harga'];

	mysqli_query($conn, "UPDATE barang SET 
		namaBarang = '$namaBarang', 
		stokBarang = '$jumlahBarang', 
		hargaBarang = '$hargaBarang' 
		WHERE idBarang = '$idBarang'");

	return mysqli_affected_rows($conn);
}

// function hapus Data Barang
function hapusbarang($idBarang){
	global $conn;

	mysqli_query($conn, "DELETE FROM barang WHERE idBarang = '$idBarang'");

	return mysqli_affected_rows($conn);
}

// function hapus transaksi
function hapusTransaksi($idTransaksi){
	global $conn;

	mysqli_query($conn, "DELETE FROM transaksi WHERE idTransaksi = '$idTransaksi'");
	mysqli_query($conn, "DELETE FROM detail_transaksi WHERE idTransaksi = '$idTransaksi'");

	return mysqli_affected_rows($conn);
}

// function tambahAdmin
function tambahAdmin($data){
	global $conn;

	$nama = htmlspecialchars(stripslashes($data['nama']));
	$username = stripslashes($data['username']);
	$password = md5($data['password']);

	// cek apakah username sudah ada
	$cekUsernameExist = querySelect("SELECT usernameAdmin FROM admin WHERE usernameAdmin = '$username'");

	if ($cekUsernameExist != 0) {
		return 0;
	}

	mysqli_query($conn, "INSERT INTO admin VALUES('', '$nama', '$username', '$password')");

	return mysqli_affected_rows($conn);
}

// function tambahKasir
function tambahKasir($data){
	global $conn;

	$nama = htmlspecialchars(stripslashes($data['nama']));
	$username = stripslashes($data['username']);
	$password = md5($data['password']);
	// cek apakah username sudah ada
	$cekUsernameExist = querySelect("SELECT usernameKasir FROM kasir WHERE usernameKasir = '$username'");

	if ($cekUsernameExist != 0) {
		return 0;
	}

	mysqli_query($conn, "INSERT INTO kasir VALUES('', '$nama', '$username', '$password')");

	return mysqli_affected_rows($conn);
}

?>