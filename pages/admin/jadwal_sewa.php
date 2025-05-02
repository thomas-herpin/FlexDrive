<?php
require_once '../config.php';

$status_con = 'dikonfirmasi';
$status_rej = 'dibatalkan';

function tampilkanStatus($status) {
    switch (strtolower($status)) {
        case 'dikonfirmasi':
            return '<span class="inline-block px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full">Dikonfirmasi</span>';
        case 'menunggu':
            return '<span class="inline-block px-3 py-1 text-sm font-medium text-yellow-800 bg-yellow-100 rounded-full">Menunggu</span>';
        case 'dibatalkan':
            return '<span class="inline-block px-3 py-1 text-sm font-medium text-red-800 bg-red-100 rounded-full">Dibatalkan</span>';
    }
}

// Filter dan Pagination
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$tanggal_filter = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;


if (isset($_POST['ubahstatusberhasil'])) {
    $id_pesan = isset($_POST['id_pesan']) ? (int)$_POST['id_pesan'] : 0;
    
    if ($id_pesan > 0) {
        $update = mysqli_query($conn, "UPDATE pembayaran
                                     SET status_pembayaran = '$status_con' 
                                     WHERE id_pesan = $id_pesan");

        if ($update) {
            $_SESSION['success_message'] = "Berhasil Mengkonfirmasi";
            header("Location: jadwal_sewa.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Gagal mengkonfirmasi: " . mysqli_error($conn);
            header("Location: jadwal_sewa.php");
            exit();
        }
    }
} elseif (isset($_POST['ubahstatusditolak'])) {
    $id_pesan = isset($_POST['id_pesan']) ? (int)$_POST['id_pesan'] : 0;
    
    if ($id_pesan > 0) {
        $update = mysqli_query($conn, "UPDATE pembayaran
                                     SET status_pembayaran = '$status_rej' 
                                     WHERE id_pesan = $id_pesan");

        if ($update) {
            $_SESSION['success_message'] = "Berhasil menolak pesanan";
            header("Location: jadwal_sewa.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Gagal menolak pesanan: " . mysqli_error($conn);
            header("Location: jadwal_sewa.php");
            exit();
        }
    }
}

$query = "SELECT p.*, m.*, u.*, pb.*
          FROM pemesanan p
          INNER JOIN mobil m ON p.id_mobil = m.id_mobil
          INNER JOIN users u ON p.id_user = u.id_user
          INNER JOIN pembayaran pb ON p.id_pesan = pb.id_pesan
          WHERE 1=1";

if (!empty($status_filter) && $status_filter != 'Semua Status') {
    $query .= " AND pb.status_pembayaran = '$status_filter'";
}

if (!empty($tanggal_filter)) {
    $query .= " AND p.tanggal_pengambilan = '$tanggal_filter'";
}

$query .= " LIMIT $limit OFFSET $offset"; // Pagination
$ambildatapesanan = mysqli_query($conn, $query);

if (!$ambildatapesanan) {
    die("Query failed: " . mysqli_error($conn));
}

$total_query = "SELECT COUNT(*) AS total FROM pemesanan p
                INNER JOIN pembayaran pb ON p.id_pesan = pb.id_pesan
                WHERE 1=1";

if (!empty($status_filter) && $status_filter != 'Semua Status') {
    $total_query .= " AND pb.status_pembayaran = '$status_filter'";
}

if (!empty($search_query)) {
    $total_query .= " AND (u.first_name LIKE '%$search_query%' OR u.last_name LIKE '%$search_query%' OR m.nama_mobil LIKE '%$search_query%')";
}

if (!empty($tanggal_filter)) {
    $total_query .= " AND p.tanggal_pengambilan = '$tanggal_filter'";
}

$total_result = mysqli_query($conn, $total_query);
$total_data = mysqli_fetch_assoc($total_result);
$total_jadwal = $total_data['total'];
$total_pages = ceil($total_jadwal / $limit);

$count_confirmed = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pembayaran WHERE status_pembayaran = 'dikonfirmasi'"))['total'];
$count_pending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pembayaran WHERE status_pembayaran = 'menunggu'"))['total'];
$count_rejected = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pembayaran WHERE status_pembayaran = 'dibatalkan'"))['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Penyewaan | FlexDrive</title>
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
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navbar -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center">
                        <button class="text-gray-500 md:hidden mr-4">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-xl font-semibold text-gray-800">Jadwal Penyewaan</h1>
                    </div>
                </div>
            </header>

            <!-- Summary -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <!-- Filter & Actions -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                    <div class="flex items-center space-x-2">
                        <div class="relative">
                            <form method="GET" action="">
                                <select name="status" onchange="this.form.submit()" class="appearance-none bg-white border border-gray-300 rounded-lg py-2 pl-3 pr-10 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <option value="">Semua Status</option>
                                    <option value="dikonfirmasi" <?= $status_filter == 'dikonfirmasi' ? 'selected' : ''; ?>>Dikonfirmasi</option>
                                    <option value="Menunggu" <?= $status_filter == 'Menunggu' ? 'selected' : ''; ?>>Menunggu</option>
                                    <option value="dibatalkan" <?= $status_filter == 'Dibatalkan' ? 'selected' : ''; ?>>Dibatalkan</option>
                                </select>
                                <i class="fas fa-chevron-down text-gray-400 absolute right-3 top-3 pointer-events-none"></i>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-success">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-success/10 mr-4">
                                <i class="fas fa-check text-success text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Dikonfirmasi</p>
                                <p class="text-2xl font-bold"><?= $count_confirmed; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-warning">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-warning/10 mr-4">
                                <i class="fas fa-clock text-warning text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Menunggu</p>
                                <p class="text-2xl font-bold"><?= $count_pending; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-danger">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-danger/10 mr-4">
                                <i class="fas fa-times text-danger text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Dibatalkan</p>
                                <p class="text-2xl font-bold"><?= $count_rejected; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="flex items-center justify-between p-4 border-b">
                        <h2 class="text-lg font-medium">Daftar Penyewaan</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-100">
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
                                    if (mysqli_num_rows($ambildatapesanan) > 0) {
                                        while ($data = mysqli_fetch_array($ambildatapesanan)) {
                                            $nama_mobil = $data['merek_mobil'].' '. $data['nama_mobil'];
                                            $nama_user = $data['first_name'] . ' ' . $data['last_name'];
                                            $email = $data['email'];
                                            $status = $data['status_pembayaran'];
                                            $tgl_ambil = $data['tanggal_pengambilan'];
                                            $tgl_kembali = $data['tanggal_pengembalian'];
                                            $inisial = strtoupper(substr($data['first_name'], 0, 1) . substr($data['last_name'], 0, 1));
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
                                    <td class="px-6 py-4 whitespace-nowrap"><?=$nama_mobil;?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?=$tgl_ambil;?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?=$tgl_kembali;?></td>
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
                    <!-- Pagination for Jadwal Sewa -->
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-4 rounded-lg shadow-md">
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Menampilkan <span class="font-medium"><?= $offset + 1; ?></span> sampai <span class="font-medium"><?= min($offset + $limit, $total_jadwal); ?></span>
                                    dari <span class="font-medium"><?= $total_jadwal; ?></span> jadwal
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Previous</span>
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-black text-sm font-medium text-white">
                                        1
                                    </a>
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Next</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>