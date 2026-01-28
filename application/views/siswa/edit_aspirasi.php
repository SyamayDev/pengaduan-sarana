<div class="container mt-4" data-aos="zoom-in-up">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Aspirasi</h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('siswa/update_aspirasi') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_aspirasi" value="<?= htmlspecialchars($aspirasi->id_aspirasi) ?>">

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori...</option>
                                <?php foreach ($kategori as $k): ?>
                                    <option value="<?= htmlspecialchars($k->id_kategori) ?>" <?= ($k->id_kategori == $aspirasi->id_kategori) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($k->nama_kategori) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= htmlspecialchars($aspirasi->lokasi) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="5" required><?= htmlspecialchars($aspirasi->keterangan) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Ubah Gambar (Opsional)</label>
                            <input class="form-control" type="file" id="gambar" name="gambar">
                            <?php if ($aspirasi->gambar): ?>
                                <div class="mt-2">
                                    <small>Gambar saat ini:</small>
                                    <img src="<?= base_url('uploads/aspirasi/' . htmlspecialchars($aspirasi->gambar)) ?>" alt="Gambar Aspirasi" class="img-thumbnail mt-1" style="max-height: 150px;">
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="<?= base_url('siswa/my_aspirasi') ?>" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
