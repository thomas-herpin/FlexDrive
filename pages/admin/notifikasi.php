<?php
require_once '../config.php';

// Pastikan hanya admin yang bisa akses
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../sign_in.php");
    exit();
}

// Tandai notifikasi sebagai sudah dibaca saat halaman dibuka
if (isset($_SESSION['user_id'])) {
    $id_user = $_SESSION['user_id'];
    $stmt = $conn->prepare("UPDATE notifikasi SET dibaca = TRUE WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    
    // Ambil notifikasi terbaru
    $stmt = $conn->prepare("
        SELECT n.*, p.tanggal_pengambilan, u.first_name, u.last_name, m.merek_mobil, m.nama_mobil 
        FROM notifikasi n
        JOIN pemesanan p ON n.id_pesan = p.id_pesan
        JOIN users u ON p.id_user = u.id_user
        JOIN mobil m ON p.id_mobil = m.id_mobil
        WHERE n.id_user = ?
        ORDER BY n.dibuat DESC
    ");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $notifikasi = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi | FlexDrive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <?php require "../sidebar_admin.php"; ?>

        <div class="flex-1 p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold">Notifikasi Pesanan Baru</h1>
                <span class="text-sm text-gray-500">
                    <?= count($notifikasi) ?> total notifikasi
                </span>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <?php if (empty($notifikasi)): ?>
                    <div class="p-8 text-center text-gray-500">
                        <i class="fas fa-bell-slash text-4xl mb-2"></i>
                        <p>Tidak ada notifikasi pesanan baru</p>
                    </div>
                <?php else: ?>
                    <ul class="divide-y divide-gray-200 p-2">
                        <?php foreach ($notifikasi as $notif): ?>
                            <li class="mb-3">
                                <a href="jadwal_sewa.php?id=<?= $notif['id_pesan'] ?>" class="block p-4 border-l-4 border-blue-500 bg-blue-50 text-blue-900 rounded shadow hover:bg-blue-100 transition">
                                    <p class="text-sm font-semibold">
                                        <?= htmlspecialchars($notif['first_name'].' '.$notif['last_name']) ?> memesan 
                                        <?= htmlspecialchars($notif['merek_mobil'].' '.$notif['nama_mobil']) ?>
                                    </p>
                                    <p class="text-sm text-gray-700">
                                        Untuk tanggal <?= date('d M Y', strtotime($notif['tanggal_pengambilan'])) ?>
                                    </p>
                                    <p class="text-xs text-gray-600 mt-1">
                                        <?= date('d M Y H:i', strtotime($notif['dibuat'])) ?>
                                    </p>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>