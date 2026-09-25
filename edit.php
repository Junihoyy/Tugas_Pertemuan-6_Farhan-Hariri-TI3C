<?php
/** @var mysqli $koneksi */
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "select * from berita where id='$id'");
$d = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Berita — Portal Berita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,500;0,600;1,600&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="masthead">
    <div class="wrap">
        <div class="masthead-row">
            <span class="wordmark">Portal Berita</span>
            <nav class="masthead-nav">
                <a href="index.php">Beranda</a>
                <a href="input.php">Tulis Berita</a>
            </nav>
        </div>
    </div>
</header>

<div class="wrap">
    <div class="form-card">
        <h1>Edit berita</h1>

        <form method="post" action="update.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $d['id'] ?>">
            <input type="hidden" name="gambar_lama" value="<?= $d['gambar'] ?>">

            <div class="field">
                <label for="judul">Judul berita</label>
                <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($d['judul']) ?>" required>
            </div>

            <div class="field">
                <label for="gambar">Gambar</label>
                <?php if ($d['gambar'] && file_exists("uploads/" . $d['gambar'])): ?>
                    <div class="current-img">
                        <img src="uploads/<?= htmlspecialchars($d['gambar']) ?>" alt="">
                    </div>
                <?php endif; ?>
                <input type="file" id="gambar" name="gambar" accept="image/*">
            </div>

            <div class="field">
                <label for="isi">Isi berita</label>
                <textarea id="isi" name="isi" rows="6" required><?= htmlspecialchars($d['isi']) ?></textarea>
            </div>

            <div class="field">
                <label for="penulis">Penulis</label>
                <input type="text" id="penulis" name="penulis" value="<?= htmlspecialchars($d['penulis']) ?>" required>
            </div>

            <div class="field">
                <label for="tanggal">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" value="<?= $d['tanggal'] ?>" required>
            </div>

            <button type="submit" class="btn">Simpan perubahan</button>
        </form>
    </div>
</div>

</body>
</html>
