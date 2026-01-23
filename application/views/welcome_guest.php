<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Pengaduan Sarana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #f8f9fa;
        }
        .navbar-brand img {
            max-height: 40px;
        }
        .fab {
            position: fixed;
            bottom: 40px;
            right: 40px;
            width: 70px;
            height: 70px;
            background-color: #198754; /* Green */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            transition: all 0.3s ease-in-out;
            z-index: 1000;
        }
        .fab:hover {
            background-color: #157347;
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(0,0,0,0.3);
        }
        .fab i {
            color: #fff;
            font-size: 28px;
        }
        .aspirasi-card {
            border: none;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .aspirasi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1) !important;
        }
        .aspirasi-img {
            height: 200px;
            object-fit: cover;
        }
        .status-badge {
            font-size: 0.8rem;
            padding: 0.5em 0.8em;
        }
        .feedback-card {
            background-color: #e9f5ff;
            border-color: #bde0fe;
        }
    </style>
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url() ?>">
                    <img src="<?= base_url('assets/images/logo.webp') ?>" alt="Logo" class="d-inline-block align-text-top me-2">
                    <span class="fw-bold" >TRIADU</span>
                </a>
                <div class="ms-auto">
                    <a href="<?= base_url('admin') ?>" class="btn btn-outline-success"><i class="fas fa-user-lock me-2"></i>Login Admin</a>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Daftar Aspirasi & Pengaduan</h2>

            <div class="row g-4">
                <?php if (!empty($aspirasi)): ?>
                    <?php foreach ($aspirasi as $a): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 shadow-sm aspirasi-card">
                                <?php if (!empty($a->gambar)): ?>
                                    <img src="<?= base_url('uploads/aspirasi/' . $a->gambar) ?>" class="card-img-top aspirasi-img" alt="Gambar Aspirasi">
                                <?php endif; ?>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-muted"><?= htmlspecialchars($a->nama_kategori ?? 'Tidak ada kategori') ?></small>
                                        <small class="text-muted"><?= date('d M Y', strtotime($a->tanggal)) ?></small>
                                    </div>
                                    <h5 class="card-title"><?= htmlspecialchars($a->lokasi) ?></h5>
                                    <p class="card-text text-muted_"><?= htmlspecialchars($a->keterangan) ?></p>
                                    
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <span class="badge status-badge rounded-pill text-white 
                                                    <?= ($a->status == 'Selesai') ? 'bg-success' : (($a->status == 'Proses') ? 'bg-primary' : 'bg-warning') ?>">
                                                    <i class="fas fa-circle-notch fa-spin me-1"></i><?= $a->status ?>
                                                </span>
                                            </div>
                                        </div>

                                        <?php if ($a->status == 'Selesai' && !empty($a->feedback)): ?>
                                            <div class="card feedback-card mt-3">
                                                <div class="card-body">
                                                    <p class="card-text mb-1 fw-bold">Feedback:</p>
                                                    <p class="card-text small"><?= htmlspecialchars($a->feedback) ?></p>
                                                     <?php if (!empty($a->feedback_gambar)): ?>
                                                        <a href="<?= base_url('uploads/feedback/' . $a->feedback_gambar) ?>" target="_blank">Lihat gambar feedback</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada aspirasi yang disampaikan.</h4>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <a href="<?= base_url('siswa/login_page') ?>" class="fab" title="Buat Aduan / Login Siswa">
        <i class="fas fa-plus"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
