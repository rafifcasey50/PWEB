<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "project_laundry";

$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}


function getHargaLayanan($koneksi) {
    $harga = [
        'helm'   => 0,
        'pakaian'=> 0,
        'sepatu' => 0
    ];

    $sql = "SELECT jenis, harga FROM layanan";
    $result = $koneksi->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            if ($row['jenis'] === 'Cuci Helm') {
                $harga['helm'] = $row['harga'];
            } elseif ($row['jenis'] === 'Cuci Pakaian') {
                $harga['pakaian'] = $row['harga'];
            } elseif ($row['jenis'] === 'Cuci Sepatu') {
                $harga['sepatu'] = $row['harga'];
            }
        }
    }

    return $harga;
}
?>
