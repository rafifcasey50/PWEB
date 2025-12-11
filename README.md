# Sistem Manajemen Laundry

Aplikasi web untuk mengelola pesanan laundry berbasis PHP dan MySQL. Mendukung CRUD lengkap dengan perhitungan harga otomatis untuk 3 jenis layanan: Cuci Helm, Cuci Pakaian, dan Cuci Sepatu.

---

## Fitur Utama

- **CRUD Pesanan** - Tambah, lihat, edit, dan hapus pesanan
- **Perhitungan Otomatis** - Total harga dihitung otomatis berdasarkan qty × harga layanan
- **Multi Layanan** - Cuci Helm (Rp 15.000/unit), Cuci Pakaian (Rp 8.000/kg), Cuci Sepatu (Rp 25.000/pasang)
- **Status Tracking** - Pending, Proses, Selesai
- **Keamanan SQL** - Prepared Statement untuk mencegah SQL Injection

---

## Cara Setup

### 1. Buat Database

Buat database MySQL dengan nama:

```
project_laundry
```

Atau gunakan nama lain dan sesuaikan di `db.php`.

### 2. Import Database

Import file:

```
data.sql
```

ke dalam database tersebut menggunakan phpMyAdmin.

### 3. Letakkan Project di XAMPP

Copy folder project ke:

```
C:\xampp\htdocs
```

### 4. Atur Koneksi Database

Buka file:

```
db.php
```

Sesuaikan pengaturan berikut jika perlu:

```php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "project_laundry";
```

### 5. Jalankan Aplikasi

Buka browser dan akses:

```
http://localhost/project_pweb/index.php
```

---

## Struktur Database

### Tabel `pesanan`
Menyimpan data pesanan dari pelanggan.

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | INT | Primary Key, Auto Increment |
| nama_pelanggan | VARCHAR(100) | Nama pelanggan |
| helm_qty | INT | Jumlah helm (unit) |
| pakaian_kg | DECIMAL(5,2) | Berat pakaian (kg) |
| sepatu_pasang | INT | Jumlah sepatu (pasang) |
| total_harga | DECIMAL(10,2) | Total harga (otomatis) |
| status | ENUM | pending/proses/selesai |
| tanggal | TIMESTAMP | Tanggal pesanan dibuat |

### Tabel `layanan`
Menyimpan daftar layanan dan harga.

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | INT | Primary Key, Auto Increment |
| jenis | VARCHAR(50) | Nama layanan |
| harga | DECIMAL(10,2) | Harga per satuan |
| satuan | VARCHAR(20) | Unit (unit/kg/pasang) |

---

## Struktur File

```
PWEB/
├── index.php          # Halaman utama - daftar pesanan
├── create.php         # Form tambah pesanan baru
├── read.php           # Detail pesanan
├── edit.php           # Form edit pesanan
├── delete.php         # Proses hapus pesanan
├── db.php             # Koneksi database + fungsi helper
├── style.css          # File CSS untuk styling
├── data.sql           # Database schema + sample data
└── README.md          # Dokumentasi (file ini)
```

---

## Cara Penggunaan

### Tambah Pesanan Baru
1. Klik tombol **"+ Tambah Pesanan"**
2. Isi form (minimal nama pelanggan wajib diisi)
3. Masukkan quantity untuk layanan yang diinginkan
4. Pilih status pesanan
5. Klik **"Simpan Data"**
6. Total harga akan dihitung otomatis

### Lihat Detail Pesanan
1. Klik tombol **"Detail"** (hitam) pada baris pesanan
2. Akan tampil detail lengkap dengan breakdown harga

### Edit Pesanan
1. Klik tombol **"Edit"** (hijau) pada baris pesanan
2. Ubah data yang diperlukan
3. Klik **"Update"**

### Hapus Pesanan
1. Klik tombol **"Hapus"** (merah) pada baris pesanan
2. Konfirmasi penghapusan
3. Data akan terhapus dari database

---

## Daftar Harga Layanan

| Jenis Layanan | Harga | Satuan |
|---------------|-------|--------|
| Cuci Helm | Rp 15.000 | per unit |
| Cuci Pakaian | Rp 8.000 | per kg |
| Cuci Sepatu | Rp 25.000 | per pasang |

**Contoh Perhitungan:**
- 1 Helm × Rp 15.000 = Rp 15.000
- 2 kg Pakaian × Rp 8.000 = Rp 16.000
- **Total = Rp 31.000**

---

## Teknologi yang Digunakan

- **PHP** 7.4+
- **MySQL** 8.0+
- **HTML5** & **CSS3**
- **Apache** (XAMPP/WAMP)

---

## Author

**Kelompok**

1. **Rafif Casey** - 51423187
2. **Alifsyah Rahman** - 50423127
3. **Muhammad Rofah Binauf** - 51423013

Mata Kuliah: Pemrograman Web  
Universitas: [Nama Universitas Anda]  
Tahun: 2024

**Repository:** https://github.com/rafifcasey50/PWEB

---

## License

Project ini dibuat untuk keperluan **Ujian** Pemrograman Web.

---
