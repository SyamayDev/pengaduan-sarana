<!-- Dashboard Aspirasi Siswa - Halaman Utama -->
<div class="row" data-aos="fade-up">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0">
                <i class="fas fa-list-ul me-2"></i> Semua Aspirasi
            </h2>
            <?php if ($this->session->userdata('siswa')): ?>
                <a href="<?= base_url('siswa/logout') ?>" class="btn btn-sm btn-danger">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
            <?php else: ?>
                <button type="button" class="btn btn-sm btn-primary" id="loginBtn" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>

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
                        <p class="card-text text-muted" style="font-size: 0.9rem; min-height: 60px;">
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

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="loginModalLabel">
                    <i class="fas fa-sign-in-alt me-2"></i> Login Siswa
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('siswa/login') ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

                    <div class="mb-3">
                        <label for="login_nis" class="form-label">NIS</label>
                        <input type="text" class="form-control" id="login_nis" name="nis"
                            placeholder="Contoh: R.0278.23" required>
                        <small class="text-muted d-block mt-1">Format: Huruf.XXXX.XX</small>
                    </div>

                    <div class="mb-3">
                        <label for="login_kelas" class="form-label">Kelas</label>
                        <input type="text" class="form-control" id="login_kelas" name="kelas"
                            placeholder="Contoh: XII-RPL-1" required>
                        <small class="text-muted d-block mt-1">Format: XII-RPL-1</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-2"></i> Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .badge-selesai {
        background-color: #10B981 !important;
        color: white !important;
    }

    .badge-proses {
        background-color: #F59E0B !important;
        color: white !important;
    }

    .badge-menunggu {
        background-color: #9ca3af !important;
        color: white !important;
    }
</style>