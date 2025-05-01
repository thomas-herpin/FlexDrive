<?php
require '../config.php';

$roleFilter = isset($_GET['role']) ? $_GET['role'] : 'all';
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT * FROM users WHERE 1=1";

if ($roleFilter != 'all') {
    $query .= " AND role = '" . mysqli_real_escape_string($conn, $roleFilter) . "'";
}

if (!empty($searchTerm)) {
    $search = mysqli_real_escape_string($conn, $searchTerm);
    $query .= " AND (first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR email LIKE '%$search%')";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
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
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="fixed">
            <?php require "../sidebar_admin.php"; ?>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64 overflow-y-auto">
            <div class="p-6">
                <div class="container mx-auto">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold text-gray-800">Manajemen Pengguna</h1>
                        <a href="tambah_user.php">
                            <button class="bg-black hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-plus mr-2"></i>Tambah Pengguna
                            </button>
                        </a>
                    </div>

                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-4 bg-gray-50 border-b">
                            <form id="filterForm" method="GET" action="" class="flex flex-wrap gap-4 items-center">
                                <!-- Search box -->
                                <div class="flex-grow">
                                    <input type="text" name="search" value="<?= htmlspecialchars($searchTerm) ?>" placeholder="Cari pengguna..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <!-- Role dropdown -->
                                <div class="flex-shrink-0">
                                    <select name="role" onchange="document.getElementById('filterForm').submit()" class="px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="all" <?= $roleFilter == 'all' ? 'selected' : '' ?>>Semua</option>
                                        <option value="admin" <?= $roleFilter == 'admin' ? 'selected' : '' ?>>Admin</option>
                                        <option value="user" <?= $roleFilter == 'user' ? 'selected' : '' ?>>User</option>
                                    </select>
                                </div>
                            
                                <div class="flex-shrink-0">
                                    <button type="submit" class="bg-black hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                        <i class="fas fa-search mr-2"></i>Cari
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-4 text-left">Nama</th>
                                        <th class="py-3 px-4 text-left">Email</th>
                                        <th class="py-3 px-4 text-left">Peran</th>
                                        <th class="py-3 px-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700">
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)):
                                        ?>
                                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                                            <td class="py-3 px-4">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 rounded-full mr-3 bg-black flex items-center justify-center text-white font-bold uppercase">
                                                        <?= strtoupper(substr($row['first_name'], 0, 1) . substr($row['last_name'], 0, 1)) ?>
                                                    </div>
                                                    <span><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-4"><?= htmlspecialchars($row['email']) ?></td>
                                            <td class="py-3 px-4">
                                                <?php
                                                $role = strtolower($row['role']);
                                                $roleClass = $role === 'admin' ? 'bg-blue-200 text-blue-800' : 'bg-yellow-200 text-yellow-800';
                                                ?>
                                                <span class="<?= $roleClass ?> px-3 py-1 rounded-full text-xs"><?= ucfirst($role) ?></span>
                                            </td>
                                            <td class="py-3 px-4 text-center">
                                                <div class="flex justify-center space-x-2">
                                                    <a href="edit_user.php?id=<?= $row['id_user'] ?>" class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></a>
                                                    <a href="hapus_user.php?id=<?= $row['id_user'] ?>" onclick="return confirm('Yakin ingin menghapus pengguna ini?')" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endwhile;
                                    } else { ?>
                                        <tr>
                                            <td colspan="4" class="py-4 px-4 text-center text-gray-500">
                                                <i class="fas fa-search mr-2"></i>Tidak ada data pengguna yang ditemukan
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('select[name="role"]').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    </script>
</body>
</html>