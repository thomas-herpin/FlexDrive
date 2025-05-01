<?php
require '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = "ID pengguna tidak valid!";
    header("Location: manajemen_user.php");
    exit;
}

$userId = $_GET['id'];

if ($userId == $_SESSION['user_id']) {
    $_SESSION['error'] = "Anda tidak dapat menghapus akun diri sendiri!";
    header("Location: manajemen_user.php");
    exit;
}

$query = "SELECT first_name, last_name, email FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    $_SESSION['error'] = "Pengguna tidak ditemukan!";
    header("Location: manajemen_user.php");
    exit;
}

$user = mysqli_fetch_assoc($result);

if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == 'yes') {
    $deleteUser = "DELETE FROM users WHERE id = ?";
    $stmtUser = mysqli_prepare($conn, $deleteUser);
    mysqli_stmt_bind_param($stmtUser, "i", $userId);
    
    if (mysqli_stmt_execute($stmtUser)) {
        $_SESSION['success'] = "Pengguna berhasil dihapus!";
    } else {
        $_SESSION['error'] = "Gagal menghapus pengguna: " . mysqli_error($conn);
    }
    
    header("Location: manajemen_user.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Pengguna | FlexDrive</title>
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
                <div class="container mx-auto max-w-2xl">
                    <div class="flex items-center mb-6">
                        <a href="manajemen_user.php" class="mr-4 text-gray-600 hover:text-gray-900">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1 class="text-3xl font-bold text-gray-800">Hapus Pengguna</h1>
                    </div>

                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-6">
                            <div class="mb-6">
                                <i class="fas fa-exclamation-triangle text-6xl text-red-500 flex justify-center mb-4"></i>
                                <h2 class="text-2xl font-bold text-center mb-2">Konfirmasi Penghapusan</h2>
                                <p class="text-gray-600 text-center">
                                    Anda akan menghapus pengguna berikut secara permanen:
                                </p>
                                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center justify-center mb-2">
                                        <div class="w-16 h-16 rounded-full bg-black flex items-center justify-center text-white text-2xl font-bold uppercase">
                                            <?= strtoupper(substr($user['first_name'], 0, 1) . substr($user['last_name'], 0, 1)) ?>
                                        </div>
                                    </div>
                                    <p class="text-lg font-bold text-center"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></p>
                                    <p class="text-gray-500 text-center"><?= htmlspecialchars($user['email']) ?></p>
                                </div>
                            </div>

                            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                                <p class="font-bold">Peringatan</p>
                                <p>Tindakan ini tidak dapat dibatalkan. Semua data pengguna akan dihapus permanen.</p>
                            </div>

                            <form method="POST" action="">
                                <input type="hidden" name="confirm_delete" value="yes">
                                
                                <div class="flex items-center justify-between">
                                    <a href="manajemen_user.php" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Batal</a>
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                        <i class="fas fa-trash mr-2"></i>Hapus Permanen
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>