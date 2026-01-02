<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Loket <?= $loket ?></title>

<style>
body{
    margin:0;
    height:100vh;
    background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    font-family:"Segoe UI",Arial,sans-serif;
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
}

.card{
    background:rgba(255,255,255,0.08);
    border-radius:30px;
    padding:50px 60px;
    text-align:center;
    box-shadow:0 20px 50px rgba(0,0,0,0.45);
    width:460px;
}

h1{
    margin:0;
    font-size:32px;
}

.subtitle{
    opacity:.8;
    margin-bottom:25px;
}

/* KODE */
.kode-group{
    display:flex;
    justify-content:center;
    gap:14px;
    margin-bottom:25px;
}

.btn-kode{
    padding:12px 22px;
    font-size:20px;
    border-radius:14px;
    border:none;
    cursor:pointer;
    background:#455a64;
    color:#fff;
}

.btn-kode.active{
    background:#ffd23c;
    color:#000;
    font-weight:bold;
}

/* NOMOR */
.nomor{
    font-size:110px;
    font-weight:bold;
    color:#ffd23c;
    margin:15px 0;
}

/* BUTTON */
.buttons{
    display:flex;
    gap:16px;
}

button.action{
    flex:1;
    font-size:22px;
    padding:18px;
    border-radius:18px;
    border:none;
    cursor:pointer;
    font-weight:bold;
}

.btn-panggil{
    background:#43a047;
    color:#fff;
}

.btn-ulang{
    background:#fbc02d;
    color:#000;
}

.status{
    margin-top:20px;
    font-size:16px;
    opacity:.85;
}
</style>
</head>

<body>

<div class="card">
    <h1>LOKET <?= $loket ?></h1>
    <div class="subtitle">Panggilan Antrian</div>

    <!-- PILIH KODE -->
    <div class="kode-group">
        <button class="btn-kode active" onclick="pilihKode('A',this)">A</button>
        <button class="btn-kode" onclick="pilihKode('B',this)">B</button>
        <button class="btn-kode" onclick="pilihKode('C',this)">C</button>
    </div>

    <div class="nomor" id="nomor">-</div>

    <div class="buttons">
        <button class="action btn-panggil" onclick="panggil()">PANGGIL</button>
        <button class="action btn-ulang" onclick="ulang()">ULANG</button>
    </div>

    <div class="status" id="status">Menunggu aksi...</div>
</div>

<script>
let KODE  = 'A';
const LOKET = <?= (int)$loket ?>;

function pilihKode(kode,el){
    KODE = kode;
    document.querySelectorAll('.btn-kode')
        .forEach(b=>b.classList.remove('active'));
    el.classList.add('active');
}

function panggil(){
    setStatus("Memanggil antrian...");
    fetch("<?= base_url('loket/panggil') ?>",{
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body:JSON.stringify({loket:LOKET,kode:KODE})
    })
    .then(r=>r.json())
    .then(d=>{
        if(d.status){
            document.getElementById('nomor').innerHTML =
                d.kode + '-' + String(d.nomor).padStart(3,'0');
            setStatus("Antrian dipanggil");
        }else{
            setStatus(d.message);
        }
    });
}

function ulang(){
    setStatus("Panggil ulang...");
    fetch("<?= base_url('loket/ulang') ?>",{
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body:JSON.stringify({loket:LOKET,kode:KODE})
    })
    .then(r=>r.json())
    .then(d=>{
        if(d.status){
            document.getElementById('nomor').innerHTML =
                d.kode + '-' + String(d.nomor).padStart(3,'0');
            setStatus("Panggil ulang dikirim");
        }else{
            setStatus(d.message);
        }
    });
}

function setStatus(txt){
    document.getElementById('status').innerHTML = txt;
}
</script>

</body>
</html>
