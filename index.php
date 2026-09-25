<?php
/** @var mysqli $koneksi */
require "koneksi.php";
require "fungsi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Berita</title>
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
                <a href="index.php" class="active">Beranda</a>
                <a href="input.php">Tulis Berita</a>
            </nav>
        </div>
        <p class="masthead-sub">Kabar dari kampus, ditulis oleh mahasiswa</p>
    </div>
</header>

<div class="wrap">

    <?php if (isset($_GET['status'])): ?>
        <div class="alert">
            <?php
            if ($_GET['status'] == 'tambah') echo "Berita berhasil ditambahkan.";
            if ($_GET['status'] == 'edit') echo "Berita berhasil diperbarui.";
            if ($_GET['status'] == 'hapus') echo "Berita berhasil dihapus.";
            ?>
        </div>
    <?php endif; ?>

    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id DESC");
    $total = mysqli_num_rows($query);
    ?>

    <?php if ($total == 0): ?>

        <div class="empty-state">
            Belum ada berita yang ditulis.<br>
            <a href="input.php">Tulis berita pertama</a>
        </div>

    <?php else: ?>

        <?php $row = mysqli_fetch_assoc($query); ?>

        <article class="hero-article">
            <div class="thumb">
                <?php if ($row['gambar'] && file_exists("uploads/" . $row['gambar'])): ?>
                    <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" alt="">
                <?php else: ?>
                    <div class="thumb-placeholder">Tanpa gambar</div>
                <?php endif; ?>
            </div>
            <div>
                <h2><?= htmlspecialchars($row['judul']) ?></h2>
                <p class="meta">Oleh <?= htmlspecialchars($row['penulis']) ?>, <?= formatTanggalIndo($row['tanggal']) ?></p>
                <p class="excerpt"><?= htmlspecialchars(mb_strimwidth($row['isi'], 0, 160, "...")) ?></p>
                <div class="actions">
                    <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                    <span class="sep">/</span>
                    <a href="hapus.php?id=<?= $row['id'] ?>" class="danger"
                       onclick="return confirm('Yakin ingin menghapus berita ini?')">Hapus</a>
                </div>
            </div>
        </article>

        <?php if ($total > 1): ?>
            <p class="section-label">Berita lainnya</p>

            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                <article class="article-row">
                    <div class="thumb">
                        <?php if ($row['gambar'] && file_exists("uploads/" . $row['gambar'])): ?>
                            <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" alt="">
                        <?php else: ?>
                            <div class="thumb-placeholder">Tanpa gambar</div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <h3><?= htmlspecialchars($row['judul']) ?></h3>
                        <p class="meta">Oleh <?= htmlspecialchars($row['penulis']) ?>, <?= formatTanggalIndo($row['tanggal']) ?></p>
                        <div class="actions">
                            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                            <span class="sep">/</span>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="danger"
                               onclick="return confirm('Yakin ingin menghapus berita ini?')">Hapus</a>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>

    <?php endif; ?>

</div>

</body>
</html>
