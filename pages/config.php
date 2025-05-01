<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1); 

// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_flexdrive";

// Buat koneksi database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambah notifikasi baru
function tambah_notifikasi($id_user, $id_pesan, $pesan) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO notifikasi (id_user, id_pesan, pesan) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $id_user, $id_pesan, $pesan);
    return $stmt->execute();
}

//Hitung notifikasi belum dibaca

function hitung_notifikasi_belum_dibaca($id_user) {
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) FROM notifikasi WHERE id_user = ? AND dibaca = FALSE");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_row()[0];
}

?>