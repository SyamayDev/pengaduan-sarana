# Triadu - Sistem Pengaduan Sarana Sekolah

## 📋 Deskripsi Aplikasi

Triadu adalah aplikasi web untuk pengaduan sarana dan prasarana sekolah yang memudahkan siswa menyampaikan masukan dan keluhan terkait sarana sekolah. Sistem ini dilengkapi dengan dashboard admin untuk mengelola aspirasi siswa dan memberikan umpan balik.

## 🎯 Fitur Utama

### Untuk Siswa:

- ✅ Dashboard publik untuk melihat semua aspirasi yang telah dikirim
- ✅ Login dengan format NIS (R.XXXX.XX) dan Kelas (XII-RPL-1)
- ✅ Form tambah aspirasi dengan kategori, lokasi, deskripsi, dan upload gambar
- ✅ Halaman "Aspirasi Saya" untuk melihat aspirasi yang telah dikirim
- ✅ Filter aspirasi berdasarkan status (Menunggu, Proses, Selesai)
- ✅ Melihat umpan balik dari admin
- ✅ Navbar sticky di bagian bawah (seperti Instagram)
- ✅ Responsive design dan animasi AOS

### Untuk Admin:

- ✅ Login admin dengan username dan password (hashed MD5)
- ✅ Dashboard dengan statistik aspirasi
- ✅ Kelola aspirasi (view, edit, hapus)
- ✅ Memberikan umpan balik dan mengubah status aspirasi
- ✅ Kelola kategori aspirasi (CRUD)
- ✅ Kelola data siswa (CRUD)
- ✅ Tabel dengan fitur filter dan search

## 🛠️ Teknologi yang Digunakan

- **Framework**: CodeIgniter 3.1
- **Frontend**: Bootstrap 5, AdminLTE v4, HTML5, CSS3
- **Backend**: PHP 7.3+
- **Database**: MySQL/MariaDB
- **Animasi**: AOS (Animate On Scroll)
- **Icons**: Font Awesome 6.4

## 📁 Struktur Folder

```
ukk_papss/
├── application/
│   ├── controllers/
│   │   ├── Admin.php           # Controller admin
│   │   ├── Siswa.php           # Controller siswa
│   │   ├── Welcome.php         # Controller redirect
│   │   └── Auth.php            # (untuk kompatibilitas)
│   ├── models/
│   │   ├── Admin_model.php     # Model admin
│   │   ├── Siswa_model.php     # Model siswa
│   │   ├── Aspirasi_model.php  # Model aspirasi
│   │   └── Kategori_model.php  # Model kategori
│   ├── views/
│   │   ├── templates/
│   │   │   ├── header_admin.php    # Header admin dengan sidebar
│   │   │   ├── footer_admin.php    # Footer admin
│   │   │   ├── header_siswa.php    # Header siswa dengan navbar bottom
│   │   │   └── footer_siswa.php    # Footer siswa
│   │   ├── admin/
│   │   │   ├── login.php           # Login admin
│   │   │   ├── dashboard.php       # Dashboard admin
│   │   │   ├── aspirasi.php        # List aspirasi
│   │   │   ├── edit_aspirasi.php   # Edit aspirasi & feedback
│   │   │   ├── kategori.php        # List kategori
│   │   │   ├── add_kategori.php    # Add kategori
│   │   │   ├── edit_kategori.php   # Edit kategori
│   │   │   ├── siswa.php           # List siswa
│   │   │   ├── add_siswa.php       # Add siswa
│   │   │   └── edit_siswa.php      # Edit siswa
│   │   └── siswa/
│   │       ├── login.php               # Login siswa
│   │       ├── dashboard_aspirasi.php  # Dashboard aspirasi publik
│   │       ├── tambah_aspirasi.php     # Form tambah aspirasi
│   │       └── my_aspirasi.php         # Aspirasi saya
│   ├── config/
│   │   ├── database.php  # Konfigurasi database
│   │   └── routes.php    # Routing URL
│   └── (folder lainnya)
├── assets/
│   ├── dist/             # AdminLTE v4 compiled
│   ├── src/              # AdminLTE v4 source
│   └── images/           # Gambar assets
├── database/
│   └── ukk_papss.sql     # Database dump dengan data sample
├── uploads/
│   ├── aspirasi/         # Folder penyimpanan gambar aspirasi
│   └── feedback/         # Folder penyimpanan gambar feedback
└── (folder lainnya)
```

## 🚀 Instalasi

### Prerequisites:

- PHP 7.3+
- MySQL/MariaDB
- XAMPP atau webserver lainnya

### Langkah Instalasi:

1. **Clone/Download Aplikasi**

   ```bash
   # Jika di XAMPP
   cd C:\xampp\htdocs\
   # Copy folder ukk_papss ke sini
   ```

2. **Setup Database**
   - Buka phpMyAdmin: http://localhost/phpmyadmin
   - Buat database baru: `ukk_papss`
   - Import file: `database/ukk_papss.sql`

3. **Konfigurasi CodeIgniter**
   - Edit `application/config/database.php` sesuai konfigurasi Anda
   - Pastikan username, password, dan database name sudah benar

4. **Set Permissions**
   - Pastikan folder `uploads/` bisa ditulis:
     ```bash
     chmod 755 uploads/
     chmod 755 uploads/aspirasi/
     chmod 755 uploads/feedback/
     ```

5. **Jalankan Aplikasi**
   - Buka browser: http://localhost/ukk_papss/

## 🔐 Keamanan

### Fitur Keamanan yang Diimplementasikan:

1. **Password Hashing**
   - Admin password: MD5 hash
   - Password admin default: `0192023a7bbd73250516f069df18b500` (password: admin)

2. **CSRF Protection**
   - Semua form menggunakan CSRF token
   - `$this->security->get_csrf_token_name()` dan `$this->security->get_csrf_hash()`

3. **Input Sanitization**
   - Semua input di-sanitize dengan `htmlspecialchars()`
   - File upload divalidasi (tipe, ukuran)

4. **SQL Injection Prevention**
   - Menggunakan CodeIgniter Query Builder
   - Parameterized queries

5. **File Upload Security**
   - Whitelist MIME types
   - File di-encrypt dengan nama random
   - Folder uploads protected dengan .htaccess

6. **Session Management**
   - Session-based authentication
   - Check login di setiap halaman yang perlu
   - Secure logout

## 👤 Akun Default

### Admin:

- **Username**: admin
- **Password**: admin

### Siswa (Contoh):

- **NIS**: R.0278.23
- **Kelas**: XII-RPL-1

_Catatan: Anda bisa menambahkan siswa baru melalui admin panel_

## 📊 Format Data

### Format NIS Siswa:

```
Format: X.XXXX.XX
Contoh: R.0278.23

Penjelasan:
- X = Huruf (R, S, T, dll)
- XXXX = 4 digit tahun/nomor
- XX = 2 digit tahun
```

### Format Kelas:

```
Format: XII-RPL-1
Contoh: XII-RPL-1, XII-TKJ-2, XI-RPL-1

Penjelasan:
- XII = Tingkat kelas (X, XI, XII)
- RPL = Jurusan (RPL, TKJ, MM, dll)
- 1 = Urutan kelas
```

## 📋 Fitur Detail

### Dashboard Siswa

- Menampilkan semua aspirasi dari semua siswa
- Dapat filter berdasarkan status
- Melihat feedback dari admin
- Login modal untuk siswa yang belum login

### Dashboard Admin

- Statistik jumlah aspirasi (total, menunggu, proses, selesai)
- List aspirasi terbaru
- Filter aspirasi berdasarkan status
- Edit aspirasi dengan memberikan feedback dan gambar

### Form Tambah Aspirasi

- Pilih kategori
- Masukkan lokasi
- Tulis deskripsi/keterangan
- Upload gambar (opsional, bisa langsung ambil dari kamera HP)
- Validasi form client-side dan server-side

### Management Kategori

- CRUD kategori
- Tidak bisa hapus kategori yang masih digunakan

### Management Siswa

- CRUD siswa
- Format NIS dan Kelas divalidasi
- Tidak bisa hapus siswa yang sudah punya aspirasi

## 🎨 Design

- **Responsive**: Mobile-first design, support semua ukuran layar
- **Animasi**: AOS (Animate On Scroll) untuk transisi halus
- **UI Konsisten**: Menggunakan AdminLTE v4 dan Bootstrap 5
- **Color Scheme**:
  - Primary: Blue (#3B82F6)
  - Secondary: Green (#10B981)
  - Warning: Yellow (#F59E0B)
  - Info: Cyan (#0EA5E9)

## 🔄 Workflow Aspirasi

```
Siswa Login
    ↓
Isi Form Aspirasi
    ↓
Submit Aspirasi (Status: Menunggu)
    ↓
Admin Review & Edit Status (Proses)
    ↓
Admin Memberikan Feedback (Status: Selesai)
    ↓
Siswa Melihat Feedback
```

## ⚙️ Konfigurasi Penting

### Upload File Limit

Edit di `application/controllers/Siswa.php` (line ~140):

```php
$config['max_size'] = 5048; // Dalam KB, ubah sesuai kebutuhan
```

### Session Timeout

Edit di `application/config/config.php`:

```php
$config['sess_expiration'] = 7200; // Dalam detik
```

## 🐛 Troubleshooting

### Database Connection Error

- Pastikan XAMPP MySQL sudah berjalan
- Cek `application/config/database.php` sudah benar
- Cek username/password database

### Upload Folder Permission Denied

```bash
chmod 777 uploads/
chmod 777 uploads/aspirasi/
chmod 777 uploads/feedback/
```

### CSRF Token Error

- Pastikan session sudah enable
- Clear browser cache dan cookies

### Page Not Found

- Pastikan .htaccess sudah di-setup dengan benar
- Atau gunakan URL dengan index.php:
  `http://localhost/ukk_papss/index.php/siswa`

## 📞 Support

Untuk pertanyaan atau bug report, silakan hubungi tim development.

## 📄 Lisensi

Private project untuk Ujian Kompetensi Keahlian (UKK) 2025/2026

---

**Created**: January 2026  
**Framework**: CodeIgniter 3.1  
**Version**: 1.0
