<?php
require 'db.php';

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
        // Ambil harga dari tabel layanan (fungsi ini ada di db.php)
        $harga = getHargaLayanan($koneksi);

        // Hitung total harga
        $total_harga = ($helm_qty * $harga['helm']) +
            ($pakaian_kg * $harga['pakaian']) +
            ($sepatu_pasang * $harga['sepatu']);

        // Siapkan query insert
        $stmt = $koneksi->prepare("INSERT INTO pesanan 
            (nama_pelanggan, helm_qty, pakaian_kg, sepatu_pasang, total_harga, status)
            VALUES (?,?,?,?,?,?)");

        // tipe data: s = string, i = int, d = double
        $stmt->bind_param(
            "sidids",
            $nama_pelanggan,
            $helm_qty,
            $pakaian_kg,
            $sepatu_pasang,
            $total_harga,
            $status
        );

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $errors = "Gagal menyimpan data: " . $stmt->error;
        }
    }
}
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Pesanan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Tambah Pesanan Laundry</h2>
    <a href="index.php" class="btn">Kembali</a>
    <br><br>

    <?php if ($errors): ?>
        <div style="color:red;"><?= htmlspecialchars($errors); ?></div>
    <?php endif; ?>

    <form method="post">
        <table cellpadding="6" cellspacing="0" border="1"
            style="width: 450px; background:#ffdfaf; border-collapse:collapse; margin:auto;">
            <tr>
                <th colspan="2" style="background:#000;color:#fff;font-size:16px;">
                    Input Data Pesanan
                </th>
            </tr>

            <tr>
                <td>Nama Pelanggan</td>
                <td>
                    <input type="text" name="nama_pelanggan" required style="width:100%;">
                </td>
            </tr>

            <tr>
                <td>Jumlah Helm (unit)</td>
                <td>
                    <input type="number" name="helm_qty" min="0" value="0" style="width:100%;">
                </td>
            </tr>

            <tr>
                <td>Berat Pakaian (kg)</td>
                <td>
                    <input type="number" step="0.1" name="pakaian_kg" min="0" value="0" style="width:100%;">
                </td>
            </tr>

            <tr>
                <td>Jumlah Sepatu (pasang)</td>
                <td>
                    <input type="number" name="sepatu_pasang" min="0" value="0" style="width:100%;">
                </td>
            </tr>

            <tr>
                <td>Status</td>
                <td>
                    <select name="status" style="width:100%;">
                        <option value="pending">pending</option>
                        <option value="proses">proses</option>
                        <option value="selesai">selesai</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <button type="submit" class="btn" style="width:100%;">Simpan Data</button>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>