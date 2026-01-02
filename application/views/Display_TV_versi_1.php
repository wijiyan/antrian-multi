<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Display Antrian</title>
    <style>
        body {
            margin: 0;
            background: #000;
            color: #fff;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }

        h1 {
            font-size: 50px;
            margin-top: 30px;
        }

        .nomor {
            font-size: 160px;
            font-weight: bold;
            margin-top: 60px;
        }

        .loket {
            font-size: 80px;
            margin-top: 20px;
        }

        .info {
            font-size: 40px;
            margin-top: 40px;
            opacity: 0.8;
        }
    </style>
</head>
<body>

<h1>ANTRIAN PENDAFTARAN</h1>

<div class="nomor" id="nomor">-</div>
<div class="loket" id="loket">LOKET -</div>
<div class="info" id="info">Menunggu panggilan...</div>

<script>
/* ===============================
   KONFIGURASI AUDIO
================================ */
const BASE_AUDIO = "<?= base_url('assets/audio/') ?>";
let currentAudio = null;
let sedangPutar = false;

/* ===============================
   PLAYER AUDIO DASAR
================================ */
function playAudio(file, callback){
    currentAudio = new Audio(BASE_AUDIO + file);
    currentAudio.play();
    currentAudio.onended = callback;
}

/* ===============================
   PECAH ANGKA → FILE MP3
================================ */
function angkaKeAudio(n){
    let hasil = [];

    if(n >= 1000){
        let ribu = Math.floor(n / 1000);
        hasil.push(ribu + ".mp3");
        hasil.push("ribu.mp3");
        n = n % 1000;
    }

    if(n >= 100){
        if(n >= 100 && n < 200){
            hasil.push("seratus.mp3");
        } else {
            hasil.push(Math.floor(n / 100) + ".mp3");
            hasil.push("ratus.mp3");
        }
        n = n % 100;
    }

    if(n >= 20){
        hasil.push(Math.floor(n / 10) * 10 + ".mp3");
        n = n % 10;
    }

    if(n > 0){
        hasil.push(n + ".mp3");
    }

    return hasil;
}

/* ===============================
   PUTAR AUDIO BERURUTAN
================================ */
function playBerantai(list, index, selesai){
    if(index >= list.length){
        if(selesai) selesai();
        return;
    }

    playAudio(list[index], function(){
        playBerantai(list, index + 1, selesai);
    });
}

/* ===============================
   FUNGSI UTAMA PANGGIL SUARA
================================ */
function panggilSuara(nomor, loket, selesai){
    let playlist = [];

    playlist.push("pembuka/bell.mp3");
    playlist.push("pembuka/nomor_antrian.mp3");

    angkaKeAudio(nomor).forEach(f => {
        playlist.push("angka/" + f);
    });

    playlist.push("penutup/silakan_menuju_loket_pendaftaran.mp3");
    playlist.push("loket/" + loket + ".mp3");

    playBerantai(playlist, 0, selesai);
}

/* ===============================
   CEK AUDIO QUEUE DARI SERVER
================================ */
function cekAudioQueue(){
    if(sedangPutar) return;

    fetch("<?= base_url('display/audio_next') ?>")
        .then(res => res.json())
        .then(data => {
            if(data){
                sedangPutar = true;

                // Update tampilan visual
                document.getElementById('nomor').innerHTML = data.nomor;
                document.getElementById('loket').innerHTML = "LOKET " + data.loket;
                document.getElementById('info').innerHTML = "Sedang dipanggil";

                panggilSuara(data.nomor, data.loket, function(){
                    sedangPutar = false;
                    document.getElementById('info').innerHTML = "Menunggu panggilan...";
                });
            }
        });
}

/* ===============================
   LOOP CEK AUDIO (SETIAP 1 DETIK)
================================ */
setInterval(cekAudioQueue, 1000);
</script>

</body>
</html>
