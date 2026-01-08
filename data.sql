CREATE TABLE IF NOT EXISTS pesanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_pelanggan VARCHAR(100) NOT NULL,
    helm_qty INT DEFAULT 0,
    pakaian_kg DECIMAL(5,2) DEFAULT 0,
    sepatu_pasang INT DEFAULT 0,
    total_harga DECIMAL(10,2) NOT NULL,
    status ENUM('pending','proses','selesai') DEFAULT 'pending',
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS layanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis VARCHAR(50) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    satuan VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','user') DEFAULT 'admin',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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