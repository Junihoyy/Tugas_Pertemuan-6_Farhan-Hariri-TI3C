<?php
// koneksi database
/** @var mysqli $koneksi */
include 'koneksi.php';

// menangkap data yang di kirim dari form
$judul   = $_POST['judul'];
$isi     = $_POST['isi'];
$penulis = $_POST['penulis'];
$tanggal = $_POST['tanggal'];

// proses upload gambar (jika ada file yang dipilih)
$namaGambar = "";
if (isset($_FILES['gambar']) && $_FILES['gambar']['name'] != "") {
    $namaGambar = time() . "_" . $_FILES['gambar']['name'];
    $tujuan = "uploads/" . $namaGambar;
    move_uploaded_file($_FILES['gambar']['tmp_name'], $tujuan);
}

// menginput data ke database
mysqli_query($koneksi, "insert into berita (judul, gambar, isi, penulis, tanggal)
    values ('$judul', '$namaGambar', '$isi', '$penulis', '$tanggal')");

// mengalihkan halaman kembali ke index.php
header("location: index.php?status=tambah");
