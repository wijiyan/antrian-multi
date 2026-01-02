<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Grafik Antrian</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        padding: 30px;
    }
    h1 {
        margin-bottom: 5px;
    }
    .chart-box {
        width: 100%;
        max-width: 900px;
        margin: 40px auto;
    }
</style>
</head>
<body>

<h1>GRAFIK ANTRIAN HARIAN</h1>
<strong><?= $this->config->item('puskesmas_nama') ?></strong>

<form method="get" style="margin-top:20px;">
    Tanggal:
    <input type="date" name="tanggal" value="<?= $tanggal ?>">
    <button type="submit">Tampilkan</button>
    <button type="button" onclick="window.print()">Cetak</button>
</form>

<!-- Grafik per Loket -->
<div class="chart-box">
    <h3>Antrian per Loket</h3>
    <canvas id="chartLoket"></canvas>
</div>

<!-- Grafik per Jam -->
<div class="chart-box">
    <h3>Antrian per Jam</h3>
    <canvas id="chartJam"></canvas>
</div>

<script>
/* =====================
   DATA DARI SERVER
===================== */
const dataLoket = {
    labels: [
        <?php foreach($loket as $l): ?>
            "Loket <?= $l->loket ?>",
        <?php endforeach; ?>
    ],
    datasets: [{
        label: 'Jumlah Antrian',
        data: [
            <?php foreach($loket as $l): ?>
                <?= $l->total ?>,
            <?php endforeach; ?>
        ],
        backgroundColor: '#2c7be5'
    }]
};

const dataJam = {
    labels: [
        <?php foreach($jam as $j): ?>
            "<?= sprintf('%02d:00', $j->jam) ?>",
        <?php endforeach; ?>
    ],
    datasets: [{
        label: 'Jumlah Antrian',
        data: [
            <?php foreach($jam as $j): ?>
                <?= $j->total ?>,
            <?php endforeach; ?>
        ],
        borderColor: '#28a745',
        fill: false,
        tension: 0.3
    }]
};

/* =====================
   RENDER CHART
===================== */
new Chart(document.getElementById('chartLoket'), {
    type: 'bar',
    data: dataLoket,
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        }
    }
});

new Chart(document.getElementById('chartJam'), {
    type: 'line',
    data: dataJam,
    options: {
        responsive: true
    }
});
</script>

</body>
</html>
