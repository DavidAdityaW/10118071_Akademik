<?php
	// jquery ajax memerlukan pemanggilan semua koneksi
	// index.php
	// mencegah error saat redirect dengan fungsi header(location)
	ob_start();
	// include sekali controllers/koneksi.php dan models/database.php
	require_once('../controllers/koneksi.php');
	require_once('../models/database.php');
	$connection = new Database($host, $user, $pass, $database);

	// model_matakuliah.php
	// include models/model_matakuliah.php
	include "../models/model_matakuliah.php";
	$mk = new Matakuliah($connection);

	$kode_mk = $_POST['kode_mk'];
	$nama_mk = $connection->conn->real_escape_string($_POST['nama_mk']);
	$sks = $connection->conn->real_escape_string($_POST['sks']);
	$semester = $connection->conn->real_escape_string($_POST['semester']);

	$mk->edit("UPDATE tb_matakuliah SET kode_mk = '$kode_mk', nama_mk = '$nama_mk', sks = '$sks', semester = '$semester' WHERE kode_mk = '$kode_mk'");
	// redirect
	echo "<script>window.location='?page=matakuliah';</script>";
?>