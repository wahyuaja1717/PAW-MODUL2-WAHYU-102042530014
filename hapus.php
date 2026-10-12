
<?php
require 'koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

$hasil = mysqli_query($conn, "SELECT * FROM showroom_mobil WHERE id = $id");
$mobil = mysqli_fetch_assoc($hasil);

if (!$mobil) {
    exit('Mobil tidak ditemukan. <a href="index.php">Kembali ke daftar mobil</a>');
}

if (isset($_POST['hapus'])) {
    $hapus = mysqli_query(
        $conn,
        "DELETE FROM showroom_mobil WHERE id = $id"
    );

    if ($hapus) {
        header('Location: index.php?pesan=hapus');
        exit;
    } else {
        $pesan = 'Gagal menghapus data mobil.';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Mobil - Showroom EAD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main>
    <p class="label">SHOWROOM EAD / KONFIRMASI</p>

    <h1>Hapus Mobil</h1>

    <p>Apakah kamu yakin ingin menghapus mobil berikut?</p>

    <dl>
        <dt>Nama Mobil</dt>
        <dd><?= htmlspecialchars($mobil['nama_mobil']) ?></dd>

        <dt>Kode Mobil</dt>
        <dd><?= htmlspecialchars($mobil['kode_mobil']) ?></dd>

        <dt>Brand</dt>
        <dd><?= htmlspecialchars($mobil['brand_mobil']) ?></dd>

        <dt>Harga</dt>
        <dd>Rp <?= number_format((float) $mobil['harga_mobil'], 0, ',', '.') ?></dd>
    </dl>

    <p>Data yang sudah dihapus tidak dapat dikembalikan.</p>

    <?php if (isset($pesan)): ?>
        <div class="kesalahan">
            <?= htmlspecialchars($pesan) ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <button type="submit" name="hapus" class="bahaya">
            Ya, Hapus Mobil
        </button>

        <a href="detail.php?id=<?= $id ?>">Batal</a>
    </form>
</main>

</body>
</html>
