<?php

require 'auth.php';   
require 'db.php';     


$sql = "SELECT id, nama_pelanggan, helm_qty, pakaian_kg, sepatu_pasang, total_harga, status, tanggal FROM pesanan ORDER BY tanggal DESC";
$result = $koneksi->query($sql);
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Data Pesanan Laundry</title>
    <link rel="stylesheet" href="style.css?v=4">
</head>

<body>

    <h2>Data Pesanan Laundry</h2>
    <a href="create.php" class="btn">+ Tambah Pesanan</a>
    <a href="logout.php" class="btn btn-delete">Logout</a>
    <br><br>

    <table>
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
                        <td><?php echo (int) $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nama_pelanggan']); ?></td>
                        <td><?php echo (int) $row['helm_qty']; ?></td>
                        <td><?php echo htmlspecialchars($row['pakaian_kg']); ?></td>
                        <td><?php echo (int) $row['sepatu_pasang']; ?></td>
                        <td>Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                        <td>
                            <a href="read.php?id=<?php echo (int) $row['id']; ?>" class="btn">Detail</a>
                            <a href="edit.php?id=<?php echo (int) $row['id']; ?>" class="btn-edit">Edit</a>
                            <a href="delete.php?id=<?php echo (int) $row['id']; ?>" class="btn-delete"
                                onclick="return confirm('Yakin hapus pesanan ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" style="text-align:center;">Belum ada data pesanan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>
<?php

if ($result) {
    $result->free();
}
$koneksi->close();
?>