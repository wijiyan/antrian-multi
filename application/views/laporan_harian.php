<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Harian Antrian</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            padding: 30px;
        }
        h1 {
            margin-bottom: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #eee;
        }
        .info {
            margin-top: 15px;
            font-size: 16px;
        }
        .btn {
            padding: 8px 16px;
            font-size: 14px;
            margin-left: 5px;
            text-decoration: none;
            border: 1px solid #333;
            background: #f2f2f2;
            color: #000;
            cursor: pointer;
        }
        .btn:hover {
            background: #ddd;
        }


    </style>
</head>
<body>

    <h1>LAPORAN HARIAN ANTRIAN</h1>
    <strong><?= $this->config->item('puskesmas_nama') ?></strong>

    <form method="get" style="margin-top:20px;">
        Tanggal:
        <input type="date" name="tanggal" value="<?= $tanggal ?>">

        <!-- Tampilkan -->
        <button class="btn" type="submit">Tampilkan</button>

        <!-- Grafik -->
        <a class="btn" 
        href="<?= base_url('laporan/grafik?tanggal=') . $tanggal ?>">
        Grafik
    </a>

    <!-- Cetak -->
    <button class="btn" type="button" onclick="window.print()">Cetak</button>
</form>


<div class="info">
    <p><b>Tanggal:</b> <?= date('d-m-Y', strtotime($tanggal)) ?></p>
    <p><b>Total Antrian:</b> <?= $total ?></p>
    <p>
        <b>Jam Pelayanan:</b>
        <?= $jam->mulai ? date('H:i', strtotime($jam->mulai)) : '-' ?>
        -
        <?= $jam->selesai ? date('H:i', strtotime($jam->selesai)) : '-' ?>
    </p>
</div>

<table>
    <thead>
        <tr>
            <th>Loket</th>
            <th>Jumlah Antrian</th>
        </tr>
    </thead>
    <tbody>
        <?php if($loket): foreach($loket as $l): ?>
            <tr>
                <td>Loket <?= $l->loket ?></td>
                <td><?= $l->total ?></td>
            </tr>
        <?php endforeach; else: ?>
        <tr>
            <td colspan="2">Tidak ada data</td>
        </tr>
    <?php endif; ?>
</tbody>
</table>

</body>
</html>
