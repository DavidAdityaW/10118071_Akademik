<?php 
	class Matakuliah {
		// deklasrasi objek/variabel
		private $mysqli;

		// fungsi yang otomatis diload pertama kali oleh kelas
		function __construct($conn) {
			$this->mysqli = $conn;
		}

		// fungsi tampil data matakuliah
		public function tampil($id = null) {
			$db = $this->mysqli->conn;
			$sql = "SELECT * FROM tb_matakuliah";
			if($id != null) {
				$sql .= " WHERE kode_mk = $id";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}

		// fungsi tambah data matakuliah
		public function tambah($kode_mk, $nama_mk, $sks, $semester) {
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO tb_matakuliah VALUES('$kode_mk', '$nama_mk', '$sks', '$semester')") or die ($db_error);
		}

		// fungsi edit data matakuliah
		public function edit($sql) {
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db_error);
		}

		// fungsi hapus data matakuliah
		public function hapus($id) {
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM tb_matakuliah WHERE kode_mk = '$id'") or die ($db_error);
		}

		// fungsi yang otomatis dipanggil terakhir kali setelah semua fungsi dalam kelas dijalankan / penutup koneksi
		function __destruct() {
			$db = $this->mysqli->conn;
			$db->close();
		}
	}
?>