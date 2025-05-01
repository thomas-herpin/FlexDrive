<?php
require '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../sign_in.html");
    exit;
}

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = "ID pengguna tidak valid!";
    header("Location: manajemen_user.php");
    exit;
}

$userId = $_GET['id'];
$query = "SELECT * FROM users WHERE id_user = ?";
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];
    $errors = [];

    if (empty($firstName)) $errors[] = "Nama depan tidak boleh kosong";
    if (empty($lastName)) $errors[] = "Nama belakang tidak boleh kosong";
    if (empty($email)) {
        $errors[] = "Email tidak boleh kosong";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }

    $emailCheck = "SELECT id_user FROM users WHERE email = ? AND id_user != ?";
    $stmtEmail = mysqli_prepare($conn, $emailCheck);
    mysqli_stmt_bind_param($stmtEmail, "si", $email, $userId);
    mysqli_stmt_execute($stmtEmail);
    $emailResult = mysqli_stmt_get_result($stmtEmail);
    
    if (mysqli_num_rows($emailResult) > 0) {
        $errors[] = "Email sudah digunakan oleh pengguna lain";
    }

    $passwordUpdate = "";
    $passwordParams = [];
    
    if (!empty($_POST['password'])) {
        if (strlen($_POST['password']) < 8) {
            $errors[] = "Password minimal 8 karakter";
        } elseif ($_POST['password'] !== $_POST['confirm_password']) {
            $errors[] = "Konfirmasi password tidak cocok";
        } else {
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $passwordUpdate = ", password = ?";
            $passwordParams[] = $hashedPassword;
        }
    }

    if (empty($errors)) {
        $updateQuery = "UPDATE users SET first_name = ?, last_name = ?, email = ?, role = ?" . $passwordUpdate . " WHERE id_user = ?";
        
        $stmt = mysqli_prepare($conn, $updateQuery);
        $params = [$firstName, $lastName, $email, $role];
        $types = "ssss";
        
        if (!empty($passwordParams)) {
            $params = array_merge($params, $passwordParams);
            $types .= "s";
        }

        $params[] = $userId;
        $types .= "i";
        
        mysqli_stmt_bind_param($stmt, $types, ...$params);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success'] = "Data pengguna berhasil diperbarui!";
            header("Location: manajemen_user.php");
            exit;
        } else {
            $errors[] = "Gagal memperbarui data: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengguna | FlexDrive</title>
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
                        <h1 class="text-3xl font-bold text-gray-800">Edit Pengguna</h1>
                    </div>

                    <?php if (!empty($errors)): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                        <p class="font-bold">Error</p>
                        <ul class="list-disc ml-5">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-6">
                            <form method="POST" action="">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <label for="first_name" class="block text-gray-700 font-semibold mb-2">Nama Depan</label>
                                        <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" 
                                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    </div>
                                    <div>
                                        <label for="last_name" class="block text-gray-700 font-semibold mb-2">Nama Belakang</label>
                                        <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" 
                                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" 
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>

                                <div class="mb-6">
                                    <label for="role" class="block text-gray-700 font-semibold mb-2">Peran</label>
                                    <select id="role" name="role" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    </select>
                                </div>

                                <div class="mb-6">
                                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password Baru (Kosongkan jika tidak diubah)</label>
                                    <input type="password" id="password" name="password" 
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <p class="text-sm text-gray-500 mt-1">Minimal 8 karakter</p>
                                </div>

                                <div class="mb-6">
                                    <label for="confirm_password" class="block text-gray-700 font-semibold mb-2">Konfirmasi Password Baru</label>
                                    <input type="password" id="confirm_password" name="confirm_password" 
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <div class="flex items-center justify-between">
                                    <a href="manajemen_user.php" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Batal</a>
                                    <button type="submit" class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-700">Simpan Perubahan</button>
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