<?php
require_once('database.php'); // Mengimpor file 'database.php' yang berisi koneksi ke database

// Membuat kelas Penggantian Pengawas yang merupakan turunan dari kelas Database
class Penggantian_Pengawas extends Database {
    function tampilkanData() { // Method untuk menampilkan data penggantian pengawas ujian
        $query = "SELECT * FROM penggantian_pengawasan_ujian";
        $data  = $this->koneksi->query($query); // Menggunakan koneksi dari superclass

        $hasil = []; // Inisialisasi array hasil
        if ($data && $data->num_rows > 0) { // Cek apakah ada data
            while ($row = $data->fetch_assoc()) { // Mengambil data sebagai array asosiatif
                $hasil[] = $row; // Menambahkan setiap row ke array hasil
            }
        }
        return $hasil; // Mengembalikan hasil
    }
}

// Kode pengujian
$pengawas = new Penggantian_Pengawas(); // Membuat objek dari kelas LaporanKerjaLembur
$pengawas_ujian = $pengawas->tampilkanData(); // Mengambil data laporan

// Menampilkan data laporan
// echo "<pre>";
// print_r($dataLaporan); // Menampilkan data laporan
// echo "</pre>";
?>
