<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna | FlexDrive</title>
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
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <?php require "../sidebar_admin.php";?>
        
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <div class="container mx-auto">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">Manajemen Pengguna</h1>
                    <a href="tambah_user.php"><button class="bg-black hover:bg-gray-500 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i>Tambah Pengguna
                    </button></a>
                </div>

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-4 bg-gray-50 border-b">
                        <input type="text" placeholder="Cari pengguna..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-4 text-left">Nama</th>
                                    <th class="py-3 px-4 text-left">Email</th>
                                    <th class="py-3 px-4 text-left">Peran</th>
                                    <th class="py-3 px-4 text-center">Status</th>
                                    <th class="py-3 px-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600">
                                <tr class="border-b border-gray-200 hover:bg-gray-300">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full mr-3 bg-blue-500 flex items-center justify-center text-white font-bold">
                                                TH
                                            </div>
                                            <span>Thomas Herpin</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">thomas@admin.com</td>
                                    <td class="py-3 px-4">
                                        <span class="bg-blue-200 text-blue-800 px-3 py-1 rounded-full text-xs">Admin</span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-xs">Aktif</span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr class="border-b border-gray-200 hover:bg-gray-300">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full mr-3 bg-pink-700 flex items-center justify-center text-white font-bold">
                                                AT
                                            </div>
                                            <span>Arron Kennedy Taslim</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">arron@admin.com</td>
                                    <td class="py-3 px-4">
                                        <span class="bg-blue-200 text-blue-800 px-3 py-1 rounded-full text-xs">Admin</span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-xs">Aktif</span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="border-b border-gray-200 hover:bg-gray-300">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full mr-3 bg-warning flex items-center justify-center text-white font-bold">
                                                JW
                                            </div>
                                            <span>Jansen Willow</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">jansenW@admin.com</td>
                                    <td class="py-3 px-4">
                                        <span class="bg-blue-200 text-blue-800 px-3 py-1 rounded-full text-xs">Admin</span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-xs">Aktif</span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="border-b border-gray-200 hover:bg-gray-300">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full mr-3 bg-purple-700 flex items-center justify-center text-white font-bold">
                                                TF
                                            </div>
                                            <span>Terry Centrino Fangesturi</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">terry@admin.com</td>
                                    <td class="py-3 px-4">
                                        <span class="bg-blue-200 text-blue-800 px-3 py-1 rounded-full text-xs">Admin</span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-xs">Aktif</span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="border-b border-gray-200 hover:bg-gray-300">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full mr-3 bg-orange-700 flex items-center justify-center text-white font-bold">
                                                WS
                                            </div>
                                            <span>Wilbert Stanley</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">wilbert@admin.com</td>
                                    <td class="py-3 px-4">
                                        <span class="bg-blue-200 text-blue-800 px-3 py-1 rounded-full text-xs">Admin</span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-xs">Aktif</span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="border-b border-gray-200 hover:bg-gray-300">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full mr-3 bg-green-500 flex items-center justify-center text-white font-bold">
                                                AH
                                            </div>
                                            <span>Ahmad Haikal</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">ahmad@staff.com</td>
                                    <td class="py-3 px-4">
                                        <span class="bg-yellow-200 text-yellow-800 px-3 py-1 rounded-full text-xs">Staff</span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-xs">Aktif</span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>