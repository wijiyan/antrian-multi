<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Loket <?= $loket ?></title>

<style>
:root {
    --primary: #1e88e5;
    --success: #43a047;
    --warning: #fbc02d;
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

.card {
    background: rgba(255,255,255,0.08);
    border-radius: 28px;
    padding: 50px 70px;
    text-align: center;
    box-shadow: 0 20px 50px rgba(0,0,0,0.4);
    width: 480px;
}

/* HEADER */
.header {
    font-size: 34px;
    font-weight: bold;
    margin-bottom: 10px;
}

.subheader {
    font-size: 20px;
    opacity: 0.85;
    margin-bottom: 30px;
}

/* NOMOR */
.nomor {
    font-size: 140px;
    font-weight: bold;
    margin: 20px 0;
    color: var(--warning);
}

/* STATUS */
.status {
    font-size: 20px;
    margin-bottom: 30px;
    opacity: 0.9;
}

/* BUTTONS */
.buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
}

button {
    flex: 1;
    font-size: 26px;
    padding: 20px;
    border-radius: 18px;
    border: none;
    cursor: pointer;
    font-weight: bold;
    transition: transform 0.1s ease, box-shadow 0.1s ease;
}

button:active {
    transform: scale(0.97);
}

.btn-panggil {
    background: var(--success);
    color: #fff;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
}

.btn-ulang {
    background: var(--warning);
    color: #000;
}

.footer {
    margin-top: 30px;
    font-size: 16px;
    opacity: 0.8;
}
</style>
</head>

<body>

<div class="card">

    <div class="header">LOKET <?= $loket ?></div>
    <div class="subheader">Panggilan Antrian</div>

    <div class="nomor" id="nomor">-</div>

    <div class="status" id="status">Menunggu antrian...</div>


<!-- PILIH KODE -->
<div class="kode-group">
    <button class="btn-kode active" onclick="pilihKode('A')">A</button>
    <button class="btn-kode" onclick="pilihKode('B')">B</button>
    <button class="btn-kode" onclick="pilihKode('C')">C</button>
</div>

    <div class="buttons">
        <button class="btn-panggil" onclick="panggil()">PANGGIL</button>
        <button class="btn-ulang" onclick="ulang()">PANGGIL ULANG</button>
    </div>

    <div class="footer">
        <a href="<?= base_url('loket') ?>" style="color:#fff; text-decoration:none;">
            ⬅ Ganti Loket
        </a>
    </div>

</div>

<script>
const LOKET = <?= (int)$loket ?>;

function panggil(){
    setStatus("Memanggil antrian baru...");
    fetch("<?= base_url('loket/panggil/') ?>" + LOKET)
        .then(res => res.json())
        .then(data => {
            if(data.status){
                document.getElementById('nomor').innerHTML = data.nomor;
                setStatus("Antrian dikirim ke Display TV");
            } else {
                setStatus("Tidak ada antrian menunggu");
            }
        })
        .catch(() => setStatus("Gagal menghubungi server"));
}

function ulang(){
    setStatus("Memanggil ulang antrian...");
    fetch("<?= base_url('loket/ulang/') ?>" + LOKET)
        .then(res => res.json())
        .then(data => {
            if(data.status){
                document.getElementById('nomor').innerHTML = data.nomor;
                setStatus("Panggil ulang dikirim ke Display TV");
            } else {
                setStatus("Belum ada antrian untuk dipanggil ulang");
            }
        })
        .catch(() => setStatus("Gagal menghubungi server"));
}

function setStatus(text){
    document.getElementById('status').innerHTML = text;
}
</script>

</body>
</html>
