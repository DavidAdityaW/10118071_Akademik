<?php 
	class Perkuliahan {
		// deklasrasi objek/variabel
		private $mysqli;

		// fungsi yang otomatis diload pertama kali oleh kelas
		function __construct($conn) {
			$this->mysqli = $conn;
		}

		// fungsi tampil data perkuliahan
		public function tampil($id = null) {
			$db = $this->mysqli->conn;
			$sql = "SELECT * FROM tb_perkuliahan";
			if($id != null) {
				$sql .= " WHERE id_pk = $id";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}

		// fungsi tambah data perkuliahan
		public function tambah($tgl_pk, $nim, $kode_mk, $nip) {
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO tb_perkuliahan VALUES('', '$tgl_pk', '$nim', '$kode_mk', '$nip')") or die ($db_error);
		}

		// fungsi edit data perkuliahan
		public function edit($sql) {
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db_error);
		}

		// fungsi hapus data perkuliahan
		public function hapus($id) {
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM tb_perkuliahan WHERE id_pk = '$id'") or die ($db_error);
		}

		// fungsi yang otomatis dipanggil terakhir kali setelah semua fungsi dalam kelas dijalankan / penutup koneksi
		function __destruct() {
			$db = $this->mysqli->conn;
			$db->close();
		}
	}
?>