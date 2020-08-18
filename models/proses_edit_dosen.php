<?php
	// jquery ajax memerlukan pemanggilan semua koneksi
	// index.php
	// mencegah error saat redirect dengan fungsi header(location)
	ob_start();
	// include sekali controllers/koneksi.php dan models/database.php
	require_once('../controllers/koneksi.php');
	require_once('../models/database.php');
	$connection = new Database($host, $user, $pass, $database);

	// model_dosen.php
	// include models/model_dosen.php
	include "../models/model_dosen.php";
	$dsn = new Dosen($connection);

	$id_dsn = $_POST['id_dsn'];
	$nip = $connection->conn->real_escape_string($_POST['nip']);
	$nama_dsn = $connection->conn->real_escape_string($_POST['nama_dsn']);
	$jk = $connection->conn->real_escape_string($_POST['jk']);
	$agama = $connection->conn->real_escape_string($_POST['agama']);
	$tgl_lahir = $connection->conn->real_escape_string($_POST['tgl_lahir']);
	$no_telp = $connection->conn->real_escape_string($_POST['no_telp']);
	$alamat = $connection->conn->real_escape_string($_POST['alamat']);

	$dsn->edit("UPDATE tb_dosen SET nip = '$nip', nama_dsn = '$nama_dsn', jk = '$jk', agama = '$agama', tgl_lahir = '$tgl_lahir', no_telp = '$no_telp', alamat = '$alamat' WHERE id_dsn = '$id_dsn'");
	// redirect
	echo "<script>window.location='?page=dosen';</script>";
?>