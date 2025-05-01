<?php
require_once '../config.php';

if(isset($_POST['hapusmobil'])){
    $id_mobil = $_POST['id_mobil'];
    $hapus = mysqli_query($conn, "DELETE FROM mobil WHERE id_mobil = '$id_mobil'");
    header("location: list_mobil_admin.php");
    exit();
}

$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$tipe_filter = isset($_GET['tipe']) ? $_GET['tipe'] : '';
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT m.*, h.per_hari FROM mobil m INNER JOIN harga_mobil h ON m.id_mobil = h.id_mobil WHERE 1=1";
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
    <title>List Mobil | FlexDrive</title>
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

        function toggleSelectAll(source) {
            const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
        }

        function handleIndividualCheckbox() {
            const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
            const selectAllCheckbox = document.querySelector('thead input[type="checkbox"]');
            
            const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
            selectAllCheckbox.checked = allChecked;
        }
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
                            <a href="list_mobil_admin.php"><button class="inline-block p-4 border-b-2 border-primary text-primary rounded-t-lg active" id="daftar-tab">
                                <i class="fas fa-list mr-2"></i>Daftar Mobil
                            </button></a>
                        </li>
                        <li class="mr-2">
                            <a href="pengaturan_harga.php"><button class="inline-block p-4 border-b-2 hover:text-gray-600 hover:border-gray-300 rounded-t-lg" id="harga-tab">
                                <i class="fas fa-dollar-sign mr-2"></i>Pengaturan Harga
                            </button></a>
                        </li>
                    </ul>
                </div>

                <!-- Filter dan Pencarian -->
                <form id="filterForm" method="GET" action="list_mobil_admin.php" class="mb-6 flex flex-wrap justify-between items-center">
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

                <!-- Daftar Mobil -->
                <div class="tab-content">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <input type="checkbox" class="rounded text-primary" onclick="toggleSelectAll(this)">
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mobil</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Plat</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga/Hari</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <?php
                                        if ($jumlah_ditampilkan > 0) {
                                            while($data=mysqli_fetch_array($ambilsemuadatamobil)){
                                                $merek = $data['merek_mobil'];
                                                $nama = $data['nama_mobil'];
                                                $tahun = $data['tahun_produksi'];
                                                $plat = $data['nomor_plat'];
                                                $status = $data['status'];
                                                $harga = $data['per_hari'];
                                                $id_mobil = $data['id_mobil'];
                                                
                                                $status_color = 'bg-green-100 text-green-800';
                                                if ($status == 'Sedang Disewa') {
                                                    $status_color = 'bg-yellow-100 text-yellow-800';
                                                } elseif ($status == 'Tidak Aktif') {
                                                    $status_color = 'bg-red-100 text-red-800';
                                                }
                                    ?>
                                    <tr class="hover:bg-gray-200">
                                        <td class="px-6 py-4">
                                            <input type="checkbox" class="rounded text-primary" onclick="handleIndividualCheckbox()" value="<?=$id_mobil;?>">
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900"><?=$merek;?> <?=$nama;?> · <?=$tahun;?></td>
                                        <td class="px-6 py-4 text-sm text-gray-900"><?=$plat;?></td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $status_color ?>">
                                                <?=$status;?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">Rp <?= number_format($harga, 0, ',', '.'); ?></td>
                                        <td class="px-6 py-4 text-sm font-medium text-left flex space-x-3">
                                            <a href="edit_mobil.php?id=<?= $id_mobil ?>" class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></a>
                                            <!-- Form untuk Hapus Mobil -->
                                            <form action="list_mobil_admin.php" method="POST" style="display:inline;">
                                                <input type="hidden" name="id_mobil" value="<?=$id_mobil;?>">
                                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus" name="hapusmobil">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        } else {
                                    ?>
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
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
                    
                    <!-- Pagination untuk Daftar Mobil -->
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-4 rounded-lg shadow-md">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Sebelumnya
                            </a>
                            <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Selanjutnya
                            </a>
                        </div>
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
            </main>
        </div>
    </div>
</body>
</html>