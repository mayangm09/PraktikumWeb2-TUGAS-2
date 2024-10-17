<?php 
require_once 'class_pengawas.php'; // Memasukkan file yang berisi class Penggantian_Pengawas

// Membuat objek dari class Penggantian_Pengawas dan mengambil data pengawas ujian
$pengawas       = new Penggantian_Pengawas();
$pengawas_ujian = $pengawas->tampilkanData(); // Memanggil method tampilkanData untuk menampilkan data pengawas ujian
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
        <script src="js/bootstrap.bundle.min.js"></script> <!-- Memasukkan Bootstrap JavaScript -->
    </div>
</html>