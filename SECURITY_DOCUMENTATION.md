# DOKUMENTASI KEAMANAN - TRIADU

## 🔐 Implementasi Keamanan Aplikasi

### 1. AUTHENTICATION & AUTHORIZATION

#### Admin Authentication

```php
// File: application/controllers/Admin.php
public function login() {
    $username = $this->input->post('username', TRUE);
    $password = $this->input->post('password');

    $admin = $this->admin_model->login($username);

    if ($admin && md5($password) == $admin->password) {
        $this->session->set_userdata('admin', $admin);
        redirect('admin/dashboard');
    } else {
        $this->session->set_flashdata('error', 'Username atau password salah!');
        redirect('admin');
    }
}
```

**Security Features:**

- Password di-hash dengan MD5
- Session-based authentication
- CSRF token pada setiap form

#### Siswa Authentication

```php
// Format NIS: R.0278.23
// Format Kelas: XII-RPL-1
// Divalidasi dengan regex pattern
```

**Security Features:**

- Format NIS dan Kelas divalidasi dengan strict pattern
- Kombinasi NIS + Kelas yang unik per siswa
- Session-based login

#### Login Check

```php
private function _check_login() {
    if (!$this->session->userdata('admin')) {
        redirect('admin');
    }
}
```

### 2. INPUT VALIDATION & SANITIZATION

#### Input Sanitization

```php
// Tipe pertama: Menggunakan second parameter TRUE
$username = $this->input->post('username', TRUE);
// Ini melakukan XSS filtering

// Tipe kedua: Manual sanitization
echo htmlspecialchars($a->keterangan);
// Mencegah XSS attack
```

#### Server-side Validation

```php
// File: application/controllers/Siswa.php
if (empty($kategori) || empty($lokasi) || empty($keterangan)) {
    $this->session->set_flashdata('error', 'Data harus diisi!');
    redirect('siswa/tambah');
}

// Validasi format NIS
if (!preg_match('/^[A-Z]\.\d{4}\.\d{2}$/', $nis)) {
    $this->session->set_flashdata('error', 'Format NIS salah!');
    redirect('siswa');
}

// Validasi format Kelas
if (!preg_match('/^[A-Z0-9]+-[A-Z]+-\d+$/', $kelas)) {
    $this->session->set_flashdata('error', 'Format Kelas salah!');
    redirect('siswa');
}
```

#### Client-side Validation

```html
<!-- HTML5 Pattern Validation -->
<input
	type="text"
	name="nis"
	pattern="[A-Z]\.\d{4}\.\d{2}"
	title="Format: R.0278.23"
	required
/>
```

### 3. FILE UPLOAD SECURITY

#### File Upload Configuration

```php
// File: application/controllers/Siswa.php (line ~140)
$config['upload_path'] = './uploads/aspirasi/';
$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
$config['max_size'] = 5048; // 5MB
$config['encrypt_name'] = TRUE; // Random filename

$this->upload->initialize($config);

if ($this->upload->do_upload('gambar')) {
    $gambar = $this->upload->data('file_name');
} else {
    $this->session->set_flashdata('error', $this->upload->display_errors());
    redirect('siswa/tambah');
}
```

**Security Features:**

- Whitelist MIME types (jpg, jpeg, png, gif, webp)
- Max size limit 5MB
- Filename di-encrypt (random)
- Directory protection dengan .htaccess

#### Directory Protection

```apache
# File: uploads/.htaccess
<FilesMatch "\.php$">
    Deny from all
</FilesMatch>

# File: uploads/aspirasi/.htaccess
<FilesMatch "\.php$">
    Deny from all
</FilesMatch>

# File: uploads/feedback/.htaccess
<FilesMatch "\.php$">
    Deny from all
</FilesMatch>
```

**Fungsi:**

- Mencegah eksekusi file PHP di folder uploads
- Proteksi dari shell upload

### 4. CSRF PROTECTION

#### CSRF Token di Form

```html
<!-- Semua form harus memiliki CSRF token -->
<form action="<?= base_url('siswa/login') ?>" method="POST">
	<input
		type="hidden"
		name="<?= $this->security->get_csrf_token_name() ?>"
		value="<?= $this->security->get_csrf_hash() ?>"
	/>
	<!-- form fields -->
</form>
```

**CodeIgniter CSRF Config:**

```php
// File: application/config/config.php
// Line ~352
$config['csrf_protection'] = TRUE;
$config['csrf_token_name'] = 'csrf_token_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
```

### 5. SQL INJECTION PREVENTION

#### Query Builder Usage

```php
// AMAN - Menggunakan Query Builder
$this->db->get_where('siswa', ['nis' => $nis]);

// AMAN - Where clause dengan binding
$this->db->where('nis', $nis)->delete('siswa');

// TIDAK DIREKOMENDASIKAN - Raw query
// $this->db->query("SELECT * FROM siswa WHERE nis = '" . $nis . "'");
```

#### Model Examples

```php
// File: application/models/Siswa_model.php
public function get_by_nis($nis) {
    return $this->db->get_where(self::TABLE, ['nis' => $nis])->row();
}

public function get_by_nis_and_class($nis, $kelas) {
    return $this->db->get_where(self::TABLE, ['nis' => $nis, 'kelas' => $kelas])->row();
}
```

**Security Features:**

- Menggunakan CodeIgniter Query Builder
- Semua parameter di-escape otomatis
- Prepared statements

### 6. LOGGING & MONITORING

#### Data Validation Log

```php
// Setiap aksi penting dicatat dalam session
$this->session->set_flashdata('success', 'Aspirasi berhasil dikirim!');
$this->session->set_flashdata('error', 'Username atau password salah!');
```

#### File Upload Log

```php
// Setiap upload dicatat di database (Optional)
// Bisa ditambahkan untuk audit trail
```

### 7. PASSWORD HASHING

#### Admin Password

```php
// Admin password hashed dengan MD5
INSERT INTO admin VALUES (1, 'admin', '0192023a7bbd73250516f069df18b500');
// Password: admin
// MD5: 0192023a7bbd73250516f069df18b500

// Login verification
if (md5($password) == $admin->password) {
    // Login sukses
}
```

**Catatan:**

- Untuk production, lebih baik gunakan `password_hash()` dan `password_verify()`
- MD5 sudah dianggap lemah, tapi sudah cukup untuk educational purpose

### 8. SESSION SECURITY

#### Session Configuration

```php
// File: application/config/config.php
$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200; // 2 jam
$config['sess_save_path'] = NULL;
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;
```

#### Session Usage

```php
// Set session saat login sukses
$this->session->set_userdata('admin', $admin);
$this->session->set_userdata('siswa', $siswa);

// Check session sebelum akses halaman protected
if (!$this->session->userdata('admin')) {
    redirect('admin');
}

// Destroy session saat logout
$this->session->unset_userdata('admin');
```

### 9. BUSINESS LOGIC SECURITY

#### Relasi Data Protection

```php
// Tidak bisa hapus kategori yang masih digunakan
$count = $this->db->where('id_kategori', $id)->count_all_results('aspirasi');
if ($count > 0) {
    $this->session->set_flashdata('error', 'Kategori tidak dapat dihapus!');
    redirect('admin/kategori');
}

// Tidak bisa hapus siswa yang punya aspirasi
$count = $this->db->where('nis', $nis)->count_all_results('aspirasi');
if ($count > 0) {
    $this->session->set_flashdata('error', 'Siswa tidak dapat dihapus!');
    redirect('admin/siswa');
}
```

#### Data Integrity

```php
// Validasi kategori yang dipilih
$kat = $this->kategori_model->get_by_id($kategori);
if (!$kat) {
    $this->session->set_flashdata('error', 'Kategori tidak valid!');
    redirect('siswa/tambah');
}

// Validasi siswa saat login
$siswa = $this->siswa_model->get_by_nis_and_class($nis, $kelas);
if (!$siswa) {
    $this->session->set_flashdata('error', 'NIS atau Kelas tidak ditemukan!');
    redirect('siswa');
}
```

### 10. DATABASE SECURITY

#### Prepared Statements (Query Builder)

```php
// CodeIgniter Query Builder otomatis menggunakan prepared statements
$this->db->where('nis', $nis)->where('kelas', $kelas)->get('siswa');

// Tidak perlu escape manual, tapi bisa juga:
$safe_nis = $this->db->escape($nis);
```

#### User Account

- Username: `root` (XAMPP default - ubah di production)
- Password: kosong (XAMPP default - ubah di production)

**Production Recommendation:**

```php
// Di production, gunakan user database dengan limited privileges
$db['production'] = array(
    'username' => 'app_user',
    'password' => 'strong_password_here',
    'database' => 'ukk_papss',
    // ...
);
```

## ✅ Security Checklist

- [x] Input validation & sanitization
- [x] CSRF protection
- [x] SQL injection prevention
- [x] File upload security
- [x] Password hashing
- [x] Session-based authentication
- [x] XSS protection (htmlspecialchars)
- [x] File directory protection (.htaccess)
- [x] Server-side validation
- [x] Client-side validation
- [x] Business logic validation
- [x] Error handling dengan flash data
- [x] Secure file naming (encrypted)
- [x] File size limit
- [x] MIME type whitelist

## 🚨 Potential Improvements untuk Production

1. **Replace MD5 dengan bcrypt/Argon2**

   ```php
   // Current
   md5($password) == $admin->password

   // Better
   password_verify($password, $admin->password)
   ```

2. **Add Rate Limiting untuk Login**

   ```php
   // Prevent brute force attack
   $attempts = $this->session->userdata('login_attempts');
   if ($attempts > 5) {
       // Block login untuk beberapa menit
   }
   ```

3. **Add HTTPS/SSL Certificate**

   ```php
   // Force HTTPS
   $config['base_url'] = 'https://yourdomain.com/';
   ```

4. **Database Query Logging**

   ```php
   $config['db_debug'] = TRUE; // Set to FALSE di production
   ```

5. **Add Encryption for Sensitive Data**

   ```php
   // Encrypt password sebelum disimpan
   $encrypted = $this->encryption->encrypt($sensitive_data);
   ```

6. **Implement API Rate Limiting**
   ```php
   // Limit file uploads per user
   ```

---

**Last Updated**: January 2026
**Security Level**: Educational (OK untuk UKK)
**Recommendation**: Upgrade ke production-ready security untuk deployment
