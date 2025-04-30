<?php
require_once '../config.php';

$message = '';
$status = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $role = isset($_POST['role']) ? $_POST['role'] : 'user';
    
    // Validasi data
    $errors = [];
    
    if (empty($first_name)) {
        $errors[] = "Nama depan tidak boleh kosong";
    }
    
    if (empty($email)) {
        $errors[] = "Email tidak boleh kosong";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }
    
    if (empty($password)) {
        $errors[] = "Password tidak boleh kosong";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password minimal 6 karakter";
    }
    
    // Cek apakah email sudah terdaftar
    $check_query = "SELECT COUNT(*) FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    
    if ($count > 0) {
        $errors[] = "Email sudah terdaftar. Gunakan email lain.";
    }
    
    // Jika tidak ada error, simpan data ke database
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Simpan data
        $query = "INSERT INTO users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $first_name, $last_name, $email, $hashed_password, $role);
        
        if ($stmt->execute()) {
            $user_id = $conn->insert_id;
            $status = 'success';
            $message = "Pengguna berhasil ditambahkan dengan ID: " . $user_id;
        } else {
            $status = 'error';
            $message = "Gagal menambahkan pengguna: " . $conn->error;
        }
        
        $stmt->close();
    } else {
        $status = 'error';
        $message = implode(", ", $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna | FlexDrive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 antialiased font-sans">
    <div class="flex min-h-screen">
        <div class="flex-1 p-6">
            <div class="container mx-auto max-w-2xl">
                <div class="flex items-center mb-8">
                    <a href="manajemen_user.php" class="mr-4 text-gray-600 hover:text-gray-900 transition-all duration-300 hover:scale-105">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <h1 class="text-3xl font-bold text-gray-800">Tambah Pengguna Baru</h1>
                </div>

                <?php if($status == 'success'): ?>
                <!-- Pesan Sukses -->
                <div id="successAlert" class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium"><?php echo $message; ?></p>
                            <div class="mt-3 flex space-x-3">
                                <a href="manajemen_user.php" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md transition duration-300">
                                    <i class="fas fa-users mr-2"></i> Lihat Semua Pengguna
                                </a>
                                <button type="button" onclick="resetForm()" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md transition duration-300">
                                    <i class="fas fa-plus mr-2"></i> Tambah Pengguna Lain
                                </button>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <button onclick="closeAlert('successAlert')" class="text-green-500 hover:text-green-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php elseif($status == 'error'): ?>
                <!-- Pesan Error -->
                <div id="errorAlert" class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500 mt-1"></i>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium">Mohon perbaiki kesalahan berikut:</p>
                            <p class="mt-1"><?php echo $message; ?></p>
                        </div>
                        <div class="ml-auto">
                            <button onclick="closeAlert('errorAlert')" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="userForm" class="bg-white rounded-lg shadow-lg p-8 transition-all duration-300">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="first_name">
                                Nama Depan
                            </label>
                            <input type="text" id="first_name" name="first_name" placeholder="Nama depan" 
                                value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : ''; ?>"
                                class="w-full px-4 py-3 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="last_name">
                                Nama Belakang
                            </label>
                            <input type="text" id="last_name" name="last_name" placeholder="Nama belakang" 
                                value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>"
                                class="w-full px-4 py-3 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2" for="email">
                            Alamat Email
                        </label>
                        <input type="email" id="email" name="email" placeholder="Masukkan alamat email" 
                            value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                            class="w-full px-4 py-3 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2" for="password">
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" 
                                class="w-full px-4 py-3 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Password minimal 8 karakter</p>
                    </div>

                    <div class="mb-8">
                        <label class="block text-gray-700 font-medium mb-3">
                            <i class="fas fa-user-tag text-gray-400 mr-2"></i>Peran Pengguna
                        </label>
                        <div class="flex rounded-md shadow-sm border border-gray-200 overflow-hidden">
                            <label class="w-1/2 relative">
                                <input type="radio" name="role" value="user" <?php echo (!isset($_POST['role']) || $_POST['role'] == 'user') ? 'checked' : ''; ?> 
                                    class="peer absolute h-0 w-0 opacity-0">
                                <span class="flex items-center justify-center py-3 px-4 bg-white peer-checked:bg-black peer-checked:text-white transition-all duration-300">
                                    <i class="fas fa-user mr-2"></i>Pengguna
                                </span>
                            </label>
                            <label class="w-1/2 relative">
                                <input type="radio" name="role" value="admin" <?php echo (isset($_POST['role']) && $_POST['role'] == 'admin') ? 'checked' : ''; ?> 
                                    class="peer absolute h-0 w-0 opacity-0">
                                <span class="flex items-center justify-center py-3 px-4 bg-white peer-checked:bg-black peer-checked:text-white transition-all duration-300">
                                    <i class="fas fa-user-shield mr-2"></i>Admin
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex justify-end space-x-4">
                        <a href="manajemen_user.php">
                            <button type="button" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-all duration-300 flex items-center">
                                Batal
                            </button>
                        </a>
                        <button type="submit" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition-all duration-300 flex items-center">
                            <i class="fas fa-save mr-2"></i>Simpan Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function closeAlert(id) {
            document.getElementById(id).style.display = 'none';
        }
        
        function resetForm() {
            document.getElementById('userForm').reset();
            document.getElementById('successAlert').style.display = 'none';
            document.getElementById('first_name').focus();
        }
    </script>
</body>
</html>