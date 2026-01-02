<?php
/**
 * CRON RESET ANTRIAN
 * Jalankan via CLI (cron / task scheduler)
 * Jam 00:01 setiap hari
 */

// =======================
// KONFIGURASI DATABASE
// =======================
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "antrian";

// =======================
// KONEKSI DATABASE
// =======================
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// =======================
// OPSI RESET
// =======================

// Reset logis (REKOMENDASI)
// Tidak hapus data, cukup tandai hari baru
// → cocok kalau pakai kolom `tanggal`

$tanggal_hari_ini = date('Y-m-d');

// Tidak perlu query apa pun
// Nomor otomatis mulai dari 1 karena query pakai WHERE tanggal

// =======================
// Bersihkan audio queue
// =======================
$conn->query("TRUNCATE TABLE audio_queue");

// =======================
// (OPSIONAL) ARSIP DATA LAMA
// =======================
// Contoh: hapus data > 6 bulan
// $conn->query("DELETE FROM antrian WHERE tanggal < DATE_SUB(CURDATE(), INTERVAL 6 MONTH)");

echo "[" . date('Y-m-d H:i:s') . "] Reset antrian sukses\n";

$conn->close();
