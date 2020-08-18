<?php
	// jquery ajax memerlukan pemanggilan semua koneksi
	// index.php
	// mencegah error saat redirect dengan fungsi header(location)
	ob_start();
	// include sekali controllers/koneksi.php dan models/database.php
	require_once('../controllers/koneksi.php');
	require_once('../models/database.php');
	$connection = new Database($host, $user, $pass, $database);

	// model_jurusan.php
	// include models/model_jurusan.php
	include "../models/model_jurusan.php";
	$jsn = new Jurusan($connection);

	$kode_jsn = $_POST['kode_jsn'];
	$nama_jsn = $connection->conn->real_escape_string($_POST['nama_jsn']);

	$jsn->edit("UPDATE tb_jurusan SET kode_jsn = '$kode_jsn', nama_jsn = '$nama_jsn' WHERE kode_jsn = '$kode_jsn'");
	// redirect
	echo "<script>window.location='?page=jurusan';</script>";
?>