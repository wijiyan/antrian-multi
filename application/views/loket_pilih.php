<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pilih Loket</title>

<style>
:root {
    --primary: #1e88e5;
    --bg1: #0f2027;
    --bg2: #203a43;
    --bg3: #2c5364;
}

body {
    margin: 0;
    height: 100vh;
    background: linear-gradient(135deg, var(--bg1), var(--bg2), var(--bg3));
    font-family: "Segoe UI", Arial, sans-serif;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    background: rgba(255,255,255,0.08);
    border-radius: 30px;
    padding: 50px 70px;
    text-align: center;
    box-shadow: 0 20px 50px rgba(0,0,0,0.4);
    width: 720px;
}

/* HEADER */
.logo img {
    height: 80px;
    margin-bottom: 15px;
}

.title {
    font-size: 36px;
    font-weight: bold;
}

.subtitle {
    font-size: 20px;
    opacity: 0.85;
    margin-bottom: 40px;
}

/* GRID LOKET */
.loket-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 30px;
}

/* CARD LOKET */
.loket-card {
    background: rgba(255,255,255,0.12);
    border-radius: 22px;
    padding: 40px 20px;
    text-decoration: none;
    color: #fff;
    font-size: 30px;
    font-weight: bold;
    box-shadow: 0 10px 25px rgba(0,0,0,0.35);
    transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
}

.loket-card span {
    display: block;
    font-size: 64px;
    margin-bottom: 10px;
}

.loket-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(0,0,0,0.5);
    background: rgba(30,136,229,0.35);
}

.loket-card:active {
    transform: scale(0.97);
}

/* FOOTER */
.footer {
    margin-top: 40px;
    font-size: 16px;
    opacity: 0.8;
}
</style>
</head>

<body>

<div class="container">

    <!-- LOGO -->
    <div class="logo">
        <img src="<?= base_url('assets/logo_puskesmas.png') ?>" alt="Logo Puskesmas">
    </div>

    <div class="title">PILIH LOKET</div>
    <div class="subtitle">Silakan pilih loket pelayanan</div>

    <!-- DAFTAR LOKET -->
    <div class="loket-grid">
        <a class="loket-card" href="<?= base_url('loket/index/1') ?>">
            <span>1</span>
            LOKET
        </a>

<!--         <a class="loket-card" href="<?= base_url('loket/index/2') ?>">
            <span>2</span>
            LOKET
        </a>

        <a class="loket-card" href="<?= base_url('loket/index/3') ?>">
            <span>3</span>
            LOKET
        </a> -->
    </div>

    <div class="footer">
        Pilih sesuai posisi loket Anda
    </div>

</div>

</body>
</html>
