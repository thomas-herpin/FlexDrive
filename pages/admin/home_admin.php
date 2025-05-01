<?php
require_once '../config.php';

$id_user = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT pesan, dibuat FROM notifikasi WHERE id_user = ? ORDER BY dibuat DESC LIMIT 5");

if ($stmt === false) {
    die("Error in preparing statement: " . mysqli_error($conn)); // Menampilkan pesan error jika prepare gagal
}

$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

// Mengambil notifikasi ke dalam array
$notifikasi_baru = [];
while ($row = $result->fetch_assoc()) {
    $notifikasi_baru[] = $row;
}
$stmt->close();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../sign_in.php");
    exit();
}

$status_con = 'Dikonfirmasi';
$status_can = 'Dibatalkan';

function tampilkanStatus($status) {
    switch (strtolower($status)) {
        case 'dikonfirmasi':
            return '<span class="inline-block px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full">Dikonfirmasi</span>';
        case 'menunggu':
            return '<span class="inline-block px-3 py-1 text-sm font-medium text-yellow-800 bg-yellow-100 rounded-full">Menunggu</span>';
        case 'ditolak':
            return '<span class="inline-block px-3 py-1 text-sm font-medium text-red-800 bg-red-100 rounded-full">Ditolak</span>';
    }
}

if (isset($_POST['ubahstatusberhasil'])) {
    // Pastikan id_pesan ada dan valid
    $id_pesan = isset($_POST['id_pesan']) ? (int)$_POST['id_pesan'] : 0;
    
    if ($id_pesan > 0) {
        $update = mysqli_query($conn, "UPDATE pembayaran
                                     SET status_pembayaran = '$status_con' 
                                     WHERE id_pesan = $id_pesan");

        if ($update) {
            $_SESSION['success_message'] = "Berhasil Mengkonfirmasi";
            header("Location: home_admin.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Gagal mengkonfirmasi: " . mysqli_error($conn);
            header("Location: home_admin.php");
            exit();
        }
    }
} elseif (isset($_POST['ubahstatusbatal'])) {
    // Pastikan id_pesan ada dan valid
    $id_pesan = isset($_POST['id_pesan']) ? (int)$_POST['id_pesan'] : 0;
    
    if ($id_pesan > 0) {
        $update = mysqli_query($conn, "UPDATE pembayaran
                                     SET status_pembayaran = '$status_can' 
                                     WHERE id_pesan = $id_pesan");

        if ($update) {
            $_SESSION['success_message'] = "Berhasil membatalkan";
            header("Location: home_admin.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Gagal membatalkan: " . mysqli_error($conn);
            header("Location: home_admin.php");
            exit();
        }
    }
}

$user_id = $_SESSION['user_id'];
$query = $conn->prepare("SELECT first_name FROM users WHERE id_user = ? AND role = 'admin'");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    header("Location: ../sign_in.php");
    exit();
}

$user_data = $result->fetch_assoc();
$first_name = $user_data['first_name'];

$tersedia = mysqli_query($conn, "SELECT * FROM mobil WHERE status = 'Tersedia'");
$disewa = mysqli_query($conn, "SELECT * FROM mobil WHERE status ='Disewa'");
$penyewa = mysqli_query($conn, "SELECT * FROM pembayaran WHERE status_pembayaran='Dikonfirmasi'");
$mobil_tersedia = mysqli_num_rows($tersedia);
$mobil_disewa = mysqli_num_rows($disewa);
$total_penyewa = mysqli_num_rows($penyewa);
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | FlexDrive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#3E92CC",
                        secondary: "black",
                        success: "#10B981",
                        warning: "#F59E0B",
                        danger: "#EF4444",
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php require "../sidebar_admin.php";?>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow-sm">
                <div class="flex justify-between items-center py-4 px-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                        <p class="text-sm text-gray-600">Selamat datang, <?= htmlspecialchars($first_name) ?>!</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 rounded-full hover:bg-gray-100">
                            <i class="fas fa-search text-gray-500"></i>
                        </button>
                        <a href="notifikasi.php">
                            <button class="p-2 rounded-full hover:bg-gray-100 relative">
                                <i class="fas fa-bell text-gray-500"></i>
                                <span class="absolute top-0 right-0 h-4 w-4 bg-danger rounded-full text-xs text-white flex items-center justify-center">3</span>
                            </button>
                        </a>
                    </div>
                </div>
            </header>

            <main class="p-6">
                <!-- Summary -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 mr-4">
                                <i class="fas fa-car text-blue-500"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Mobil Tersedia</p>
                                <h3 class="text-3xl font-bold text-gray-800"><?=$mobil_tersedia;?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-purple-500">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 mr-4">
                                <i class="fas fa-key text-purple-500"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Mobil Disewa</p>
                                <h3 class="text-3xl font-bold text-gray-800"><?=$mobil_disewa;?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-amber-500">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-amber-100 mr-4">
                                <i class="fas fa-users text-amber-500"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Penyewa</p>
                                <h3 class="text-3xl font-bold text-gray-800"><?=$total_penyewa;?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Permintaan Sewa Terbaru -->
                <div class="mt-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Permintaan Sewa Terbaru</h2>
                        <a href="jadwal_sewa.php" class="text-sm font-medium text-blue-600 hover:underline">Lihat semua</a>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-50 text-left">
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Mobil</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Ambil</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Kembali</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                <?php
                                    $ambildatapesanan = mysqli_query($conn, "SELECT p.*, m.*, u.*, pb.*
                                        FROM pemesanan p
                                        INNER JOIN mobil m ON p.id_mobil = m.id_mobil
                                        INNER JOIN users u ON p.id_user = u.id_user
                                        INNER JOIN pembayaran pb ON p.id_pesan = pb.id_pesan;");

                                    if (!$ambildatapesanan) {
                                        die("Query failed: " . mysqli_error($conn));
                                    }

                                    if (mysqli_num_rows($ambildatapesanan) > 0) {
                                        while ($data = mysqli_fetch_array($ambildatapesanan)) {
                                            
                                            $nama_mobil = $data['merek_mobil'].' '. $data['nama_mobil'];
                                            $nama_user = $data['first_name'] . ' ' . $data['last_name'];
                                            $email = $data['email'];
                                            $tahun = $data['tahun_produksi'];
                                            $tipe = $data['tipe_mobil'];
                                            $transmission = $data['transmission'];
                                            $mesin = $data['engine'];
                                            $plat = $data['nomor_plat'];
                                            $bbm = $data['bahan_bakar'];
                                            $interior = $data['interior_color'];
                                            $exterior = $data['exterior_color'];
                                            $seats = $data['seats'];
                                            $status = $data['status_pembayaran'];
                                            $id_mobil = $data['id_mobil'];
                                            $tgl_ambil = date('d/m/Y', strtotime($data['tanggal_pengambilan']));
                                            $tgl_kembali = date('d/m/Y', strtotime($data['tanggal_pengembalian']));   
                                ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-left">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 flex-shrink-0 rounded-full bg-black flex items-center justify-center text-white font-bold uppercase">
                                                        <?= $inisial ?>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900"><?=$nama_user;?></div>
                                                        <div class="text-sm text-gray-500"><?=$email;?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900"><?=$nama_mobil;?></div>
                                                <div class="text-sm text-gray-500"><?=$plat;?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900"><?=$tgl_ambil;?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900"><?=$tgl_kembali;?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?=tampilkanStatus($status);?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <form method="POST" action="" style="display: inline;">
                                                    <input type="hidden" name="id_pesan" value="<?= $data['id_pesan'] ?>">
                                                    <button type="submit" name="ubahstatusberhasil" class="text-green-600 hover:text-green-900 mr-3">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button type="submit" name="ubahstatusditolak" class="text-red-600 hover:text-red-900">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    }    
                                    ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Data & Aktivitas -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
                    <!-- Pengembalian Hari ini -->
                    <div class="bg-white rounded-lg shadow-sm p-6 lg:col-span-2">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Pengembalian Hari Ini</h3>
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <div class="h-12 w-12 flex-shrink-0 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <i class="fas fa-car text-indigo-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Toyota Rush - BK 9876 DF</p>
                                    <p class="text-sm text-gray-500">Ahmad Fadli · 15:30</p>
                                </div>
                                <div class="ml-auto">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Dalam Perjalanan
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <div class="h-12 w-12 flex-shrink-0 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <i class="fas fa-car text-indigo-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Toyota Veloz - BK 2358 PO</p>
                                    <p class="text-sm text-gray-500">Maya Putri · 18:00</p>
                                </div>
                                <div class="ml-auto">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Tepat Waktu
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Aktivitas Terbaru -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Aktivitas Terbaru</h3>
                        <a href="jadwal_sewa.php">
                        <div class="space-y-4">
                            <?php foreach ($notifikasi_baru as $notif): ?>
                                <div class="border-l-2 border-blue-500 pl-4">
                                    <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($notif['pesan']) ?></div>
                                    <div class="text-xs text-gray-400 mt-1">
                                        <?= date("d/m/Y H:i", strtotime($notif['dibuat'])) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        </a>
                    </div>
                </div>  
            </main>
        </div>
    </div>
</body>
</html>