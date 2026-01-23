<!-- Admin Dashboard -->
<div class="row" data-aos="fade-up">
    <!-- Stats Cards -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-start border-primary border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-2" style="font-size: 0.9rem;">Total Aspirasi</p>
                        <h3 class="mb-0"><?= $total_aspirasi ?></h3>
                    </div>
                    <div style="font-size: 2.5rem; color: #3B82F6; opacity: 0.2;">
                        <i class="fas fa-comments"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-start border-warning border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-2" style="font-size: 0.9rem;">Menunggu</p>
                        <h3 class="mb-0" style="color: #F59E0B;"><?= $aspirasi_menunggu ?></h3>
                    </div>
                    <div style="font-size: 2.5rem; color: #F59E0B; opacity: 0.2;">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-start border-info border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-2" style="font-size: 0.9rem;">Proses</p>
                        <h3 class="mb-0" style="color: #0EA5E9;"><?= $aspirasi_proses ?></h3>
                    </div>
                    <div style="font-size: 2.5rem; color: #0EA5E9; opacity: 0.2;">
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-start border-success border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-2" style="font-size: 0.9rem;">Selesai</p>
                        <h3 class="mb-0" style="color: #10B981;"><?= $aspirasi_selesai ?></h3>
                    </div>
                    <div style="font-size: 2.5rem; color: #10B981; opacity: 0.2;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Aspirations -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card" data-aos="fade-up" data-aos-delay="100">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i> Aspirasi Terbaru
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">No.</th>
                                <th>NIS</th>
                                <th>Lokasi</th>
                                <th>Kategori</th>
                                <th style="width: 20%;">Keterangan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($aspirasi)): ?>
                                <?php $no = 1;
                                foreach ($aspirasi as $a): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <span class="badge bg-light text-dark"><?= htmlspecialchars($a->nis) ?></span>
                                        </td>
                                        <td><?= htmlspecialchars($a->lokasi) ?></td>
                                        <td><?= htmlspecialchars($a->nama_kategori ?? '-') ?></td>
                                        <td>
                                            <small><?= substr(htmlspecialchars($a->keterangan), 0, 30) ?>...</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-<?=
                                                                        ($a->status == 'Selesai' ? 'success' : ($a->status == 'Proses' ? 'info' : 'warning'))
                                                                        ?>">
                                                <?= $a->status ?>
                                            </span>
                                        </td>
                                        <td>
                                            <small><?= date('d/m/Y H:i', strtotime($a->tanggal)) ?></small>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('admin/edit_aspirasi/' . $a->id_aspirasi) ?>" class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox" style="font-size: 2rem; opacity: 0.3;"></i>
                                        <p>Belum ada aspirasi</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-light">
                <a href="<?= base_url('admin/aspirasi') ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-arrow-right me-2"></i> Lihat Semua
                </a>
                <a href="<?= base_url('admin/logout') ?>" class="btn btn-sm btn-danger float-end">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .badge-success {
        background-color: #10B981 !important;
    }

    .badge-info {
        background-color: #0EA5E9 !important;
    }

    .badge-warning {
        background-color: #F59E0B !important;
    }

    .border-primary {
        border-color: #3B82F6 !important;
    }

    .border-warning {
        border-color: #F59E0B !important;
    }

    .border-info {
        border-color: #0EA5E9 !important;
    }

    .border-success {
        border-color: #10B981 !important;
    }
</style>