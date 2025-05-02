<?php
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../sign_in.html");
    exit();
}

$userId = $_SESSION['user_id'];
$query = "SELECT first_name, last_name, email FROM users WHERE id_user = ?";
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
        $update = "UPDATE users SET first_name=?, last_name=?, email=?, password=? WHERE id_user=?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param("ssssi", $firstName, $lastName, $email, $hashedPassword, $userId);
    } else {
        $update = "UPDATE users SET first_name=?, last_name=?, email=? WHERE id_user=?";
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
            <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">Pengaturan Akun</h2>
            
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
                    <input type="password" name="new_password" id="new_password" placeholder="Password baru" 
                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Konfirmasi password baru" 
                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <button type="submit" 
                    class="w-full py-3 bg-black text-white rounded-lg hover:bg-gray-800 transition duration-300 font-semibold">
                    Simpan Perubahan
                </button>
            </form>

            <div class="flex justify-center mt-8 pt-6 border-t border-gray-200">
                <button id="logoutBtn" 
                    class="px-6 py-2 bg-white text-red-600 border border-red-600 rounded-lg hover:bg-red-50 transition duration-300 font-medium">
                    Logout
                </button>
            </div>
        </div>
    </section>

    <div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Konfirmasi Logout</h2>
        <p class="text-gray-600 mb-6">Apakah Anda yakin ingin logout?</p>
        <div class="flex justify-center gap-4">
            <button id="confirmLogout" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Ya, logout</button>
            <button id="cancelLogout" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
        </div>
    </div>

    <script>
        const form = document.querySelector("form");

        form.addEventListener("submit", function(event) {
            const newPassword = document.querySelector('input[name="new_password"]').value;
            const confirmPassword = document.querySelector('input[name="confirm_password"]').value;

            if (newPassword !== "" && newPassword !== confirmPassword) {
                event.preventDefault();
                alert("Password baru dan konfirmasi password tidak sama!");
            }
        });

        const logoutBtn = document.getElementById('logoutBtn');
        const logoutModal = document.getElementById('logoutModal');
        const confirmLogout = document.getElementById('confirmLogout');
        const cancelLogout = document.getElementById('cancelLogout');

        logoutBtn.addEventListener('click', function() {
            logoutModal.classList.remove('hidden');
            logoutModal.classList.add('flex');
        });

        cancelLogout.addEventListener('click', function() {
            logoutModal.classList.add('hidden');
            logoutModal.classList.remove('flex');
        });

        confirmLogout.addEventListener('click', function() {
            window.location.href = "../logout.php";
        });
    </script>
</body>
</html>
