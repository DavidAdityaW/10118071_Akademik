<?php
	// jquery ajax memerlukan pemanggilan semua koneksi
	// index.php
	// mencegah error saat redirect dengan fungsi header(location)
	ob_start();
	// include sekali controllers/koneksi.php dan models/database.php
	require_once('../controllers/koneksi.php');
	require_once('../models/database.php');
	$connection = new Database($host, $user, $pass, $database);

	// model_mahasiswa.php
	// include models/model_mahasiswa.php
	include "../models/model_mahasiswa.php";
	$mhs = new Mahasiswa($connection);

	$id_mhs = $_POST['id_mhs'];
	$nim = $connection->conn->real_escape_string($_POST['nim']);
	$nama_mhs = $connection->conn->real_escape_string($_POST['nama_mhs']);
	$jk = $connection->conn->real_escape_string($_POST['jk']);
	$agama = $connection->conn->real_escape_string($_POST['agama']);
	$tgl_lahir = $connection->conn->real_escape_string($_POST['tgl_lahir']);
	$no_telp = $connection->conn->real_escape_string($_POST['no_telp']);
	$alamat = $connection->conn->real_escape_string($_POST['alamat']);
	$kode_jsn = $connection->conn->real_escape_string($_POST['kode_jsn']);

	$mhs->edit("UPDATE tb_mahasiswa SET nim = '$nim', nama_mhs = '$nama_mhs', jk = '$jk', agama = '$agama', tgl_lahir = '$tgl_lahir', no_telp = '$no_telp', alamat = '$alamat', kode_jsn = '$kode_jsn' WHERE id_mhs = '$id_mhs'");
	// redirect
	echo "<script>window.location='?page=mahasiswa';</script>";
?>