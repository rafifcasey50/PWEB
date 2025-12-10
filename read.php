<?php
require 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = $koneksi->prepare("SELECT * FROM pesanan WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) {
    die("Data tidak ditemukan.");
}

$harga = getHargaLayanan($koneksi);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Detail Pesanan Laundry</h2>
    <a href="index.php" class="btn">Kembali</a>
    <br><br>

    <table border="1" cellpadding="8" cellspacing="0" style="width: 500px; margin: 0 auto;">
        <tr>
            <th colspan="2" style="background:#000;color:#fff;">Detail Pesanan</th>
        </tr>
        <tr>
            <td width="200"><strong>ID Pesanan</strong></td>
            <td><?= $data['id']; ?></td>
        </tr>
        <tr>
            <td><strong>Nama Pelanggan</strong></td>
            <td><?= htmlspecialchars($data['nama_pelanggan']); ?></td>
        </tr>
        <tr>
            <td><strong>Helm</strong></td>
            <td><?= $data['helm_qty']; ?> unit × Rp <?= number_format($harga['helm'], 0, ',', '.'); ?> = Rp <?= number_format($data['helm_qty'] * $harga['helm'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td><strong>Pakaian</strong></td>
            <td><?= $data['pakaian_kg']; ?> kg × Rp <?= number_format($harga['pakaian'], 0, ',', '.'); ?> = Rp <?= number_format($data['pakaian_kg'] * $harga['pakaian'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td><strong>Sepatu</strong></td>
            <td><?= $data['sepatu_pasang']; ?> pasang × Rp <?= number_format($harga['sepatu'], 0, ',', '.'); ?> = Rp <?= number_format($data['sepatu_pasang'] * $harga['sepatu'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td><strong>Total Harga</strong></td>
            <td><strong>Rp <?= number_format($data['total_harga'], 0, ',', '.'); ?></strong></td>
        </tr>
        <tr>
            <td><strong>Status</strong></td>
            <td><?= strtoupper($data['status']); ?></td>
        </tr>
        <tr>
            <td><strong>Tanggal</strong></td>
            <td><?= $data['tanggal']; ?></td>
        </tr>
    </table>
</body>
</html>