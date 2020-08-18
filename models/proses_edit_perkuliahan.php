<?php
	// jquery ajax memerlukan pemanggilan semua koneksi
	// index.php
	// mencegah error saat redirect dengan fungsi header(location)
	ob_start();
	// include sekali controllers/koneksi.php dan models/database.php
	require_once('../controllers/koneksi.php');
	require_once('../models/database.php');
	$connection = new Database($host, $user, $pass, $database);

	// model_perkuliahan.php
	// include models/model_perkuliahan.php
	include "../models/model_perkuliahan.php";
	$pk = new Perkuliahan($connection);

	$id_pk = $_POST['id_pk'];
	$tgl_pk = $connection->conn->real_escape_string($_POST['tgl_pk']);
	$nim = $connection->conn->real_escape_string($_POST['nim']);
	$kode_mk = $connection->conn->real_escape_string($_POST['kode_mk']);
	$nip = $connection->conn->real_escape_string($_POST['nip']);

	$pk->edit("UPDATE tb_perkuliahan SET tgl_pk = '$tgl_pk', nim = '$nim', kode_mk = '$kode_mk', nip = '$nip' WHERE id_pk = '$id_pk'");
	// redirect
	echo "<script>window.location='?page=perkuliahan';</script>";
?>