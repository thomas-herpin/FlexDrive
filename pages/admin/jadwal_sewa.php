<?php
require_once '../config.php';
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
                                            $tgl_ambil = $data['tanggal_pengambilan'];
                                            $tgl_kembali = $data['tanggal_pengembalian'];     
                                ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 flex-shrink-0 rounded-full bg-blue-100 flex items-center justify-center">
                                                        <span class="text-blue-800 font-medium">BS</span>
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
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    <?=$status;?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button type="submit" class="text-green-600 hover:text-green-900 mr-3"><i class="fas fa-check" name="ubahstatus"></i></button>
                                                <button class="text-red-600 hover:text-red-900"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    }    
                                    ?> 
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