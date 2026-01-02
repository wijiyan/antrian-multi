<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Display Antrian</title>

    <style>
        :root {
            --primary: #1e88e5;
            --accent: #ffca28;
            --bg-day: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
            --bg-night: linear-gradient(135deg,#000000,#121212);
        }

/* MODE MALAM */
body.night {
    background: var(--bg-night);
}

body {
    margin: 0;
    height: 100vh;
    background: var(--bg-day);
    color: #fff;
    font-family: "Segoe UI", Arial, sans-serif;
    display: flex;
    flex-direction: column;
}

/* HEADER */
header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(0,0,0,0.35);
    padding: clamp(15px, 2vw, 40px) clamp(20px, 3vw, 60px);
}

header .left {
    display: flex;
    align-items: center;
}

header img {
    height: 60px;
    margin-right: 20px;
}

header .title {
    font-size: clamp(22px, 2.2vw, 40px);
    font-weight: bold;
}

header .clock {
    font-size: clamp(18px, 1.8vw, 34px);
}

/* MAIN CENTER */
main {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* CARD TENGAH */
.card {
    background: rgba(255,255,255,0.08);
    text-align: center;
    box-shadow: 0 20px 50px rgba(0,0,0,0.45);
    padding: clamp(40px, 4vw, 120px);
    border-radius: clamp(20px, 3vw, 40px);
}

/* LABEL */
.label {
    font-size: clamp(26px, 2.4vw, 48px);
    opacity: 0.9;
}

/* NOMOR */
.nomor {
    font-size: 220px;
    font-weight: bold;
    color: var(--accent);
    margin: 20px 0;
}

.loket {
    font-size: clamp(48px, 5vw, 110px);
    font-weight: bold;
}

.flash {
    animation: flash 0.8s infinite;
}

@keyframes flash {
    0% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.4; transform: scale(1.05); }
    100% { opacity: 1; transform: scale(1); }
}

/* RUNNING TEXT */
.running {
    height: 55px;
    background: rgba(0,0,0,0.7);
    overflow: hidden;
    white-space: nowrap;
    display: flex;
    align-items: center;
}

.running span {
    display: inline-block;
    padding-left: 100%;
    font-size: 26px;
    animation: marquee 25s linear infinite;
}

@keyframes marquee {
    0% { transform: translateX(0); }
    100% { transform: translateX(-100%); }
}

/* SPLIT LAYOUT */
.main-wrap {
    flex: 1;
    display: flex;
}

/* VIDEO */
.video-box {
    width: 40%;
    background: #000;
    display: flex;
    align-items: center;
    justify-content: center;

    padding: clamp(20px, 2vw, 50px); /* ⬅️ JARAK DARI KIRI */
    box-sizing: border-box;
}

.video-box video {
    width: 100%;
    aspect-ratio: 16 / 9;
    object-fit: cover;
    border-radius: clamp(12px, 1.5vw, 28px);          /* opsional: biar halus */
}

/* INFO */
.info-box {
    width: 60%;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* STATUS KODE */
.kode-status {
    margin-top: 25px;
    display: flex;
    justify-content: center;
    gap: 40px;
    font-size: 36px;
}

.kode-status span {
    opacity: 0.85;
}

.kode-status b {
    color: var(--accent);
}

@media (min-width: 3000px) {
    body {
        zoom: 1.15; /* aman untuk Chrome kiosk */
    }
}

</style>
</head>

<body>

    <header>
        <div class="left">
            <img src="<?= base_url('assets/logo_puskesmas.png') ?>" alt="Logo">
            <div class="title"><?= $this->config->item('puskesmas_nama') ?></div>
        </div>
        <div class="clock" id="clock">--:--</div>
    </header>

    <div class="main-wrap">

        <!-- VIDEO EDUKASI -->
        <div class="video-box">
            <video autoplay muted loop>
                <source src="<?= base_url('assets/video/edukasi.mp4') ?>" type="video/mp4">
                </video>
            </div>

            <!-- INFO ANTRIAN -->
            <div class="info-box">
                <div class="card">
                    <div class="label">ANTRIAN SEDANG DIPANGGIL</div>
                    <div class="nomor" id="nomor">-</div>
                    <div class="loket" id="loket">LOKET -</div>

                    <!-- STATUS A B C -->
                    <div class="kode-status">
                        <span>A : <b id="kodeA">-</b></span>
                        <span>B : <b id="kodeB">-</b></span>
                        <span>C : <b id="kodeC">-</b></span>
                    </div>
                </div>
            </div>

        </div>


        <div class="running">
            <span>
                <?= $this->config->item('puskesmas_running') ?>
            </span>
        </div>

        <script>
/* ======================
   JAM & MODE MALAM
   ====================== */
   function updateClock(){
    let now = new Date();
    let h = now.getHours();
    let m = String(now.getMinutes()).padStart(2,'0');
    document.getElementById('clock').innerHTML = h + ":" + m;

    if(h >= 18 || h < 6){
        document.body.classList.add('night');
    } else {
        document.body.classList.remove('night');
    }
}
setInterval(updateClock, 1000);
updateClock();

/* ======================
   AUDIO QUEUE
   ====================== */
   const BASE_AUDIO = "<?= base_url('assets/audio/') ?>";
   let sedangPutar = false;

   function playAudio(file, cb){
    let a = new Audio(BASE_AUDIO + file);
    a.play();
    a.onended = cb;
}

function angkaKeAudio(n){
    let r=[];
    if(n>=1000){r.push(Math.floor(n/1000)+".mp3","ribu.mp3");n%=1000;}
    if(n>=100){
        if(n<200) r.push("seratus.mp3");
        else r.push(Math.floor(n/100)+".mp3","ratus.mp3");
        n%=100;
    }
    if(n>=20){r.push(Math.floor(n/10)*10+".mp3");n%=10;}
    if(n>0) r.push(n+".mp3");
    return r;
}

function playList(list,i,done){
    if(i>=list.length){done();return;}
    playAudio(list[i],()=>playList(list,i+1,done));
}

/* PANGGIL SUARA (SUPPORT KODE) */
function panggilSuara(kode, nomor, loket, done){
    let p = [];

    p.push("pembuka/bell.mp3");
    p.push("pembuka/nomor_antrian.mp3");

    // sebut kode (A/B/C)
    p.push("kode/" + kode + ".mp3");

    // sebut angka
    angkaKeAudio(nomor).forEach(f => p.push("angka/" + f));

    p.push("penutup/silakan_menuju_loket_pendaftaran.mp3");
    p.push("loket/" + loket + ".mp3");

    playList(p, 0, done);
}

/* ======================
   CEK QUEUE
   ====================== */
   function cekQueue(){
    if(sedangPutar) return;

    fetch("<?= base_url('display/audio_next') ?>")
    .then(r => r.json())
    .then(d => {
        if(!d) return;

        sedangPutar = true;

        // TAMPILAN
        document.getElementById('nomor').innerHTML =
        d.kode + "-" + String(d.nomor).padStart(3,'0');

        document.getElementById('loket').innerHTML =
        "LOKET " + d.loket;

        // AUDIO
        panggilSuara(d.kode, d.nomor, d.loket, () => {
            sedangPutar = false;
        });
    })
    .catch(() => {
        sedangPutar = false;
    });
}

setInterval(cekQueue, 800);

function playAudio(file, cb){
    let a = new Audio(BASE_AUDIO + file);
    let selesai = false;

    a.play();
    a.onended = () => {
        if(!selesai){
            selesai = true;
            cb();
        }
    };

    setTimeout(() => {
        if(!selesai){
            selesai = true;
            cb();
        }
    }, 5000); // fallback
}

/* ======================
   STATUS A B C
====================== */
function cekStatusKode(){
    fetch("<?= base_url('display/status_kode') ?>")
    .then(r => r.json())
    .then(d => {
        if(!d) return;
        document.getElementById('kodeA').innerHTML =
            d.A ? String(d.A).padStart(3,'0') : '-';
        document.getElementById('kodeB').innerHTML =
            d.B ? String(d.B).padStart(3,'0') : '-';
        document.getElementById('kodeC').innerHTML =
            d.C ? String(d.C).padStart(3,'0') : '-';
    });
}

setInterval(cekStatusKode, 2000);
cekStatusKode();


</script>

</body>
</html>



