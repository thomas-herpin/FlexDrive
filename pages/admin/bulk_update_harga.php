<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: pengaturan_harga.php");
    exit();
}

$bulk_tipe = isset($_POST['bulk_tipe']) ? mysqli_real_escape_string($conn, $_POST['bulk_tipe']) : '';
$price_type = isset($_POST['price_type']) ? mysqli_real_escape_string($conn, $_POST['price_type']) : 'per_hari';
$percentage = isset($_POST['percentage']) ? floatval($_POST['percentage']) : 0;
$change_type = isset($_POST['change_type']) ? mysqli_real_escape_string($conn, $_POST['change_type']) : 'increase';

if ($percentage <= 0 || $percentage > 100) {
    $_SESSION['error'] = "Persentase harus antara 1-100";
    header("Location: pengaturan_harga.php");
    exit();
}

$factor = ($change_type === 'increase') ? (1 + ($percentage / 100)) : (1 - ($percentage / 100));

$query = "UPDATE harga_mobil h 
          JOIN mobil m ON h.id_mobil = m.id_mobil 
          SET ";

$updates = [];
if ($price_type === 'all') {
    $updates[] = "h.per_hari = ROUND(h.per_hari * $factor)";
    $updates[] = "h.per_minggu = ROUND(h.per_minggu * $factor)";
    $updates[] = "h.per_bulan = ROUND(h.per_bulan * $factor)";
} else {
    $updates[] = "h.$price_type = ROUND(h.$price_type * $factor)";
}

$query .= implode(', ', $updates);

if (!empty($bulk_tipe)) {
    $query .= " WHERE m.tipe_mobil = '$bulk_tipe'";
}

$result = mysqli_query($conn, $query);

if ($result) {
    $affected_rows = mysqli_affected_rows($conn);
    $_SESSION['success'] = "Berhasil mengupdate harga untuk $affected_rows kendaraan";
} else {
    $_SESSION['error'] = "Gagal mengupdate harga: " . mysqli_error($conn);
}

header("Location: pengaturan_harga.php");
exit();
?>