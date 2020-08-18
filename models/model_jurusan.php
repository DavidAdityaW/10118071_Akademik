<?php 
	class Jurusan {
		// deklasrasi objek/variabel
		private $mysqli;

		// fungsi yang otomatis diload pertama kali oleh kelas
		function __construct($conn) {
			$this->mysqli = $conn;
		}

		// fungsi tampil data jurusan
		public function tampil($id = null) {
			$db = $this->mysqli->conn;
			$sql = "SELECT * FROM tb_jurusan";
			if($id != null) {
				$sql .= " WHERE kode_jsn = $id";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}

		// fungsi tambah data jurusan
		public function tambah($kode_jsn, $nama_jsn) {
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO tb_jurusan VALUES('$kode_jsn', '$nama_jsn')") or die ($db_error);
		}

		// fungsi edit data jurusan
		public function edit($sql) {
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db_error);
		}

		// fungsi hapus data jurusan
		public function hapus($id) {
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM tb_jurusan WHERE kode_jsn = '$id'") or die ($db_error);
		}

		// fungsi yang otomatis dipanggil terakhir kali setelah semua fungsi dalam kelas dijalankan / penutup koneksi
		function __destruct() {
			$db = $this->mysqli->conn;
			$db->close();
		}
	}
?>