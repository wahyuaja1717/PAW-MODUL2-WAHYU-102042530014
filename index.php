
<?php
require 'koneksi.php';

$cari = trim($_GET['cari'] ?? '');
$cari_db = mysqli_real_escape_string($conn, $cari);

$hasil = mysqli_query(
    $conn,
    "SELECT * FROM showroom_mobil
     WHERE nama_mobil LIKE '%$cari_db%'
        OR brand_mobil LIKE '%$cari_db%'
     ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showroom EAD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main>
    <p class="label">PRAKTIKUM PAW / MODUL 2</p>

    <h1>Showroom EAD</h1>

    <p>Kelola data mobil yang tersedia di showroom.</p>

    <?php if (isset($_GET['pesan'])): ?>
        <p class="pesan">
            <?php if ($_GET['pesan'] === 'hapus'): ?>
                Data mobil berhasil dihapus.
            <?php else: ?>
                Perubahan data berhasil disimpan.
            <?php endif; ?>
        </p>
    <?php endif; ?>

    <p>
        <a class="tombol" href="tambah.php">+ Tambah Mobil</a>
    </p>

    <form method="get" class="pencarian">
        <label for="cari">Cari nama atau brand mobil</label>

        <input
            type="text"
            id="cari"
            name="cari"
            placeholder="Contoh: Toyota"
            value="<?= htmlspecialchars($cari) ?>"
        >

        <button type="submit">Cari</button>
        <a href="index.php">Reset</a>
    </form>

    <p>Jumlah hasil: <?= mysqli_num_rows($hasil) ?> mobil</p>

    <?php if (mysqli_num_rows($hasil) == 0): ?>
        <p>Data tidak ditemukan. Coba kata kunci lain.</p>
    <?php endif; ?>

    <div class="daftar">
        <?php while ($mobil = mysqli_fetch_assoc($hasil)): ?>
            <article>
                <p class="label">
                    <?= htmlspecialchars($mobil['kode_mobil']) ?>
                </p>

                <h2>
                    <?= htmlspecialchars($mobil['nama_mobil']) ?>
                </h2>

                <p>
                    <?= htmlspecialchars($mobil['brand_mobil']) ?>
                    &bull;
                    <?= htmlspecialchars($mobil['tipe_mobil']) ?>
                </p>

                <p>
                    Warna: <?= htmlspecialchars($mobil['warna_mobil']) ?>
                </p>

                <p>
                    <strong>
                        Rp <?= number_format((float) $mobil['harga_mobil'], 0, ',', '.') ?>
                    </strong>
                </p>

                <div class="aksi">
                    <a href="detail.php?id=<?= (int) $mobil['id'] ?>">
                        Detail
                    </a>

                    <a href="edit.php?id=<?= (int) $mobil['id'] ?>">
                        Edit
                    </a>

                    <a href="hapus.php?id=<?= (int) $mobil['id'] ?>">
                        Hapus
                    </a>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

</body>
</html>
