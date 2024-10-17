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
