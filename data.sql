CREATE TABLE IF NOT EXISTS layanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis VARCHAR(50) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    satuan VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pesanan_id INT NOT NULL,
    jumlah_bayar DECIMAL(10,2) NOT NULL,
    metode ENUM('cash','transfer','ewallet') DEFAULT 'cash',
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pesanan_id) REFERENCES pesanan(id)
);


INSERT INTO layanan (jenis, harga, satuan) VALUES
('Cuci Helm', 15000, 'unit'),
('Cuci Pakaian', 8000, 'kg'),
('Cuci Sepatu', 25000, 'pasang');

INSERT INTO pesanan 
(nama_pelanggan, helm_qty, pakaian_kg, sepatu_pasang, total_harga, status)
VALUES
('Alifsyah', 1, 2, 0, 31000, 'pending'),
('Rofah', 0, 4, 1, 57000, 'proses'),
('Casey', 2, 0, 1, 55000, 'selesai'),
('Zaid', 1, 1.5, 0, 27000, 'pending'),
('Yundra', 0, 6, 2, 106000, 'proses');
