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



?>