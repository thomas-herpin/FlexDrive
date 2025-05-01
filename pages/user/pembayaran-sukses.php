<?php
require_once '../config.php';

// Cek session login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../sign_in.html");
    exit();
}

// Ambil ID pesanan dari URL
if (!isset($_GET['id_pesan'])) {
    header("Location: dashboard.php");
    exit();
}

$id_pesan = $_GET['id_pesan'];

// Ambil data pesanan
$query = mysqli_query($conn, "SELECT p.*, m.nama_mobil, m.merek_mobil 
                             FROM pemesanan p 
                             JOIN mobil m ON p.id_mobil = m.id_mobil 
                             WHERE p.id_pesan = $id_pesan");

// Check if query failed
if (!$query) {
    echo "Error in query: " . mysqli_error($conn);
    exit();
}

// Check if any rows were returned
if (mysqli_num_rows($query) == 0) {
    echo "Order #$id_pesan not found.";
    echo "<br><a href='index.php'>Return to Home</a>";
    exit();
}
$id_user = $_SESSION['user_id'];

$pesanan = mysqli_fetch_assoc($query);
$admin_id = $id_user;
$pesan = "Pesanan baru oleh user ID " . $_SESSION['user_id'];

$pesan = "Pesanan baru oleh " . $_SESSION['first_name'] . " " . $_SESSION['last_name'];
$admins = mysqli_query($conn, "SELECT id_user FROM users WHERE role = 'admin'");
while ($admin = mysqli_fetch_assoc($admins)) {
    tambah_notifikasi($admin['id_user'], $pesanan['id_pesan'], $pesan);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil | FlexDrive</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <div style="height: 70px;">
        <?php require "../navbar_user.php"; ?>
    </div> 

    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg text-center">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <ion-icon name="checkmark-outline" class="text-green-500 text-4xl"></ion-icon>
        </div>
        
        <h2 class="text-2xl font-bold mb-2">Pembayaran Berhasil Dikirim!</h2>
        <p class="text-gray-600 mb-6">Terima kasih telah melakukan pembayaran. Tim kami akan segera memverifikasi pembayaran Anda.</p>
        
        <div class="bg-gray-50 p-4 rounded-lg mb-6">
            <p class="font-semibold"><?= $pesanan['merek_mobil'] . ' ' . $pesanan['nama_mobil']; ?></p>
            <p class="text-sm text-gray-600 mt-1">
                <?= date('d M Y', strtotime($pesanan['tanggal_pengambilan'])); ?> - 
                <?= date('d M Y', strtotime($pesanan['tanggal_pengembalian'])); ?>
            </p>
            <p class="text-sm text-gray-600 mt-1">
                Lokasi Pengambilan: <?= $pesanan['lokasi_pengambilan']; ?>
            </p>
        </div>
        
        <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg mb-6">
            <p class="text-sm">
                <span class="font-semibold">Status:</span> Menunggu Konfirmasi Admin
            </p>
            <p class="text-sm mt-1">
                Notifikasi telah dikirim ke admin. Kami akan menghubungi Anda melalui WhatsApp dalam 1x24 jam.
            </p>
        </div>
        
        <a href="pesanan_user.php" class="inline-block bg-black text-white px-6 py-2 rounded hover:bg-gray-800 transition">
            Lihat Pesanan Saya
        </a>
    </div>
</body>
</html>
