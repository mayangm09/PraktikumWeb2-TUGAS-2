# PraktikumWeb2-TUGAS 2

<b>Implementasi CRUD dengan menggunakan PHP OOP </b>  
Implementasi CRUD menggunakan PHP OOP melibatkan pemanfaatan konsep Object-Oriented Programming (OOP) dalam mengelola operasi Create, Read, Update, dan Delete pada database. Dalam pendekatan ini, kita memisahkan logika menjadi kelas-kelas dan metode-metode, sehingga lebih terstruktur dan mudah dikelola.

---
**Contoh Study Kasus :** <br>
ERD :
![ERD Persuratan Dosen drawio](https://github.com/user-attachments/assets/9f375f9f-e526-4605-b4c9-b72c8b0d414e)

1. Create an OOP-based View, by retrieving data from the MySQL database 
2. Use the _construct as a link to the database 
3. Apply encapsulation according to the logic of the case study 
4. Create a derived class using the concept of inheritance 
5. Apply polymorphism for at least 2 roles according to the case study

**Penyelesaian :** <br>

<b>1. Membuat file Database </b>
![image](https://github.com/user-attachments/assets/77970cc4-0d58-40fd-b342-0fbc292921cb)

   ```
   <?php

    class Database {
    // Deklarasi atribut untuk koneksi database
    private $host = "localhost";  // Nama host database
    private $username = "root";   // Username untuk akses database
    private $pass = "";           // Password untuk akses database (kosong untuk default)
    private $db = "persuratan";   // Nama database yang akan digunakan
    protected $koneksi; // Ubah menjadi protected agar bisa diakses dari subclass

    // Constructor untuk menghubungkan ke database menggunakan MySQLi
    function __construct() {
        // Membuat koneksi ke database dengan menggunakan atribut yang sudah didefinisikan
        $this->koneksi = new mysqli($this->host, $this->username, $this->pass, $this->db);

        // Cek apakah koneksi berhasil
        if ($this->koneksi->connect_error) {
            // Jika terjadi error, tampilkan pesan dan hentikan eksekusi
            die("Koneksi gagal: " . $this->koneksi->connect_error);
        }
    }

    // Method untuk mengambil koneksi yang sudah dibuat
    public function getConnection() {
        return $this->koneksi;  // Mengembalikan objek koneksi MySQLi
    }

    // Method kosong yang bisa di-override oleh subclass untuk menampilkan data
    function tampilkanData() {
        // Kosongkan, akan diimplementasikan di subclass
    }
    }
    ?>
   ```
- Propeties Kelas : <br>
private $host: Menyimpan nama host database (dalam hal ini localhost). <br>
private $username: Menyimpan username untuk mengakses database (root). <br>
private $pass: Menyimpan password untuk akses (kosong karena default MySQL tidak memiliki password). <br>
private $db: Menyimpan nama database yang akan digunakan (persuratan). <br>
protected $koneksi: Menyimpan objek koneksi ke database yang dapat diakses oleh subclass (karena protected).
- Script ini membuat sebuah **kelas `Database`** yang berfungsi untuk mengelola koneksi ke database MySQL menggunakan ekstensi **MySQLi**. Di dalam kelas ini terdapat beberapa atribut yang digunakan untuk menyimpan informasi koneksi, seperti **host**, **username**, **password**, dan **nama database**. 

- Fungsi **constructor** otomatis dijalankan ketika kelas diinisialisasi, yang bertugas membuat koneksi ke database. Jika koneksi berhasil, objek MySQLi disimpan di atribut **$koneksi**. Jika gagal, program akan berhenti dan menampilkan pesan error.

- Script ini juga menyediakan sebuah **method `getConnection()`** yang mengembalikan koneksi ke database, sehingga bisa digunakan untuk menjalankan query. Selain itu, ada method kosong **`tampilkanData()`** yang bisa di-override oleh kelas turunan untuk menampilkan data dari database. <br>



<b> 2. Gunakan _construct sebagai link ke database </b>
```
function __construct() {
        // Membuat koneksi ke database dengan menggunakan atribut yang sudah didefinisikan
        $this->koneksi = new mysqli($this->host, $this->username, $this->pass, $this->db);
```
Di dalam fungsi ini, dilakukan proses untuk membuat koneksi ke database dengan memanfaatkan class mysqli yang sudah disediakan oleh PHP. Koneksi ini dibuat menggunakan beberapa atribut yang sudah ditetapkan sebelumnya di dalam class, seperti nama host, username, password, dan nama database. Hasil dari koneksi tersebut disimpan dalam variabel $this->koneksi, sehingga bisa digunakan untuk berinteraksi dengan database, seperti menjalankan query atau mengelola data. <br> <br>
<b> 3. Terapkan enkapsulasi sesuai logika studi kasus </b>
```
<?php

class Database {
    // Deklarasi atribut untuk koneksi database
    private $host = "localhost";  // Nama host database
    private $username = "root";   // Username untuk akses database
    private $pass = "";           // Password untuk akses database (kosong untuk default)
    private $db = "persuratan";   // Nama database yang akan digunakan
    protected $koneksi; // Ubah menjadi protected agar bisa diakses dari subclass

    // Constructor untuk menghubungkan ke database menggunakan MySQLi
    function __construct() {
        // Membuat koneksi ke database dengan menggunakan atribut yang sudah didefinisikan
        $this->koneksi = new mysqli($this->host, $this->username, $this->pass, $this->db);

        // Cek apakah koneksi berhasil
        if ($this->koneksi->connect_error) {
            // Jika terjadi error, tampilkan pesan dan hentikan eksekusi
            die("Koneksi gagal: " . $this->koneksi->connect_error);
        }
    }

    // Method untuk mengambil koneksi yang sudah dibuat
    public function getConnection() {
        return $this->koneksi;  // Mengembalikan objek koneksi MySQLi
    }
```
Enkapsulasi dalam script ini diterapkan dengan cara melindungi atribut-atribut penting seperti `$host`, `$username`, `$pass`, dan `$db` menggunakan akses private, sehingga hanya bisa diakses dari dalam class `Database`. Atribut `$koneksi` diberi akses protected agar bisa diakses oleh subclass, namun tetap terlindungi dari akses luar. Selain itu, method `getConnection()` yang bersifat public memungkinkan akses terkontrol ke objek koneksi tanpa membiarkan data internal terbuka secara langsung. <br>

<b> 4. Membuat kelas turunan menggunakan konsep pewarisan </b> <br>
a) Mendeklarasikan Kelas Penggantian Pengawas
```
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
```
Kelas Penggantian_Pengawas merupakan turunan dari kelas Database, yang berarti bahwa ia mewarisi semua atribut dan metode yang ada di kelas Database. Dengan pewarisan ini, kelas Penggantian_Pengawas dapat menggunakan koneksi database yang telah didefinisikan di kelas Database tanpa harus mendefinisikannya ulang. Pewarisan ini memungkinkan pengorganisasian kode yang lebih baik, karena kode yang umum dapat ditempatkan di kelas induk, sedangkan kode yang spesifik dapat didefinisikan di kelas turunan

b) Mendeklarasikan Kelas Laporan Kerja Lembur
```
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
```
Script ini mengimpor file `database.php`, yang berisi class `Database` dengan koneksi ke database. Class `LaporanKerjaLembur` didefinisikan sebagai turunan dari class `Database`, sehingga mewarisi semua properti dan metode yang ada di dalamnya, termasuk koneksi ke database. Di dalam class ini, terdapat metode `tampilkanData()`, yang digunakan untuk mengambil seluruh data dari tabel `laporan_kerja_lembur` menggunakan query SQL. Hasil query disimpan dalam variabel dan diolah menjadi array asosiatif, kemudian dikembalikan sebagai hasil. Di akhir script, objek `LaporanKerjaLembur` dibuat dan metode `tampilkanData()` dipanggil untuk mendapatkan data dari tabel tersebut. <br> <br>
c) Mendeklarasikan Kelas Selesai
```
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

// Membuat objek dari kelas Materi dan memanggil method tampilkanData
$selesai    = new Selesai(); 
$selesai_lembur = $selesai->tampilkanData();
```
Class Selesai mewarisi dari class LaporanKerjaLembur, yang berarti class Selesai memiliki akses ke semua properti dan metode yang ada di LaporanKerjaLembur, termasuk koneksi database yang telah didefinisikan <br> <br>
d) Mendeklarasikan Kelas Belum Selesai
```
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
```
Class Belum_Selesai adalah contoh penerapan konsep pewarisan yang lebih lanjut, di mana class ini mewarisi dari class Selesai. Dengan cara ini, Belum_Selesai mendapatkan semua atribut dan metode yang ada di class Selesai, termasuk koneksi ke database.

Konsep pewarisan memungkinkan class Belum_Selesai untuk menggunakan dan mengubah fungsi yang sudah ada tanpa perlu mendefinisikannya kembali. Dalam hal ini, Belum_Selesai mengoverride metode tampilkanData() dari class Selesai untuk menyesuaikan query yang diinginkan. Class ini mengambil data dengan kondisi spesifik, yaitu hanya data dengan keterangan 'Belum Selesai', sehingga fungsionalitas di dalam class turunan lebih spesifik dan sesuai dengan kebutuhan. <br>

<b>5. Terapkan polimorfisme untuk minimal 2 peran sesuai studi kasus </b> <br>
a) Pada tabel/ kelas Laporan Kerja Lembur
```
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

// Membuat kelas Materi yang mewarisi LaporanKerjaLembur
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

// Membuat objek dari kelas Materi dan memanggil method tampilkanData
$selesai    = new Selesai(); 
$selesai_lembur = $selesai->tampilkanData(); // Menyimpan hasil dalam variabel $materi_kuliah

// Membuat kelas riset yang mewarisi Materi
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

```
Polimorfisme dalam kode ini terlihat melalui metode tampilkanData() yang ada pada kelas LaporanKerjaLembur, Selesai, dan Belum_Selesai. Kelas Selesai mewarisi dari kelas LaporanKerjaLembur, sehingga ia memiliki akses ke semua metode dari kelas induk. Namun, kelas Selesai mengoverride metode tampilkanData() untuk menampilkan data yang spesifik, yaitu hanya data dengan keterangan 'Selesai'.Begitu pula, kelas Belum_Selesai, yang mewarisi dari kelas Selesai, juga mengoverride metode tampilkanData() untuk mengambil data dengan keterangan 'Belum Selesai'.Dengan cara ini, meskipun ketiga kelas memiliki metode dengan nama yang sama, implementasinya berbeda. Ketika metode tampilkanData() dipanggil dari objek kelas Selesai, hasil yang didapat adalah data yang telah difilter untuk keterangan 'Selesai', sementara panggilan dari objek kelas Belum_Selesai akan mengembalikan data dengan keterangan 'Belum Selesai'. <br><br>

<b>6. Dashboard Laporan Kerja Lembur dan Pengawasan </b> <br>
Pada halaman ini menampilkan seluruh data yang ada didalam tabel kedua nya, yaitu tabel Laporan kerja Lembur dan Data Pengganti Pengawas Ujian.
```
<?php 
require_once 'class_lembur.php'; // Memasukkan file yang berisi class LaporanKerjaLembur

// Membuat objek dari class LaporanKerjaLembur dan mengambil data lembur
$laporan       = new LaporanKerjaLembur(); 
$LaporanLembur = $laporan->tampilkanData(); // Memanggil method tampilkanData untuk menampilkan data lembur
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laporan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Menggunakan Bootstrap untuk styling -->
    <style>
        /* Styling tambahan untuk margin, padding, dan tampilan tabel */
        .container {
            margin-top: 40px;
            margin-bottom: 40px;
        }
        .card-header h2 {
            margin-bottom: 0;
            padding: 10px 0;
            font-size: 1.5rem;
        }
        .text-laporan {
            text-align: center;
            font-size: 2rem; 
            font-weight: bold; 
            margin-bottom: 20px;
        }
        table thead th {
            text-align: center; 
        }
    </style>
</head>

<body>
    <?php include 'beranda.html'; ?> <!-- Menyisipkan file index.html -->
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-laporan">DATA LAPORAN</div> <!-- Bagian judul Data Laporan -->
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h2 class="text-center">LAPORAN KERJA LEMBUR</h2>
                </div>
                <div class="card-body">
                    <!-- Tabel untuk menampilkan laporan kerja lembur -->
                    <table class="table table-bordered table-hover">
                        <thead class="table-info">
                            <tr>
                                <th scope="col">NO.</th>
                                <th scope="col">ID Lembur</th>
                                <th scope="col">Hari Tanggal</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Uraian Pekerjaan</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Nama Dosen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Menampilkan data lembur dalam bentuk tabel
                            $no = 1; // Nomor urut
                            foreach ($LaporanLembur as $x) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $x['id_lembur']; ?></td>
                                    <td><?php echo $x['hari_tgl_laporan']; ?></td>
                                    <td><?php echo $x['waktu']; ?></td>
                                    <td><?php echo $x['uraian_pekerjaan']; ?></td>
                                    <td><?php echo $x['keterangan']; ?></td>
                                    <td><?php echo $x['dosen']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
require_once 'class_pengawas.php'; // Memasukkan file yang berisi class Penggantian_Pengawas
// Membuat objek dari class Penggantian_Pengawas dan mengambil data pengawas ujian
$pengawas       = new Penggantian_Pengawas();
$pengawas_ujian = $pengawas->tampilkanData(); // Memanggil method tampilkanData untuk menampilkan data pengawas ujian
?>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h2 class="text-center">DATA PENGGANTI PENGAWASAN UJIAN</h2>
                    </div>
                    <div class="card-body">
                        <!-- Tabel untuk menampilkan data penggantian pengawas ujian -->
                        <table class="table table-bordered table-hover">
                            <thead class="table-info">
                                <tr>
                                    <th scope="col">NO.</th>
                                    <th scope="col">ID Pengganti</th>
                                    <th scope="col">Nama Pengawas Diganti</th>
                                    <th scope="col">Unit Kerja</th>
                                    <th scope="col">Hari Tanggal Penggantian</th>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Ruang</th>
                                    <th scope="col">Nama Pengawas Pengganti</th>
                                    <th scope="col">Nama Dosen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Menampilkan data pengawas ujian dalam bentuk tabel
                                $no = 1; // Nomor urut
                                foreach ($pengawas_ujian as $x) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $x['id_pengganti']; ?></td>
                                        <td><?php echo $x['nama_pengawas_diganti']; ?></td>
                                        <td><?php echo $x['unit_kerja']; ?></td>
                                        <td><?php echo $x['hari_tgl_penggantian']; ?></td>
                                        <td><?php echo $x['jam']; ?></td>
                                        <td><?php echo $x['ruang']; ?></td>
                                        <td><?php echo $x['nama_pengawas_pengganti']; ?></td>
                                        <td><?php echo $x['dosen']; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="js/bootstrap.bundle.min.js"></script> <!-- Memasukkan Bootstrap JavaScript -->
</body>

</html>
```
Script PHP ini mengatur tampilan data laporan lembur dan data pengganti pengawasan ujian dengan memanfaatkan dua kelas yang terpisah untuk masing-masing jenis laporan. Pertama, file yang berisi kelas LaporanKerjaLembur diimpor, memungkinkan pembuatan objek untuk mengakses dan menampilkan data lembur. Setelah itu, metode tampilkanData() dipanggil untuk mengambil data lembur yang diperlukan, yang kemudian disimpan dalam variabel $LaporanLembur.Setelah tabel laporan lembur, script memuat kelas Penggantian_Pengawas, membuat objek dari kelas ini, dan memanggil metode tampilkanData() untuk mengambil data pengawas ujian. Data tersebut kemudian disajikan dalam tabel kedua dengan format yang sama. Struktur tabel ini mencakup informasi seperti ID pengganti, nama pengawas yang diganti, unit kerja, tanggal penggantian, jam, ruang, nama pengawas pengganti, dan nama dosen. <br><br>
**Output :** <br>
![image](https://github.com/user-attachments/assets/3c357251-864d-4fd9-8a20-b45c2f15d3ec)

<b>7. User Role Dosen </b> <br>
Tujuan Pembutan ini adalah untuk memberikan akses yang terbatas kepada pengguna, yaitu Dosen. Apabila meng-klik 'user' pada navbar dan memilih dosen, maka tampilan hanya menunujkan tabel Laporan Kerja Lembur dan tampilan tabel yang lebih khusus pada kolom 'kategori'. Akses dosen hanya dibatasi pada bagian yang berhubungan dengan laporan lembur, sehingga tidak dapat mengelola atau melihat data terkait pengawasan ujian. <br>
a) Membuat filter pada tabel Laporan Kerja lembur, dengan mengambil kolom "Keterangan" yang bernilia "Selesai"
```
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
```
Ketika metode tampilkanData() dipanggil pada objek Selesai. Metode ini berisi query yang difilter, yang hanya mengambil data dari tabel laporan_kerja_lembur dengan keterangan 'Selesai'. Proses pengambilan data hanya akan menghasilkan laporan yang sesuai dengan kriteria yang ditetapkan. <br><br>
b) Membuat filter pada tabel Laporan Kerja lembur, dengan mengambil kolom "Keterangan" yang bernilia "Selesai"
```
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
```
Proses polimorfisme terjadi ketika metode dengan nama yang sama, yaitu tampilkanData(), menghasilkan perilaku yang berbeda sesuai dengan kelas yang memanggilnya. Meskipun kelas Belum_Selesai mewarisi seluruh struktur dari kelas Selesai, termasuk koneksi ke database, query yang dijalankan berbeda karena implementasi yang telah diubah dalam metode tersebut. Hasilnya, metode ini bisa digunakan untuk mengambil data yang lebih spesifik berdasarkan kondisi yang ditetapkan di masing-masing kelas <br><br>
**Output :** <br>
![image](https://github.com/user-attachments/assets/f24f9c51-dddb-4ebd-9ba4-ae88732fbd4d)
![image](https://github.com/user-attachments/assets/822f57f7-10fe-4ce1-b3d1-7bebf73e6657)
![image](https://github.com/user-attachments/assets/cd7a3133-74cb-451f-967f-cc410f9d519a)

<b>8. User Role Admin </b> <br>
Tujuan Pembutan ini adalah untuk memberikan akses kepada pengguna, yaitu Admin. Admin memiliki akses penuh ke seluruh sistem. Admin dapat melihat dan mengelola semua data, termasuk data penggantian pengawas ujian dan laporan kerja lembur. Dengan hak akses tanpa batas ini, admin dapat melakukan berbagai tindakan yang dibutuhkan untuk mengelola sistem secara menyeluruh. <br> <br>
**Output :**
![image](https://github.com/user-attachments/assets/1595b274-8537-4c59-9f16-7e6afdf21efc)

---
**Script Navigasi :**
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Semua Data</title> <!-- Judul halaman -->
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Memuat file CSS Bootstrap -->
</head>
<body>
    <!-- Bagian navbar menggunakan komponen Bootstrap -->
    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid">
            <!-- Teks navbar dengan link ke halaman 'datalaporan.php' -->
            <a class="navbar-brand" href="datalaporan.php">Data Laporan</a>
            <!-- Tombol toggle untuk tampilan responsif -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menu navbar yang bisa collapse (menyembunyikan) di layar kecil -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                 <ul class="navbar-nav">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            User
                        </a>
                        <!-- Isi dropdown dengan link ke halaman lain -->
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="beranda.php">Admin</a></li>
                            <li><a class="dropdown-item" href="beranda2.php">Dosen</a></li>
                        </ul>
                <ul class="navbar-nav">
                    <!-- Link untuk halaman 'Semua Data dan Pengawas Ujian' -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="beranda.php">Semua Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="pengawas.php">Penggantian Pengawas Ujian</a>
                    </li>
                    <!-- Dropdown menu untuk 'Laporan Kerja Lembur' -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Laporan Kerja Lembur
                        </a>
                        <!-- Isi dropdown dengan link ke halaman lain -->
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="selesai.php">Selesai</a></li>
                            <li><a class="dropdown-item" href="belum_selesai.php">Belum Selesai</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Script untuk memuat JavaScript Bootstrap -->
    <script src="../../boostrap/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js.map"></script>
</body>
</html>

```
**Output :** <br>
![image](https://github.com/user-attachments/assets/c478099b-39ea-46b6-92fb-783b8a0e6520)

**index coding :**
```
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Data</title> <!-- Judul halaman -->
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Memuat file CSS Bootstrap -->
    <style>
        /* Menambahkan styling agar konten terpusat secara vertikal dan horizontal */
        .centered-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 90vh; /* Konten vertikal di tengah penuh */
            text-align: center;
        }
        h2 {
            font-size: 2.2rem; /* Ukuran font judul sedikit diperbesar */
            margin-bottom: 15px; /* Mengurangi jarak bawah judul untuk keseimbangan */
            font-weight: bold; /* Menambah ketebalan huruf agar terlihat lebih tegas */
        }
        p {
            max-width: 700px; /* Membatasi lebar paragraf agar tidak terlalu panjang */
            margin: 0 auto; /* Membuat paragraf terpusat */
            line-height: 1.8; /* Spasi antar baris untuk kenyamanan baca */
            font-size: 1.1rem; /* Ukuran font paragraf sedikit diperbesar */
        }
    </style>
</head>

<body>
    <!-- Bagian navbar menggunakan komponen Bootstrap -->
    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid">
            <!-- Teks navbar dengan link ke halaman 'datalaporan.php' -->
            <a class="navbar-brand" href="datalaporan.php">Data Laporan</a>
            <!-- Tombol toggle untuk tampilan responsif -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menu navbar yang bisa collapse (menyembunyikan) di layar kecil -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <!-- Dropdown menu untuk 'User' -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">User</a>
                        <!-- Isi dropdown dengan link ke halaman lain -->
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="beranda.php">Admin</a></li>
                            <li><a class="dropdown-item" href="beranda2.php">Dosen</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten utama dengan teks di tengah -->
    <div class="container centered-content">
        <h2>Selamat Datang di Sistem Pengelolaan Pengawas Ujian dan Laporan Kerja Lembur</h2> <!-- Judul halaman -->
        <p>Website ini menyediakan layanan untuk memudahkan pengelolaan data terkait penggantian pengawas ujian serta laporan kerja lembur. Dengan sistem terintegrasi ini, Anda dapat mengakses informasi terkini mengenai perubahan jadwal pengawas ujian dan merekap laporan lembur karyawan secara efektif dan efisien.</p>
    </div>

    <!-- Script untuk memuat JavaScript Bootstrap -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
```
**Output :**
![image](https://github.com/user-attachments/assets/ddcfb918-c8c9-4b1c-aea6-b477f875922a)

---
**Tampil Seluruh Halaman :**
1. index
![image](https://github.com/user-attachments/assets/4998532b-135a-4680-9198-39ee9033a92f) <br>
2. User Admin
![image](https://github.com/user-attachments/assets/0491e4c6-2d62-4714-bdf4-deaa266f0695) <br>
3. User Dosen
![image](https://github.com/user-attachments/assets/84be7ba4-ceff-4c05-990e-7f4e8dd5e436) <br>
4. Polimorfisme kelas 'Selesai'
![image](https://github.com/user-attachments/assets/fbe71c42-25b4-4f5c-bef1-adb86648909f) <br>
5. Polimorfisme kelas 'Belum Selesai'
![image](https://github.com/user-attachments/assets/dfdc048a-83fe-49ce-80a6-760e9b999572)










