<?php
// koneksi database
/** @var mysqli $koneksi */
include 'koneksi.php';

// menangkap data yang di kirim dari form
$id         = $_POST['id'];
$judul      = $_POST['judul'];
$isi        = $_POST['isi'];
$penulis    = $_POST['penulis'];
$tanggal    = $_POST['tanggal'];
$gambarLama = $_POST['gambar_lama'];

// jika user upload gambar baru, pakai yang baru. jika tidak, pakai gambar lama
$namaGambar = $gambarLama;
if (isset($_FILES['gambar']) && $_FILES['gambar']['name'] != "") {
    $namaGambar = time() . "_" . $_FILES['gambar']['name'];
    $tujuan = "uploads/" . $namaGambar;
    move_uploaded_file($_FILES['gambar']['tmp_name'], $tujuan);
}

// update data ke database
mysqli_query($koneksi, "update berita set
    judul='$judul',
    gambar='$namaGambar',
    isi='$isi',
    penulis='$penulis',
    tanggal='$tanggal'
    where id='$id'");

// mengalihkan halaman kembali ke index.php
header("location: index.php?status=edit");
