# PraktikumWeb2-TUGAS 2

Implementasi CRUD dengan menggunakan PPHP OOP <br>
Implementasi CRUD menggunakan PHP OOP melibatkan pemanfaatan konsep Object-Oriented Programming (OOP) dalam mengelola operasi Create, Read, Update, dan Delete pada database. Dalam pendekatan ini, kita memisahkan logika menjadi kelas-kelas dan metode-metode, sehingga lebih terstruktur dan mudah dikelola. <br>
<br>
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
- require_once('database.php'): <br>
Script ini mengimpor file database.php yang berisi pengaturan koneksi ke database. Ini memungkinkan kelas Penggantian_Pengawas untuk menggunakan koneksi tersebut tanpa harus mendeklarasikan ulang. <br>
- Deklarasi Kelas Penggantian_Pengawas: <br>
Kelas ini merupakan turunan dari kelas Database, yang berarti kelas ini mewarisi fungsi dan atribut yang sudah ada di kelas Database, terutama terkait koneksi database.
Kelas ini difokuskan untuk mengambil dan menampilkan data terkait penggantian pengawas ujian dari tabel database yang sesuai. <br>
- Method tampilkanData(): <br>
Method ini bertugas untuk menjalankan query SQL yang mengambil semua data dari tabel penggantian_pengawasan_ujian.
Query SQL yang digunakan adalah: SELECT * FROM penggantian_pengawasan_ujian, yang berarti mengambil seluruh data dari tabel tersebut.
Menggunakan objek $koneksi yang berasal dari kelas induk untuk menjalankan query di database.
Jika ada hasil yang didapatkan (melalui pengecekan $data->num_rows > 0), maka data diubah menjadi array asosiatif menggunakan fetch_assoc(), lalu disimpan dalam array $hasil. Pada akhirnya, method ini mengembalikan data dalam bentuk array hasil yang bisa diproses lebih lanjut. <br>
- Pengujian Kode: <br>
$pengawas = new Penggantian_Pengawas();: Membuat objek dari kelas Penggantian_Pengawas. Objek ini digunakan untuk mengakses method di dalam kelas tersebut.
$pengawas_ujian = $pengawas->tampilkanData();: Memanggil method tampilkanData() untuk mengambil data dari database dan menyimpannya di variabel $pengawas_ujian. <br>

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

<b>5. Terapkan polimorfisme untuk minimal 2 peran sesuai studi kasus </b>
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
6. Menampilkan nnm
