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
            background-color: #198754;
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
        .card-aspirasi {
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-aspirasi:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }
        .image-container {
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6;
        }
        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .badge-menunggu { background-color: #f59e0b; color: white; }
        .badge-proses { background-color: #3b82f6; color: white; }
        .badge-selesai { background-color: #10b981; color: white; }
        .feedback-section {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px dashed #e5e7eb;
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


<?php if (!empty($aspirasi)): ?>
    <div class="row">
        <?php foreach ($aspirasi as $a): ?>
            <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="<?= rand(100, 300) ?>">
                <div class="card card-aspirasi h-100">
                    <!-- Image Section -->
                    <?php if ($a->gambar): ?>
                        <div class="image-container">
                            <img src="<?= base_url('uploads/aspirasi/' . htmlspecialchars($a->gambar)) ?>"
                                alt="<?= htmlspecialchars($a->lokasi) ?>"
                                loading="lazy">
                        </div>
                    <?php else: ?>
                        <div class="image-container" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <i class="fas fa-image" style="font-size: 3rem; color: rgba(255,255,255,0.3);"></i>
                        </div>
                    <?php endif; ?>

                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Location & Category -->
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0" style="max-width: 70%;">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                <?= htmlspecialchars($a->lokasi) ?>
                            </h5>
                            <span class="badge badge-<?=
                                                        ($a->status == 'Selesai' ? 'selesai' : ($a->status == 'Proses' ? 'proses' : 'menunggu'))
                                                        ?>">
                                <?= $a->status ?>
                            </span>
                        </div>

                        <!-- Category Badge -->
                        <p class="mb-2">
                            <small class="badge bg-light text-dark">
                                <i class="fas fa-tag me-1"></i> <?= htmlspecialchars($a->nama_kategori ?? 'Umum') ?>
                            </small>
                        </p>

                        <!-- Description -->
                        <p class="card-text text-muted" style="font-size: 0.9rem; min-height: 10px;">
                            <?= substr(htmlspecialchars($a->keterangan), 0, 100) ?>
                            <?php if (strlen($a->keterangan) > 100): ?>...<?php endif; ?>
                        </p>

                        <!-- Meta Info -->
                        <div class="mb-2 pb-2" style="border-bottom: 1px solid #e5e7eb;">
                            <small class="text-muted d-block">
                                <i class="fas fa-user me-1"></i>
                                <strong><?= htmlspecialchars($a->nis) ?></strong>
                                (<?= htmlspecialchars($a->kelas) ?>)
                            </small>
                            <small class="text-muted d-block">
                                <i class="fas fa-calendar me-1"></i>
                                <?= date('d M Y H:i', strtotime($a->tanggal)) ?>
                            </small>
                        </div>

                        <!-- Feedback Section -->
                        <?php if ($a->feedback): ?>
                            <div class="feedback-section">
                                <strong class="d-block mb-2">
                                    <i class="fas fa-reply text-success me-1"></i> Umpan Balik
                                </strong>
                                <p class="mb-2" style="font-size: 0.85rem;">
                                    <?= nl2br(htmlspecialchars(substr($a->feedback, 0, 150))) ?>
                                    <?php if (strlen($a->feedback) > 150): ?><br><small class="text-primary">...selengkapnya</small><?php endif; ?>
                                </p>
                                <?php if ($a->feedback_gambar): ?>
                                    <img src="<?= base_url('uploads/feedback/' . htmlspecialchars($a->feedback_gambar)) ?>"
                                        alt="Feedback"
                                        class="img-fluid rounded mt-2"
                                        style="max-height: 200px; width: 100%; object-fit: cover;"
                                        loading="lazy">
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-12">
            <div class="card text-center py-5">
                <div class="card-body">
                    <i class="fas fa-inbox" style="font-size: 4rem; color: #d1d5db; margin-bottom: 1rem;"></i>
                    <h5 class="text-muted">Belum ada aspirasi</h5>
                    <p class="text-muted mb-3">Jadilah yang pertama memberikan aspirasi!</p>
                    <?php if ($this->session->userdata('siswa')): ?>
                        <a href="<?= base_url('siswa/tambah') ?>" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i> Tambah Aspirasi
                        </a>
                    <?php else: ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


        </div>
    </main>

    <a href="<?= base_url('siswa/login_page') ?>" class="fab" title="Buat Aduan / Login Siswa">
        <i class="fas fa-plus"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>