
<?php
require 'koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

$hasil = mysqli_query($conn, "SELECT * FROM showroom_mobil WHERE id = $id");
$mobil = mysqli_fetch_assoc($hasil);

if (!$mobil) {
    exit('Mobil tidak ditemukan. <a href="index.php">Kembali ke daftar mobil</a>');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mobil - Showroom EAD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main>
    <p class="label">SHOWROOM EAD / DETAIL</p>

    <h1><?= htmlspecialchars($mobil['nama_mobil']) ?></h1>

    <dl>
        <dt>Kode Mobil</dt>
        <dd><?= htmlspecialchars($mobil['kode_mobil']) ?></dd>

        <dt>Brand</dt>
        <dd><?= htmlspecialchars($mobil['brand_mobil']) ?></dd>

        <dt>Warna</dt>
        <dd><?= htmlspecialchars($mobil['warna_mobil']) ?></dd>

        <dt>Tipe</dt>
        <dd><?= htmlspecialchars($mobil['tipe_mobil']) ?></dd>

        <dt>Harga</dt>
        <dd>Rp <?= number_format((float) $mobil['harga_mobil'], 0, ',', '.') ?></dd>
    </dl>

    <p>
        <a href="index.php">Kembali ke daftar</a>
        <a href="edit.php?id=<?= $id ?>">Edit Mobil</a>
        <a href="hapus.php?id=<?= $id ?>">Hapus Mobil</a>
    </p>
</main>

</body>
</html>
