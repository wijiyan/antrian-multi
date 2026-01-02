<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Mesin Antrian</title>

    <style>
        :root {
            --primary: #1e88e5;
            --accent: #ffca28;
            --bg1: #0f2027;
            --bg2: #203a43;
            --bg3: #2c5364;
        }

        body {
            margin: 0;
            height: 100vh;
            background: linear-gradient(180deg,#1f3b43,#2b4e57);
            font-family: "Segoe UI", Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            color: #fff;
            width: 420px;
            padding: 40px 30px;
            border-radius: 28px;
            background: rgba(255,255,255,0.08);
            text-align: center;
            box-shadow: 0 20px 50px rgba(0,0,0,0.4);
        }

/* LOGO */
.logo img {
    height: 90px;
    margin-bottom: 15px;
}

.title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 10px;
}

.subtitle {
    font-size: 18px;
    opacity: 0.85;
    margin-bottom: 30px;
}

/* TOMBOL */
.btn {
    background: var(--accent);
    color: #000;
    border: none;
    border-radius: 20px;
    font-size: 36px;
    font-weight: bold;
    padding: 30px 40px;
    width: 100%;
    cursor: pointer;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
    transition: transform 0.15s ease, box-shadow 0.15s ease;
}

.btn:active {
    transform: scale(0.97);
    box-shadow: 0 6px 15px rgba(0,0,0,0.4);
}

.button-group {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-bottom: 30px;
}

.btn-antrian {
    background: #ffd23c;
    border: none;
    border-radius: 20px;
    padding: 18px;
    cursor: pointer;
    box-shadow: 0 10px 25px rgba(0,0,0,0.35);
    transition: transform 0.12s ease;
}

.btn-antrian:active {
    transform: scale(0.97);
}

.btn-antrian .kode {
    display: block;
    font-size: 32px;
    font-weight: bold;
    line-height: 1.1;
}

.btn-antrian .label {
    display: block;
    font-size: 18px;
    letter-spacing: 1px;
}

/* NOMOR ANTRIAN */
.nomor {
    margin-top: 30px;
    font-size: 42px;
    font-weight: bold;
}

/* QR */
.qr {
    margin-top: 35px;
}

.qr img {
    background: #fff;
    padding: 8px;
    border-radius: 12px;
}

.qr-text {
    font-size: 14px;
    margin-top: 8px;
    opacity: 0.85;
}
</style>
</head>

<body>

    <div class="container">

        <!-- LOGO -->
        <div class="logo" id="fsArea">
            <img src="<?= base_url('assets/logo_puskesmas.png') ?>" alt="Logo Puskesmas">
        </div>

        <div class="title"><?= $this->config->item('puskesmas_nama') ?></div>
        <div class="subtitle">Mesin Antrian Pendaftaran</div>

        <!-- TOMBOL AMBIL ANTRIAN -->
        <!-- <button class="btn" onclick="ambilAntrian()">AMBIL ANTRIAN</button> -->

        <!-- BUTTONS -->
        <div class="button-group">
          <button class="btn-antrian" onclick="ambil('A')">
              <span class="kode">A</span>
              <span class="label">UMUM</span>
          </button>

          <button class="btn-antrian" onclick="ambil('B')">
              <span class="kode">B</span>
              <span class="label">BPJS</span>
          </button>

          <button class="btn-antrian" onclick="ambil('C')">
              <span class="kode">C</span>
              <span class="label">LANSIA</span>
          </button>
      </div>

      <div class="nomor" id="nomor"></div>

      <!-- QR CODE -->
      <div class="qr">
        <img 
        src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=https://webskrining.bpjs-kesehatan.go.id/skrining/" 
        alt="QR Code">
        <div class="qr-text">
            SCAN DISINI <br> Pastikan Anda Sudah Melakukan Skrining Riwayat Kesehatan
        </div>
    </div>

</div>

<!-- Solusi tanpa keluar kertas -->
<!-- <script>
function ambilAntrian(){
    fetch("<?= base_url('pendaftaran/ambil') ?>")
        .then(res => res.json())
        .then(data => {
            if(data.status){
                document.getElementById('nomor').innerHTML =
                    "Nomor Antrian Anda: " + data.nomor;

                // Cetak tiket (halaman khusus cetak)
                let frame = document.createElement("iframe");
                frame.style.display = "none";
                frame.src = "<?= base_url('pendaftaran/cetak/') ?>" + data.nomor;
                document.body.appendChild(frame);
            }
        });
}
</script> -->

<!--Solusi Tidak Keluar Kertas -->
<!-- <script>
    function ambilAntrian(){
        fetch("<?= base_url('pendaftaran/ambil') ?>")
        .then(res => res.json())
        .then(data => {
            if(data.status){
                document.getElementById('nomor').innerHTML =
                "Nomor Antrian Anda: " + data.nomor;

                // CETAK VIA POPUP
                window.open(
                    "<?= base_url('pendaftaran/cetak/') ?>" + data.nomor,
                    "_blank",
                    "width=300,height=500"
                    );
            }
        });
    }
</script> -->

<script>
    function ambil(kode){
        fetch("<?= base_url('pendaftaran/ambil/') ?>" + kode)
        .then(res => res.json())
        .then(data => {
            alert("Nomor Anda: " + data.kode + "-" + data.nomor);

            // cetak
            window.open(
                "<?= base_url('pendaftaran/cetak/') ?>" + data.kode + "/" + data.nomor,
                "_blank",
                "width=1,height=1,left=-1000,top=-1000"
                );
        });
    }
</script>

<!-- <script>
function ambilAntrian(){
    fetch("<?= base_url('pendaftaran/ambil') ?>")
        .then(res => res.json())
        .then(data => {
            if(data.status){
                document.getElementById('nomor').innerHTML =
                    "Nomor Antrian Anda: " + data.nomor;

                // 👉 CETAK DI WINDOW BARU
                window.open(
                    "<?= base_url('pendaftaran/cetak/') ?>" + data.nomor,
                    "_blank",
                    "width=300,height=500"
                );
            }
        });
}
</script> -->

<script>
    const fsArea = document.getElementById('fsArea');

    fsArea.addEventListener('dblclick', toggleFullscreen);

// Support touchscreen (double tap)
let lastTap = 0;
fsArea.addEventListener('touchend', function(e){
    const now = new Date().getTime();
    const tapLength = now - lastTap;

    if(tapLength < 300 && tapLength > 0){
        toggleFullscreen();
        e.preventDefault();
    }
    lastTap = now;
});

function toggleFullscreen(){
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen().catch(err => {
            console.log("Fullscreen gagal:", err);
        });
    } else {
        document.exitFullscreen();
    }
}
</script>

</body>
</html>
