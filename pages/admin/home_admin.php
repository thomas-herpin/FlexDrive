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
                        <p class="text-sm text-gray-600">Selamat datang, Admin!</p>
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
                                <h3 class="text-3xl font-bold text-gray-800">24</h3>
                            </div>
                            <div class="ml-auto text-green-500 flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span class="text-sm">5%</span>
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
                                <h3 class="text-3xl font-bold text-gray-800">10</h3>
                            </div>
                            <div class="ml-auto text-green-500 flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span class="text-sm">12%</span>
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
                                <h3 class="text-3xl font-bold text-gray-800">134</h3>
                            </div>
                            <div class="ml-auto text-green-500 flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span class="text-sm">8%</span>
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
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0 rounded-full bg-blue-100 flex items-center justify-center">
                                                    <span class="text-blue-800 font-medium">BS</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Budi Santoso</div>
                                                    <div class="text-sm text-gray-500">budisans3@gmail.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Daihatsu Xenia</div>
                                            <div class="text-sm text-gray-500">BK 14 XY</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">6 Maret 2025</div>
                                            <div class="text-sm text-gray-500">08:00 - 20:00</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Dikonfirmasi
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="text-green-600 hover:text-green-900 mr-3"><i class="fas fa-check"></i></button>
                                            <button class="text-red-600 hover:text-red-900"><i class="fas fa-times"></i></button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0 rounded-full bg-pink-100 flex items-center justify-center">
                                                    <span class="text-pink-800 font-medium">SR</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Siti Rahma</div>
                                                    <div class="text-sm text-gray-500">sitirahma32@gmail.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Suzuki Ertiga</div>
                                            <div class="text-sm text-gray-500">BK 5678 AB</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">7 Maret 2025</div>
                                            <div class="text-sm text-gray-500">09:00 - 17:00</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Menunggu
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="text-green-600 hover:text-green-900 mr-3"><i class="fas fa-check"></i></button>
                                            <button class="text-red-600 hover:text-red-900"><i class="fas fa-times"></i></button>
                                        </td>
                                    </tr>
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
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Aktivitas Terbaru</h3>
                        <div class="space-y-4">
                            <div class="border-l-2 border-blue-500 pl-4">
                                <p class="text-sm font-medium text-gray-900">Permintaan baru</p>
                                <p class="text-sm text-gray-500">Siti Rahma memesan Suzuki Ertiga</p>
                                <p class="text-xs text-gray-400 mt-1">10 menit yang lalu</p>
                            </div>
                            <div class="border-l-2 border-green-500 pl-4">
                                <p class="text-sm font-medium text-gray-900">Penyewaan selesai</p>
                                <p class="text-sm text-gray-500">Suzuki Ertiga dikembalikan oleh Andi</p>
                                <p class="text-xs text-gray-400 mt-1">1 jam yang lalu</p>
                            </div>
                            <div class="border-l-2 border-purple-500 pl-4">
                                <p class="text-sm font-medium text-gray-900">Pembayaran diterima</p>
                                <p class="text-sm text-gray-500">Rp 400.000 dari Budi Santoso</p>
                                <p class="text-xs text-gray-400 mt-1">6 jam yang lalu</p>
                            </div>
                        </div>
                        <!-- <button class="w-full mt-4 text-sm text-center text-blue-600 hover:underline">Lihat semua aktivitas</button> -->
                    </div>
                </div>  
            </main>
        </div>
    </div>
</body>
</html>