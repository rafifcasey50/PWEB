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

$errors = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pelanggan = trim($_POST['nama_pelanggan']);
    $helm_qty = (int) ($_POST['helm_qty'] ?? 0);
    $pakaian_kg = (float) ($_POST['pakaian_kg'] ?? 0);
    $sepatu_pasang = (int) ($_POST['sepatu_pasang'] ?? 0);
    $status = $_POST['status'] ?? 'pending';

    if ($nama_pelanggan === "") {
        $errors = "Nama pelanggan wajib diisi.";
    } else {
        $harga = getHargaLayanan($koneksi);

        $total_harga = ($helm_qty * $harga['helm']) +
            ($pakaian_kg * $harga['pakaian']) +
            ($sepatu_pasang * $harga['sepatu']);

        $stmt = $koneksi->prepare("UPDATE pesanan SET 
            nama_pelanggan = ?, 
            helm_qty = ?, 
            pakaian_kg = ?, 
            sepatu_pasang = ?, 
            total_harga = ?, 
            status = ?
            WHERE id = ?");

        $stmt->bind_param(
            "sididsi",
            $nama_pelanggan,
            $helm_qty,
            $pakaian_kg,
            $sepatu_pasang,
            $total_harga,
            $status,
            $id
        );

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $errors = "Gagal mengupdate data: " . $stmt->error;
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pesanan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Pesanan Laundry</h2>
    <a href="index.php" class="btn">Kembali</a>
    <br><br>

    <?php if ($errors): ?>
            <div style="color:red;"><?= $errors; ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Nama Pelanggan</label>
        <input type="text" name="nama_pelanggan" required
               value="<?= htmlspecialchars($data['nama_pelanggan']); ?>">

        <label>Jumlah Helm (unit)</label>
        <input type="number" name="helm_qty" min="0"
               value="<?= $data['helm_qty']; ?>">

        <label>Berat Pakaian (kg)</label>
        <input type="number" step="0.1" name="pakaian_kg" min="0"
               value="<?= $data['pakaian_kg']; ?>">

        <label>Jumlah Sepatu (pasang)</label>
        <input type="number" name="sepatu_pasang" min="0"
               value="<?= $data['sepatu_pasang']; ?>">

        <label>Status</label>
        <select name="status">
            <option value="pending" <?= $data['status'] == 'pending' ? 'selected' : ''; ?>>pending</option>
            <option value="proses" <?= $data['status'] == 'proses' ? 'selected' : ''; ?>>proses</option>
            <option value="selesai" <?= $data['status'] == 'selesai' ? 'selected' : ''; ?>>selesai</option>
        </select>

        <button type="submit" class="btn">Update</button>
    </form>
</body>
</html>
