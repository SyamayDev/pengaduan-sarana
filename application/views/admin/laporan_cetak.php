<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pengaduan</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
        }
        .container {
            width: 90%;
            margin: 0 auto;
        }
        .kop-surat {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .kop-surat img {
            width: 80px;
            height: auto;
            margin-right: 20px;
        }
        .kop-surat .judul {
            text-align: center;
        }
        .kop-surat h2, .kop-surat h3 {
            margin: 0;
            font-weight: bold;
        }
        .kop-surat p {
            margin: 5px 0 0;
            font-size: 14px;
        }
        .report-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .tanda-tangan {
            width: 300px;
            margin-top: 50px;
            float: right;
            text-align: center;
        }
        .tanda-tangan .jabatan {
            margin-bottom: 80px;
        }
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="kop-surat">
            <img src="<?= base_url('assets/images/logo.webp') ?>" alt="Logo">
            <div class="judul">
                <h2>PEMERINTAH KOTA CIMAHI</h2>
                <h3>DINAS PENDIDIKAN</h3>
                <h3>SMK TRIADU</h3>
                <p>Jl. Kebon Rumput No. 17, Kota Cimahi, Jawa Barat</p>
            </div>
        </div>

        <div class="report-title">
            LAPORAN PENGADUAN SARANA DAN PRASARANA
        </div>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIS</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($aspirasi)): ?>
                    <?php $no = 1; foreach ($aspirasi as $item): ?>
                        <tr>
                            <td style="text-align: center;"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($item->nis) ?></td>
                            <td><?= htmlspecialchars($item->nama_kategori ?? '-') ?></td>
                            <td><?= htmlspecialchars($item->lokasi) ?></td>
                            <td><?= htmlspecialchars($item->keterangan) ?></td>
                            <td><?= htmlspecialchars($item->status) ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($item->tanggal)) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">Tidak ada data untuk periode ini.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="tanda-tangan">
            <p>Cimahi, <?= date('d F Y') ?></p>
            <p class="jabatan">Kepala Sekolah,</p>
            <p class="nama">(_________________________)</p>
            <p class="nip">NIP. .........................</p>
        </div>
    </div>
</body>
</html>