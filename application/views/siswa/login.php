<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - TRIADU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            max-width: 450px;
            width: 100%;
        }
        .form-control:focus, .form-select:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
        }
        .btn-success {
            background-color: #198754;
            border-color: #198754;
        }
        .btn-success:hover {
            background-color: #157347;
            border-color: #157347;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img src="<?= base_url('assets/images/logo.webp') ?>" alt="Logo" style="max-height: 50px;">
                        <h1 class="h3 my-3 fw-normal">Login Siswa</h1>
                        <p class="text-muted">Masukkan NIS dan Kelas untuk membuat atau melihat aduan.</p>
                    </div>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('siswa/login') ?>" method="POST">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nis" name="nis" placeholder="NIS" required autofocus>
                            <label for="nis">NIS (Nomor Induk Siswa)</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Kelas" required>
                            <label for="kelas">Kelas</label>
                        </div>

                        <button class="w-100 btn btn-lg btn-success" type="submit">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="<?= base_url() ?>" class="text-decoration-none">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Halaman Utama
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>