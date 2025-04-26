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
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Cari jadwal..." class="py-2 pl-10 pr-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <i class="fas fa-search text-gray-400 absolute left-3 top-3"></i>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Summary  -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <!-- Filter & Actions -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                    <div class="flex items-center space-x-2">
                        <div class="relative">
                            <select class="appearance-none bg-white border border-gray-300 rounded-lg py-2 pl-3 pr-10 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option>Semua Status</option>
                                <option>Dikonfirmasi</option>
                                <option>Menunggu</option>
                                <option>Dibatalkan</option>
                            </select>
                            <i class="fas fa-chevron-down text-gray-400 absolute right-3 top-3 pointer-events-none"></i>
                        </div>
                        <div class="relative">
                            <input type="date" class="bg-white border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
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
                                <p class="text-2xl font-bold">12</p>
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
                                <p class="text-2xl font-bold">8</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-primary">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-primary/10 mr-4">
                                <i class="fas fa-calendar-alt text-primary text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Jadwal</p>
                                <p class="text-2xl font-bold">20</p>
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
                                    <th class="p-4 font-medium">Nama</th>
                                    <th class="p-4 font-medium">Mobil</th>
                                    <th class="p-4 font-medium">Tanggal</th>
                                    <th class="p-4 font-medium">Status</th>
                                    <th class="p-4 font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="p-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white mr-3">
                                                BS
                                            </div>
                                            <span>Budi Santoso</span>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div>
                                            <p>Daihatsu Xenia</p>
                                            <p class="text-xs text-gray-500">BK 14 XY</p>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div>
                                            <p>6 Maret 2025</p>
                                            <p class="text-xs text-gray-500">08:00 - 20:00</p>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Dikonfirmasi</span>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex space-x-2">
                                            <button class="p-1 text-primary hover:text-blue-700">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-1 text-success hover:text-green-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="p-1 text-danger hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="p-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-pink-500 flex items-center justify-center text-white mr-3">
                                                SR
                                            </div>
                                            <span>Siti Rahma</span>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div>
                                            <p>Suzuki Ertiga</p>
                                            <p class="text-xs text-gray-500">BK 5678 AB</p>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div>
                                            <p>7 Maret 2025</p>
                                            <p class="text-xs text-gray-500">09:00 - 17:00</p>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">Menunggu</span>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex space-x-2">
                                            <button class="p-1 text-primary hover:text-blue-700">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-1 text-success hover:text-green-700">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="p-1 text-danger hover:text-red-700">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="p-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-purple-500 flex items-center justify-center text-white mr-3">
                                                AF
                                            </div>
                                            <span>Ahmad Fajar</span>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div>
                                            <p>Toyota Avanza</p>
                                            <p class="text-xs text-gray-500">BK 1234 CD</p>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div>
                                            <p>8 Maret 2025</p>
                                            <p class="text-xs text-gray-500">10:00 - 18:00</p>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">Menunggu</span>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex space-x-2">
                                            <button class="p-1 text-primary hover:text-blue-700">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-1 text-success hover:text-green-700">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="p-1 text-danger hover:text-red-700">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 border-t flex items-center justify-between">
                        <p class="text-sm text-gray-500">Menampilkan 3 dari 20 jadwal</p>
                        <div class="flex space-x-1">
                            <button class="w-8 h-8 flex items-center justify-center border rounded text-gray-500 hover:border-primary hover:text-primary disabled:opacity-50">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="w-8 h-8 flex items-center justify-center border rounded bg-primary text-white">1</button>
                            <button class="w-8 h-8 flex items-center justify-center border rounded text-gray-500 hover:border-primary hover:text-primary">2</button>
                            <button class="w-8 h-8 flex items-center justify-center border rounded text-gray-500 hover:border-primary hover:text-primary">3</button>
                            <button class="w-8 h-8 flex items-center justify-center border rounded text-gray-500 hover:border-primary hover:text-primary">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>
</html