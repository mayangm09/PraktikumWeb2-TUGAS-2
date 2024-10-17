<?php
require_once('database.php'); // Mengimpor file 'database.php' yang berisi koneksi ke database

// Membuat kelas LaporanKerjaLembur yang merupakan turunan dari kelas Database
class LaporanKerjaLembur extends Database {
    // Method untuk menampilkan semua data dari tabel 'laporan_kerja_lembur'
    function tampilkanData() {
        $query = "SELECT * FROM laporan_kerja_lembur"; // Query untuk mengambil semua data
        $data  = $this->koneksi->query($query); // Menggunakan koneksi dari superclass Database

        $hasil = []; // Inisialisasi array untuk menampung hasil
        if ($data && $data->num_rows > 0) { // Cek apakah ada data
            while ($row = $data->fetch_assoc()) { // Mengambil data sebagai array asosiatif
                $hasil[] = $row; // Menambahkan setiap row ke array hasil
            }
        }
        return $hasil; // Mengembalikan array hasil
    }
}

// Membuat objek dari kelas LaporanKerjaLembur dan memanggil method tampilkanData
$laporan       = new LaporanKerjaLembur(); 
$LaporanLembur = $laporan->tampilkanData(); // Menyimpan hasil dalam variabel $LaporanLembur

// Membuat kelas Selesai yang mewarisi LaporanKerjaLembur
class Selesai extends LaporanKerjaLembur {
    // Method untuk menampilkan data spesifik di mana 'uraian_pekerjaan' adalah 'Menyiapkan materi kuliah'
    function tampilkanData() {
        $query = "SELECT * FROM laporan_kerja_lembur WHERE keterangan = 'Selesai'"; // Query yang difilter
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

$selesai    = new Selesai(); 
$selesai_lembur = $selesai->tampilkanData(); 

// Membuat kelas Belum_Selesai yang mewarisi Selesai
class Belum_Selesai extends Selesai {
    // Method untuk menampilkan data spesifik di mana 'uraian_pekerjaan' adalah 'Menyusun Laporan Riset'
    function tampilkanData() {
        $query = "SELECT * FROM laporan_kerja_lembur WHERE keterangan = 'Belum Selesai'"; // Query yang difilter
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

// Membuat objek dari kelas riset dan memanggil method tampilkanData
$belum_selesai    = new Belum_Selesai(); 
$belum_lembur = $belum_selesai->tampilkanData(); // Menyimpan hasil dalam variabel $laporan_riset
?>
