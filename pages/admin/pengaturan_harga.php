<?php
require_once '../config.php';

if (isset($_SESSION['error'])) {
    echo '<div class="fixed top-20 right-6 z-50">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg flex items-start" role="alert">
                <div class="flex-1">
                    <span class="block">'.$_SESSION['error'].'</span>
                </div>
                <button type="button" class="ml-4" onclick="this.parentElement.parentElement.remove()">
                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
          </div>';
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo '<div class="fixed top-20 right-6 z-50">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg flex items-start" role="alert">
                <div class="flex-1">
                    <span class="block">'.$_SESSION['success'].'</span>
                </div>
                <button type="button" class="ml-4" onclick="this.parentElement.parentElement.remove()">
                    <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
          </div>';
    unset($_SESSION['success']);
}

$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$tipe_filter = isset($_GET['tipe']) ? $_GET['tipe'] : '';
$search_query = isset($_GET['search']) ? $_GET['search'] : '';


$query = "SELECT m.*, h.per_hari, h.per_minggu, h.per_bulan FROM mobil m INNER JOIN harga_mobil h ON m.id_mobil = h.id_mobil WHERE 1=1";
if (!empty($status_filter) && $status_filter != 'Semua Status') {
    $query .= " AND m.status = '$status_filter'";
}

if (!empty($tipe_filter) && $tipe_filter != 'Semua Tipe') {
    $query .= " AND m.tipe_mobil = '$tipe_filter'";
}

if (!empty($search_query)) {
    $query .= " AND (m.merek_mobil LIKE '%$search_query%' OR m.nama_mobil LIKE '%$search_query%' OR m.nomor_plat LIKE '%$search_query%')";
}

$total_mobil_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM mobil");
$total_mobil_data = mysqli_fetch_assoc($total_mobil_query);
$total_mobil = $total_mobil_data['total'];

$ambilsemuadatamobil = mysqli_query($conn, $query);
$jumlah_ditampilkan = mysqli_num_rows($ambilsemuadatamobil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Harga | FlexDrive</title>
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
        
        function applyFilters() {
            document.getElementById('filterForm').submit();
        }
        
        function validateBulkUpdate() {
            const percentage = document.querySelector('input[name="percentage"]').value;
            if (!percentage || isNaN(percentage) || percentage <= 0) {
                alert('Masukkan persentase yang valid (angka lebih besar dari 0)');
                return false;
            }
            return true;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const notifications = document.querySelectorAll('[role="alert"]');
            notifications.forEach(notification => {
                setTimeout(() => {
                    notification.parentElement.remove();
                }, 3000);
            });
        });
    </script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php require "../sidebar_admin.php";?>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            <header class="bg-white shadow-sm">
                <div class="flex justify-between items-center py-4 px-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Pengaturan Mobil</h1>
                        <p class="text-sm text-gray-600">Kelola daftar dan harga sewa mobil</p>
                    </div>
                    <div class="flex items-center">
                        <a href="tambah_mobil.php"><button class="bg-black hover:bg-gray-800 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Mobil
                        </button></a>
                    </div>
                </div>
            </header>

            <main class="p-6">
                <!-- Tab Navigation -->
                <div class="mb-6 border-b border-gray-200">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="tabNavigation">
                        <li class="mr-2">
                            <a href="list_mobil_admin.php"><button class="inline-block p-4 border-b-2 hover:text-gray-600 hover:border-gray-300 rounded-t-lg" id="daftar-tab">
                                <i class="fas fa-list mr-2"></i>Daftar Mobil
                            </button></a>
                        </li>
                        <li class="mr-2">
                            <a href="pengaturan_harga.php"><button class="inline-block p-4 border-b-2 border-primary text-primary rounded-t-lg active" id="harga-tab">
                                <i class="fas fa-dollar-sign mr-2"></i>Pengaturan Harga
                            </button></a>
                        </li>
                    </ul>
                </div>

                <!-- Filter dan Pencarian -->
                <form id="filterForm" method="GET" action="pengaturan_harga.php" class="mb-6 flex flex-wrap justify-between items-center">
                    <div class="flex space-x-2 mb-2 sm:mb-0">
                        <select name="status" class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-primary" onchange="applyFilters()">
                            <option value="Semua Status" <?= $status_filter == 'Semua Status' || empty($status_filter) ? 'selected' : '' ?>>Semua Status</option>
                            <option value="Tersedia" <?= $status_filter == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                            <option value="Sedang Disewa" <?= $status_filter == 'Sedang Disewa' ? 'selected' : '' ?>>Sedang Disewa</option>
                            <option value="Tidak Aktif" <?= $status_filter == 'Tidak Aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                        </select>
                        <select name="tipe" class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-primary" onchange="applyFilters()">
                            <option value="Semua Tipe" <?= $tipe_filter == 'Semua Tipe' || empty($tipe_filter) ? 'selected' : '' ?>>Semua Tipe</option>
                            <option value="MPV" <?= $tipe_filter == 'MPV' ? 'selected' : '' ?>>MPV</option>
                            <option value="SUV" <?= $tipe_filter == 'SUV' ? 'selected' : '' ?>>SUV</option>
                            <option value="Hatchback" <?= $tipe_filter == 'Hatchback' ? 'selected' : '' ?>>Hatchback</option>
                            <option value="Minibus" <?= $tipe_filter == 'Minibus' ? 'selected' : '' ?>>Minibus</option>
                        </select>
                    </div>
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari mobil..." value="<?= htmlspecialchars($search_query) ?>" 
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary w-full sm:w-64">
                        <button type="submit" class="absolute left-3 top-2.5 text-gray-500">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Daftar Harga Sewa Mobil</h2>
                        <p class="text-sm text-gray-600">Kelola harga sewa untuk semua kendaraan</p>
                    </div>
                </div>
                
                <!-- Price Settings Table -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mobil</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga/hari</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga/minggu</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga/bulan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php
                                    if ($jumlah_ditampilkan > 0) {
                                        while($data=mysqli_fetch_array($ambilsemuadatamobil)){
                                            $merek = $data['merek_mobil'];
                                            $nama = $data['nama_mobil'];
                                            $tahun = $data['tahun_produksi'];
                                            $plat = $data['nomor_plat'];
                                            $status = $data['status'];
                                            $tipe = $data['tipe_mobil'];
                                            $hari = number_format($data['per_hari'], 0, ',', '.');
                                            $minggu = number_format($data['per_minggu'], 0, ',', '.');
                                            $bulan = number_format($data['per_bulan'], 0, ',', '.');
                                            $id_mobil = $data['id_mobil'];
                                            $kode_mobil = 'MBL-' . sprintf('%03d', $id_mobil);
                                            
                                            $status_color = 'bg-green-100 text-green-800';
                                            if ($status == 'Sedang Disewa') {
                                                $status_color = 'bg-yellow-100 text-yellow-800';
                                            } elseif ($status == 'Tidak Aktif') {
                                                $status_color = 'bg-red-100 text-red-800';
                                            }
                                ?> 
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-md bg-gray-100 flex items-center justify-center">
                                                <i class="fas fa-car text-gray-500"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900"><?=$merek;?> <?=$nama;?> <?=$tahun;?></div>
                                                <div class="text-sm text-gray-500">ID : <?=$kode_mobil;?></div>
                                                <div class="text-sm text-gray-500"><?=$plat;?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            <?=$tipe;?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">Rp <?=$hari;?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">Rp <?=$minggu;?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">Rp <?=$bulan;?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?=$status_color;?>">
                                            <?=$status;?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        <a href="edit_harga.php?id_mobil=<?=$id_mobil;?>" class="text-primary hover:text-blue-700 mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                        }
                                    } else {
                                ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Tidak ada data mobil yang ditemukan
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-4 rounded-lg shadow-md">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium"><?= $jumlah_ditampilkan; ?></span>
                                dari <span class="font-medium"><?= $total_mobil; ?></span> kendaraan
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
                
                <!-- Bulk Edit Section -->
                <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengaturan Harga Massal</h3>
                    <p class="text-sm text-gray-600 mb-4">Atur harga untuk beberapa kendaraan sekaligus</p>
                    
                    <form method="POST" action="bulk_update_harga.php" onsubmit="return validateBulkUpdate()">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Kendaraan</label>
                                <select name="bulk_tipe" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="">Semua Tipe</option>
                                    <option value="MPV">MPV</option>
                                    <option value="SUV">SUV</option>
                                    <option value="Hatchback">Hatchback</option>
                                    <option value="Minibus">Minibus</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Harga</label>
                                <select name="price_type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="per_hari">Per Hari</option>
                                    <option value="per_minggu">Per Minggu</option>
                                    <option value="per_bulan">Per Bulan</option>
                                    <option value="all">Semua Jenis Harga</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Persentase Perubahan</label>
                                <input type="number" name="percentage" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="contoh: 10 untuk kenaikan 10%" min="1" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Perubahan</label>
                                <select name="change_type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="increase">Kenaikan (%)</option>
                                    <option value="decrease">Penurunan (%)</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="bg-black hover:bg-gray-500 text-white px-4 py-2 rounded-md transition-colors">
                                Terapkan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>