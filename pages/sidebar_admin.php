<?php
if (!isset($_SESSION['user_id'], $_SESSION['role'], $_SESSION['first_name'], $_SESSION['last_name'], $_SESSION['email']) 
|| $_SESSION['role'] !== 'admin') {
header("Location: sign_in.html");
exit();
}

$firstName = $_SESSION['first_name'];
$lastName = $_SESSION['last_name'];
$email = $_SESSION['email'];

// Hitung notifikasi belum dibaca
$unread_count = 0;
if (isset($_SESSION['user_id'])) {
    $admin_id = $_SESSION['user_id'];
    $query = "SELECT COUNT(*) FROM notifikasi WHERE id_user = ? AND dibaca = FALSE";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $stmt->bind_result($unread_count);
    $stmt->fetch();
    $stmt->close();
}   
?>

<div class="w-64 bg-black text-white shadow-lg hidden md:flex flex-col h-screen justify-between transition-transform duration-300 ease-in-out z-10">
    <div>
        <div class="p-5 border-b border-gray-700">
            <div class="flex items-center space-x-2">
                <a href="home_admin.php">
                    <button>
                        <img src="../../images/logo_horizontal.png" alt="logoFlexDrive" width="150px">
                    </button>
                </a>
            </div>
        </div>

        <!-- Menu -->
        <div class="py-4 px-4">
            <p class="text-xs text-gray-400 mb-2 uppercase font-semibold tracking-wider">Main</p>
            <ul>
                <li class="mb-1">
                    <a href="list_mobil_admin.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded transition-colors duration-200">
                        <i class="fas fa-car w-5 text-center mr-2"></i>
                        <span>List Mobil</span>
                    </a>
                </li>
                <li class="mb-1">
                    <a href="jadwal_sewa.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded transition-colors duration-200">
                        <i class="fas fa-calendar-alt w-5 text-center mr-2"></i>
                        <span>Jadwal Penyewaan</span>
                    </a>
                </li>
                <li class="mb-1">
                    <a href="lacak_mobil.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded transition-colors duration-200">
                        <i class="fas fa-map-marker-alt w-5 text-center mr-2"></i>
                        <span>Lacak Posisi Mobil</span>
                    </a>
                </li>
            </ul>

            <p class="text-xs text-gray-400 mt-6 mb-2 uppercase font-semibold tracking-wider">Admin</p>
            <ul>
            <li class="mb-1">
            <a href="notifikasi.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded transition-colors duration-200">
                <i class="fas fa-bell w-5 text-center mr-2"></i>
                <span>Notifikasi</span>
                <?php if ($unread_count > 0): ?>
                    <span class="ml-auto bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                        <?= $unread_count ?>
                    </span>
                <?php endif; ?>
            </a>
            </li>
                <li class="mb-1">
                    <a href="manajemen_user.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded transition-colors duration-200">
                        <i class="fas fa-users w-5 text-center mr-2"></i>
                        <span>Manajemen Pengguna</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Akun -->
    <div class="p-4 border-t border-gray-700">
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-gray-500 flex items-center justify-center">
                <i class="fas fa-user text-white"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-white"><?php echo htmlspecialchars($firstName . " " . $lastName); ?></p>
                <p class="text-xs text-gray-400"><?php echo htmlspecialchars($email); ?></p>
            </div>
            <form action="../logout.php" method="POST" class="ml-auto">
                <button class="text-gray-400 hover:text-white">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </div>    
</div>

