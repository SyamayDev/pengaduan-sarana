<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card shadow-sm mb-4">
            <div class="card-body p-4">
                <h2 class="card-title text-center mb-4">Buat Aspirasi Baru</h2>
                
                <form action="<?= base_url('siswa/simpan') ?>" method="POST" enctype="multipart/form-data" id="formAspirasi">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

                    <div class="mb-4">
                        <label for="kategori" class="form-label fw-bold">Kategori</label>
                        <select class="form-select form-control" id="kategori" name="kategori" required>
                            <option value="" disabled selected>Pilih kategori aspirasi...</option>
                            <?php if (!empty($kategori)): ?>
                                <?php foreach ($kategori as $k): ?>
                                    <option value="<?= $k->id_kategori ?>"><?= htmlspecialchars($k->nama_kategori) ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>Kategori tidak tersedia</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="lokasi" class="form-label fw-bold">Lokasi Spesifik</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Contoh: Gedung A, Lantai 2, Toilet Pria" required>
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="form-label fw-bold">Keterangan / Deskripsi</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="5" placeholder="Jelaskan secara detail aspirasi atau keluhan Anda di sini..." required></textarea>
                        <div class="form-text">Jelaskan dengan detail agar mudah dipahami.</div>
                    </div>

                    <div class="mb-4">
                        <label for="gambar" class="form-label fw-bold">Foto / Bukti (Opsional)</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                        <div class="form-text">Lampirkan gambar jika diperlukan untuk memperjelas. Maks 5MB.</div>
                        
                        <div id="imagePreview" class="mt-3" style="display: none;">
                            <p class="form-text">Pratinjau Gambar:</p>
                            <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 250px;">
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= base_url('siswa') ?>" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Aspirasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image Preview
        const gambarInput = document.getElementById('gambar');
        if (gambarInput) {
            gambarInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        document.getElementById('previewImg').src = event.target.result;
                        document.getElementById('imagePreview').style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Form Validation
        const form = document.getElementById('formAspirasi');
        if(form){
            form.addEventListener('submit', function(e) {
                const keterangan = document.getElementById('keterangan').value;
                if (keterangan.trim().length < 10) {
                    e.preventDefault();
                    alert('Keterangan aspirasi minimal harus 10 karakter.');
                    document.getElementById('keterangan').focus();
                    return false;
                }
            });
        }
    });
</script>