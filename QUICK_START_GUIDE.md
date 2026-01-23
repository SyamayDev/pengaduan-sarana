# 🚀 QUICK START GUIDE - TRIADU

## Setup Cepat dalam 5 Menit

### Step 1: Import Database (30 detik)

1. Buka http://localhost/phpmyadmin
2. Klik "New" untuk membuat database baru
3. Nama database: `ukk_papss` → Create
4. Pilih database `ukk_papss`
5. Klik tab "Import"
6. Pilih file: `database/ukk_papss.sql`
7. Klik "Import"
8. ✅ Database sudah ready!

### Step 2: Jalankan Aplikasi (10 detik)

```
http://localhost/ukk_papss/
```

## 🔑 Login Information

### Admin Panel

- **URL**: http://localhost/ukk_papss/admin
- **Username**: `admin`
- **Password**: `admin`

### Siswa Dashboard

- **URL**: http://localhost/ukk_papss/siswa
- **Contoh NIS**: `R.0278.23`
- **Contoh Kelas**: `XII-RPL-1`

### Data Siswa Sample yang Tersedia:

```
NIS: R.0001.23, Kelas: XII-RPL-1
NIS: R.0002.23, Kelas: XII-RPL-1
NIS: R.0003.23, Kelas: XII-RPL-2
NIS: R.0004.23, Kelas: XII-RPL-2
NIS: R.0005.23, Kelas: XII-TKJ-1
NIS: R.0278.23, Kelas: XII-RPL-1
```

## 📱 Main Features

### Untuk Siswa:

| Fitur              | URL                  | Deskripsi                            |
| ------------------ | -------------------- | ------------------------------------ |
| Dashboard Aspirasi | `/siswa`             | Lihat semua aspirasi                 |
| Aspirasi Saya      | `/siswa/my_aspirasi` | Aspirasi yang dikirim siswa          |
| Tambah Aspirasi    | `/siswa/tambah`      | Form tambah aspirasi (require login) |
| Login              | Form modal           | Login dengan NIS + Kelas             |
| Logout             | `/siswa/logout`      | Keluar dari sistem                   |

### Untuk Admin:

| Fitur           | URL                         | Deskripsi                      |
| --------------- | --------------------------- | ------------------------------ |
| Dashboard       | `/admin/dashboard`          | Statistik dan summary aspirasi |
| Kelola Aspirasi | `/admin/aspirasi`           | List, edit, hapus aspirasi     |
| Edit Aspirasi   | `/admin/edit_aspirasi/{id}` | Beri feedback & ubah status    |
| Kategori        | `/admin/kategori`           | CRUD kategori aspirasi         |
| Siswa           | `/admin/siswa`              | CRUD data siswa                |
| Logout          | `/admin/logout`             | Keluar dari sistem             |

## 🎯 Workflow Contoh

### Sebagai Siswa:

1. Buka http://localhost/ukk_papss/siswa
2. Lihat aspirasi dari siswa lain
3. Klik tombol "+" (floating button) untuk tambah aspirasi
4. Muncul modal login
5. Masukkan NIS: `R.0278.23` dan Kelas: `XII-RPL-1`
6. Login berhasil → Redirect ke form tambah aspirasi
7. Isi form:
   - Kategori: Pilih salah satu
   - Lokasi: Contoh "Ruang Lab Komputer B"
   - Keterangan: Jelaskan masalahnya
   - Foto: Optional, bisa upload gambar
8. Klik "Kirim Aspirasi"
9. Lihat di halaman "Aspirasi Saya"

### Sebagai Admin:

1. Login ke http://localhost/ukk_papss/admin
   - Username: `admin`, Password: `admin`
2. Dashboard menampilkan statistik
3. Ke "Kelola Aspirasi" untuk melihat list
4. Klik Edit pada aspirasi tertentu
5. Ubah status menjadi "Proses"
6. Tulis feedback/balasan
7. Upload gambar bukti (optional)
8. Save
9. Siswa akan melihat feedback di halaman mereka

## 📁 Important Folders & Files

```
✅ READY TO USE:
✓ application/      - Controllers, Models, Views
✓ assets/          - AdminLTE v4, CSS, JS
✓ database/        - SQL dump dengan data
✓ uploads/         - Folder untuk gambar (auto-created)

⚙️ CONFIGURATION:
- application/config/database.php (sudah OK)
- application/config/routes.php (sudah OK)
- application/config/config.php (sudah OK)

🔒 SECURITY:
- uploads/.htaccess (melarang PHP execution)
- Password admin: MD5 hash
- CSRF protection: Aktif di semua form
```

## 🐛 If Something Goes Wrong

### Problem: White Screen / Error 500

```
Solution:
1. Cek folder uploads punya write permission
2. Buka error log: application/logs/
3. Cek database connection
```

### Problem: Database Connection Error

```
Solution:
1. Pastikan MySQL sudah running di XAMPP
2. Edit application/config/database.php:
   - hostname: localhost
   - username: root
   - password: (kosong)
   - database: ukk_papss
3. Restart XAMPP
```

### Problem: Upload Tidak Bisa

```
Solution:
chmod 755 uploads/
chmod 755 uploads/aspirasi/
chmod 755 uploads/feedback/
```

### Problem: CSRF Token Error

```
Solution:
1. Clear browser cache
2. Hapus cookies
3. Refresh halaman
```

## 💡 Tips & Tricks

### Add More Students:

1. Login ke admin
2. Ke menu "Kelola Siswa"
3. Klik "Tambah Siswa"
4. Isi NIS format: `X.XXXX.XX` (misal: S.0100.23)
5. Isi Kelas format: `XII-RPL-1`
6. Save

### Add More Categories:

1. Login ke admin
2. Ke menu "Kategori"
3. Klik "Tambah Kategori"
4. Isi nama kategori (misal: "Asrama", "Aula", etc)
5. Save

### View All Uploads:

- Aspirasi gambar: `/uploads/aspirasi/`
- Feedback gambar: `/uploads/feedback/`
- Bisa lihat langsung atau download dari halaman

## 📊 Default Data

### Admin Account:

```
Username: admin
Password: admin (MD5: 0192023a7bbd73250516f069df18b500)
```

### Categories (sudah ada 8):

1. Ruangan Kelas
2. Laboratorium
3. Perpustakaan
4. Kantin
5. Toilet
6. Lapangan
7. Peralatan
8. Lainnya

### Students (sample 6):

- R.0001.23 (XII-RPL-1)
- R.0002.23 (XII-RPL-1)
- R.0003.23 (XII-RPL-2)
- R.0004.23 (XII-RPL-2)
- R.0005.23 (XII-TKJ-1)
- R.0278.23 (XII-RPL-1)

## ✨ Browser Support

- ✅ Chrome (latest)
- ✅ Firefox (latest)
- ✅ Safari (latest)
- ✅ Edge (latest)
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)

## 🎨 Key Features Showcase

### Responsive Design:

- Desktop: Full layout dengan sidebar
- Tablet: Optimized grid system
- Mobile: Hamburger menu, full-width cards

### Animations:

- Smooth fade-in saat load halaman
- Hover effects pada button
- Smooth transitions

### Dark/Light Mode:

- AdminLTE v4 support dark mode
- Automatic based on system preferences

## 📞 Need Help?

Cek file dokumentasi:

- `README_TRIADU.md` - Dokumentasi lengkap
- `SECURITY_DOCUMENTATION.md` - Security details
- `QUICK_START_GUIDE.md` - File ini

---

**Happy Testing!** 🎉

Jika ada pertanyaan atau bug, silakan cek documentation files atau cek code comments.

_Version 1.0 - January 2026_
