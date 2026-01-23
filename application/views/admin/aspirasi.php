<div class="row">
    <div class="col-12">
        <!-- Filter Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-filter mr-2"></i>Filter Aspirasi</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="<?= base_url('admin/aspirasi') ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="status" onchange="this.form.submit()">
                                    <option value="">Semua Status</option>
                                    <option value="Menunggu" <?= ($this->input->get('status') == 'Menunggu') ? 'selected' : '' ?>>Menunggu</option>
                                    <option value="Proses" <?= ($this->input->get('status') == 'Proses') ? 'selected' : '' ?>>Proses</option>
                                    <option value="Selesai" <?= ($this->input->get('status') == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Aspirasi Table Card -->
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list mr-2"></i>Daftar Aspirasi</h3>
                <div class="card-tools">
                    <span class="badge badge-info"><?= count($aspirasi) ?> Total</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Siswa</th>
                                <th>Lokasi</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($aspirasi)): ?>
                                <?php $no = 1; foreach ($aspirasi as $a): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <strong><?= htmlspecialchars($a->nis) ?></strong><br>
                                            <small class="text-muted"><?= htmlspecialchars($a->kelas) ?></small>
                                        </td>
                                        <td><?= htmlspecialchars($a->lokasi) ?></td>
                                        <td>
                                            <span class="badge badge-secondary"><?= htmlspecialchars($a->nama_kategori ?? 'Umum') ?></span>
                                        </td>
                                        <td>
                                            <details>
                                                <summary><?= substr(htmlspecialchars($a->keterangan), 0, 50) ?>...</summary>
                                                <p><?= nl2br(htmlspecialchars($a->keterangan)) ?></p>
                                            </details>
                                        </td>
                                        <td>
                                            <?php
                                                $status_class = 'secondary';
                                                if ($a->status == 'Selesai') $status_class = 'success';
                                                else if ($a->status == 'Proses') $status_class = 'warning';
                                                else if ($a->status == 'Menunggu') $status_class = 'info';
                                            ?>
                                            <span class="badge badge-<?= $status_class ?>"><?= $a->status ?></span>
                                        </td>
                                        <td><?= date('d M Y', strtotime($a->tanggal)) ?></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="<?= base_url('admin/edit_aspirasi/' . $a->id_aspirasi) ?>" class="btn btn-warning" title="Proses & Feedback">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('admin/delete_aspirasi/' . $a->id_aspirasi) ?>" class="btn btn-danger" title="Hapus" onclick="return confirm('Yakin hapus aspirasi ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <i class="fas fa-inbox fa-2x text-muted"></i>
                                        <p class="mt-2 text-muted">Tidak ada aspirasi untuk status ini.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>