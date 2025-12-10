<?php
require 'db.php';

$sql = "SELECT * FROM pesanan ORDER BY tanggal DESC";
$result = $koneksi->query($sql);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pesanan Laundry</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Data Pesanan Laundry</h2>

    <a href="create.php" class="btn">+ Tambah Pesanan</a>
    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pelanggan</th>
                <th>Helm (qty)</th>
                <th>Pakaian (kg)</th>
                <th>Sepatu (pasang)</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['nama_pelanggan']); ?></td>
                    <td><?= $row['helm_qty']; ?></td>
                    <td><?= $row['pakaian_kg']; ?></td>
                    <td><?= $row['sepatu_pasang']; ?></td>
                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                    <td><?= $row['status']; ?></td>
                    <td><?= $row['tanggal']; ?></td>
                    <td>
                        <a href="read.php?id=<?= $row['id']; ?>" class="btn">Detail</a>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn-edit">Edit</a>
                        <a href="delete.php?id=<?= $row['id']; ?>" 
                           class="btn-delete"
                           onclick="return confirm('Yakin hapus pesanan ini?');">
                           Hapus
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="9">Belum ada data pesanan.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</body>
</html>