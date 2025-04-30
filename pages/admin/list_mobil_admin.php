<?php
require_once '../config.php';



if(isset($_POST['hapusmobil'])){
    $id_mobil = $_POST['id_mobil'];

    $hapus = mysqli_query($conn, "DELETE FROM mobil WHERE id_mobil = '$id_mobil'");

    if ($hapus) {
        header("location: list_mobil_admin.php");
    } else {
        echo "Gagal menghapus mobil.";
        header("location: list_mobil_admin.php");
    }
}
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
                <div class="mb-6 flex flex-wrap justify-between items-center">
                    <div class="flex space-x-2 mb-2 sm:mb-0">
                        <select class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                            <option>Semua Status</option>
                            <option>Tersedia</option>
                            <option>Sedang Disewa</option>
                            <option>Tidak Aktif</option>
                        </select>
                        <select class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                            <option>Semua Tipe</option>
                            <option>MPV</option>
                            <option>SUV</option>
                            <option>Hatchback</option>
                            <option>Minibus</option>
                        </select>
                    </div>
                    <div class="relative">
                        <input type="text" placeholder="Cari mobil..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary w-full sm:w-64">
                        <button class="absolute left-3 top-2.5 text-gray-500">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Daftar Mobil -->
                <div class="tab-content">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <input type="checkbox" class="rounded text-primary">
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
                                        $ambilsemuadatamobil = mysqli_query($conn, "SELECT m.*, h.per_hari FROM mobil m INNER JOIN harga_mobil h ON m.id_mobil = h.id_mobil");
                                        while($data=mysqli_fetch_array($ambilsemuadatamobil)){
                                            $merek = $data['merek_mobil'];
                                            $nama = $data['nama_mobil'];
                                            $tahun = $data['tahun_produksi'];
                                            $plat = $data['nomor_plat'];
                                            $status = $data['status'];
                                            $harga = $data['per_hari'];
                                            $id_mobil = $data['id_mobil'];

                                    ?>
                                    <tr class="hover:bg-gray-200">
                                        <td class="px-6 py-4"><input type="checkbox" class="rounded text-primary"></td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900"><?=$merek;?> <?=$nama;?> · <?=$tahun;?></td>
                                        <td class="px-6 py-4 text-sm text-gray-900"><?=$plat;?></td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                <?=$status;?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">RP <?= number_format($harga, 0, ',', '.'); ?></td>
                                        <td class="px-6 py-4 text-sm font-medium">
                                            <button class="text-green-600 hover:text-green-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
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
                                        };
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
                                    Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">9</span> dari <span class="font-medium">9</span> kendaraan
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
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Kendaraan</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="">Semua Tipe</option>
                                <option value="MPV">MPV</option>
                                <option value="SUV">SUV</option>
                                <option value="Hatchback">Hatchback</option>
                                <option value="Van">Minibus</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Persentase Perubahan</label>
                            <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="contoh: 10 untuk kenaikan 10%">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Perubahan</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="increase">Kenaikan (%)</option>
                                <option value="decrease">Penurunan (%)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button class="bg-black hover:bg-gray-500 text-white px-4 py-2 rounded-md transition-colors">
                            Terapkan Perubahan
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>