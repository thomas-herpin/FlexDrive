<?php
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../sign_in.html");
    exit();
}

$userId = $_SESSION['user_id'];
$query = "SELECT first_name, last_name, email FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User tidak ditemukan.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $newPassword = $_POST['new_password'];

    if (!empty($newPassword)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $update = "UPDATE users SET first_name=?, last_name=?, email=?, password=? WHERE id=?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param("ssssi", $firstName, $lastName, $email, $hashedPassword, $userId);
    } else {
        $update = "UPDATE users SET first_name=?, last_name=?, email=? WHERE id=?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param("sssi", $firstName, $lastName, $email, $userId);
    }

    if ($stmt->execute()) {
        header("Location: akun.php?status=success");
        exit();
    } else {
        echo "Gagal update data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlexDrive | Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <?php require "../navbar_user.php"; ?>

    <section class="flex items-center justify-center py-24 px-4">
        <div class="w-full max-w-2xl bg-white p-10 rounded-2xl shadow-xl">
            <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">Edit Akun</h2>

            <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-8" role="alert">
                    <span class="block sm:inline">Data berhasil diperbarui!</span>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Depan</label>
                    <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" 
                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Belakang</label>
                    <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" 
                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" 
                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru <span class="text-xs text-gray-400">(Kosongkan jika tidak ingin ganti)</span></label>
                    <input type="password" name="new_password" placeholder="Password baru" 
                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <button type="submit" 
                    class="w-full py-3 bg-black text-white rounded-lg hover:bg-gray-800 transition duration-300 font-semibold">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </section>
</body>
</html>
