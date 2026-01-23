# DATABASE STRUCTURE - TRIADU

## 📊 Entity Relationship Diagram (ERD)

```
┌─────────────────────┐
│      ADMIN          │
├─────────────────────┤
│ PK id_admin (INT)   │
│    username (VARCHAR)│
│    password (VARCHAR)│
└─────────────────────┘

┌─────────────────────────┐
│      SISWA              │
├─────────────────────────┤
│ PK nis (VARCHAR)        │
│    kelas (VARCHAR)      │
└─────────────────────────┘
         ▲
         │ FK (aspirasi.nis)
         │
┌────────────────────────────────────────┐
│          ASPIRASI                      │
├────────────────────────────────────────┤
│ PK id_aspirasi (INT)                   │
│ FK nis (INT) → SISWA.nis               │
│ FK id_kategori (INT) → KATEGORI.*      │
│    lokasi (VARCHAR)                    │
│    keterangan (TEXT)                   │
│    gambar (VARCHAR) [nullable]         │
│    tanggal (DATETIME)                  │
│    status (ENUM: Menunggu/Proses/Selesai)
│    feedback (TEXT) [nullable]          │
│    feedback_gambar (VARCHAR) [nullable]│
└────────────────────────────────────────┘
         ▲
         │ FK (aspirasi.id_kategori)
         │
┌──────────────────────────┐
│      KATEGORI            │
├──────────────────────────┤
│ PK id_kategori (INT)     │
│    nama_kategori (VARCHAR)
└──────────────────────────┘
```

## 📋 Table Details

### 1. TABLE: ADMIN

**Purpose**: Menyimpan akun admin untuk login

```sql
CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

**Fields:**
| Field | Type | Constraint | Description |
|-------|------|-----------|-------------|
| id_admin | INT | PRIMARY KEY, AUTO_INCREMENT | ID admin unik |
| username | VARCHAR(50) | NOT NULL, UNIQUE INDEX | Username untuk login |
| password | VARCHAR(255) | NOT NULL | Password hashed (MD5) |

**Relationships:**

- Tidak memiliki FK ke table lain
- Username berfungsi sebagai unique identifier

**Sample Data:**

```
id_admin = 1
username = admin
password = 0192023a7bbd73250516f069df18b500 (md5: admin)
```

---

### 2. TABLE: SISWA

**Purpose**: Menyimpan data siswa yang bisa login dan kirim aspirasi

```sql
CREATE TABLE `siswa` (
  `nis` varchar(20) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

**Fields:**
| Field | Type | Constraint | Description |
|-------|------|-----------|-------------|
| nis | VARCHAR(20) | PRIMARY KEY | Nomor Induk Siswa (format: X.XXXX.XX) |
| kelas | VARCHAR(10) | NOT NULL | Kelas siswa (format: XII-RPL-1) |

**Relationships:**

- PRIMARY KEY: nis
- Has many ASPIRASI (One-to-Many)

**Format Validation:**

- **NIS**: `X.XXXX.XX` (contoh: R.0278.23)
  - X = Satu huruf (R, S, T, dll)
  - XXXX = 4 digit (0000-9999)
  - XX = 2 digit tahun (23, 24, dll)
- **Kelas**: `XII-RPL-1` (contoh: XII-RPL-1)
  - XII = Tingkat kelas (X, XI, XII)
  - RPL = Jurusan (RPL, TKJ, MM, dll)
  - 1 = Urutan kelas (1, 2, 3, dll)

**Sample Data:**

```
nis = R.0278.23, kelas = XII-RPL-1
nis = R.0001.23, kelas = XII-RPL-1
nis = R.0003.23, kelas = XII-RPL-2
(... total 6 sample siswa)
```

---

### 3. TABLE: KATEGORI

**Purpose**: Menyimpan kategori-kategori aspirasi (misal: Ruangan Kelas, Lab, dll)

```sql
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

**Fields:**
| Field | Type | Constraint | Description |
|-------|------|-----------|-------------|
| id_kategori | INT | PRIMARY KEY, AUTO_INCREMENT | ID kategori unik |
| nama_kategori | VARCHAR(50) | NOT NULL | Nama kategori |

**Relationships:**

- PRIMARY KEY: id_kategori
- Referenced by ASPIRASI.id_kategori (One-to-Many)

**Sample Data:**

```
1 = Ruangan Kelas
2 = Laboratorium
3 = Perpustakaan
4 = Kantin
5 = Toilet
6 = Lapangan
7 = Peralatan
8 = Lainnya
```

**Business Rules:**

- Tidak bisa dihapus jika masih ada aspirasi yang pakai kategori ini
- Bisa diedit namanya

---

### 4. TABLE: ASPIRASI

**Purpose**: Menyimpan aspirasi/pengaduan siswa tentang sarana

```sql
CREATE TABLE `aspirasi` (
  `id_aspirasi` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(20) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `status` enum('Menunggu','Proses','Selesai') DEFAULT 'Menunggu',
  `feedback` text DEFAULT NULL,
  `feedback_gambar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_aspirasi`),
  KEY `nis` (`nis`),
  KEY `id_kategori` (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

**Fields:**
| Field | Type | Constraint | Description |
|-------|------|-----------|-------------|
| id_aspirasi | INT | PRIMARY KEY, AUTO_INCREMENT | ID aspirasi unik |
| nis | VARCHAR(20) | FOREIGN KEY | Referensi ke SISWA.nis |
| id_kategori | INT | FOREIGN KEY | Referensi ke KATEGORI.id_kategori |
| lokasi | VARCHAR(100) | - | Lokasi masalah (misal: Ruang Lab Komputer B) |
| keterangan | TEXT | - | Deskripsi detail aspirasi |
| gambar | VARCHAR(255) | NULLABLE | Nama file gambar aspirasi |
| tanggal | DATETIME | DEFAULT CURRENT_TIMESTAMP | Waktu aspirasi dikirim |
| status | ENUM | DEFAULT 'Menunggu' | Status: Menunggu/Proses/Selesai |
| feedback | TEXT | NULLABLE | Balasan/umpan balik dari admin |
| feedback_gambar | VARCHAR(255) | NULLABLE | Nama file gambar feedback admin |

**Relationships:**

- PRIMARY KEY: id_aspirasi
- FOREIGN KEY nis → SISWA.nis (Many-to-One)
- FOREIGN KEY id_kategori → KATEGORI.id_kategori (Many-to-One)

**Status Workflow:**

```
Menunggu (Initial)
    ↓ (Admin review)
Proses (Admin memberikan feedback)
    ↓ (Admin done)
Selesai (Completed)
```

**File Storage:**

- **gambar**: Disimpan di `/uploads/aspirasi/` dengan nama terenkripsi
- **feedback_gambar**: Disimpan di `/uploads/feedback/` dengan nama terenkripsi

---

## 🔄 Data Flow

### Saat Siswa Mengirim Aspirasi:

```
1. Siswa login dengan NIS + Kelas
2. Validasi kombinasi unik di table SISWA
3. Siswa isi form:
   - Pilih kategori (id_kategori)
   - Masukkan lokasi
   - Tulis keterangan
   - Upload gambar (optional)
4. Data disimpan ke table ASPIRASI:
   - nis = dari session
   - id_kategori = dari form
   - lokasi = dari form
   - keterangan = dari form
   - gambar = nama file terenkripsi
   - tanggal = current timestamp
   - status = "Menunggu"
5. Siswa bisa lihat aspirasi di halaman "Aspirasi Saya"
```

### Saat Admin Edit Aspirasi:

```
1. Admin lihat list aspirasi dari table ASPIRASI
2. Admin klik edit aspirasi tertentu
3. Admin bisa ubah:
   - status (Menunggu → Proses → Selesai)
   - feedback (tulis balasan)
   - feedback_gambar (upload bukti)
4. Data di-update di table ASPIRASI:
   - status = nilai baru
   - feedback = balasan admin
   - feedback_gambar = nama file terenkripsi
5. Siswa bisa lihat feedback di halaman mereka
```

---

## 📈 Database Queries

### Query untuk Dashboard Admin:

```sql
-- Total aspirasi
SELECT COUNT(*) as total FROM aspirasi;

-- Aspirasi berdasarkan status
SELECT COUNT(*) as menunggu FROM aspirasi WHERE status = 'Menunggu';
SELECT COUNT(*) as proses FROM aspirasi WHERE status = 'Proses';
SELECT COUNT(*) as selesai FROM aspirasi WHERE status = 'Selesai';

-- List aspirasi dengan detail
SELECT
    a.id_aspirasi,
    a.nis,
    s.kelas,
    a.lokasi,
    k.nama_kategori,
    a.tanggal,
    a.status
FROM aspirasi a
LEFT JOIN siswa s ON a.nis = s.nis
LEFT JOIN kategori k ON a.id_kategori = k.id_kategori
ORDER BY a.tanggal DESC;
```

### Query untuk Siswa:

```sql
-- Aspirasi siswa tertentu
SELECT * FROM aspirasi
WHERE nis = 'R.0278.23'
ORDER BY tanggal DESC;

-- Semua aspirasi publik (dengan detail)
SELECT
    a.*,
    s.kelas,
    k.nama_kategori
FROM aspirasi a
LEFT JOIN siswa s ON a.nis = s.nis
LEFT JOIN kategori k ON a.id_kategori = k.id_kategori
ORDER BY a.tanggal DESC;
```

---

## 🔐 Database Security

### File Permissions:

```bash
chmod 755 /uploads/aspirasi/
chmod 755 /uploads/feedback/
```

### User Privileges (Recommended):

```sql
-- Production user dengan limited permissions
CREATE USER 'app_user'@'localhost' IDENTIFIED BY 'strong_password';
GRANT SELECT, INSERT, UPDATE, DELETE ON ukk_papss.* TO 'app_user'@'localhost';
FLUSH PRIVILEGES;
```

### Constraints Implementation:

```sql
-- Foreign Key constraints bisa ditambahkan untuk integritas data
ALTER TABLE aspirasi ADD CONSTRAINT fk_aspirasi_nis
FOREIGN KEY (nis) REFERENCES siswa(nis) ON DELETE CASCADE;

ALTER TABLE aspirasi ADD CONSTRAINT fk_aspirasi_kategori
FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori) ON DELETE SET NULL;
```

---

## 📊 Database Statistics

### Current Database Size:

- Tables: 4 (admin, siswa, kategori, aspirasi)
- Initial Data:
  - Admin: 1 record
  - Siswa: 6 records
  - Kategori: 8 records
  - Aspirasi: 0 records (akan bertambah saat siswa mengirim)

### Estimated Size per Aspirasi:

- Database row: ~500 bytes
- Average image: ~2-5 MB
- Total per aspirasi: ~2.5-5 MB

---

## 🔄 Maintenance

### Regular Backups:

```bash
# Backup command
mysqldump -u root -p ukk_papss > backup_$(date +%Y%m%d).sql

# Restore command
mysql -u root -p ukk_papss < backup_20260120.sql
```

### Cleanup Old Files:

```php
// Hapus file gambar yang sudah 30 hari
$files = glob('./uploads/aspirasi/*');
foreach ($files as $file) {
    if (time() - filemtime($file) > 30*24*60*60) {
        unlink($file);
    }
}
```

---

**Database Version**: 1.0
**Last Updated**: January 2026
**Engine**: InnoDB with UTF-8mb4 charset
