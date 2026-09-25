<?php
/** @var mysqli $koneksi */
include 'koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "delete from berita where id='$id'");

header("location: index.php?status=hapus");
