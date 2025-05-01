<?php
require_once '../config.php';

// Cek apakah ada parameter id_mobil
if (!isset($_GET['id_mobil'])) {
    header("Location: pengaturan_harga.php");
    exit();
}

$id_mobil = $_GET['id_mobil'];
$kode_mobil = 'MBL - ' . sprintf('%03d', $id_mobil);  

// Ambil data mobil dan harga berdasarkan id_mobil
$query = mysqli_query($conn, "SELECT m.*, h.per_hari, h.per_minggu, h.per_bulan 
                              FROM mobil m 
                              INNER JOIN harga_mobil h ON m.id_mobil = h.id_mobil 
                              WHERE m.id_mobil = $id_mobil");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Mobil tidak ditemukan.";
    exit();
}

// Proses update saat form disubmit
if (isset($_POST['edithargamobil'])) {
    $per_hari = $_POST['per_hari'];
    $per_minggu = $_POST['per_minggu'];
    $per_bulan = $_POST['per_bulan'];

    $update = mysqli_query($conn, "UPDATE harga_mobil 
                                   SET per_hari = '$per_hari', per_minggu = '$per_minggu', per_bulan = '$per_bulan' 
                                   WHERE id_mobil = $id_mobil");


    if ($update) {
        header("location: pengaturan_harga.php");
    } else {
        echo "Gagal mengupdate harga.";
        header("location: pengaturan_harga.php");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Harga | FlexDrive</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-xl mx-auto mt-10 bg-white rounded-lg shadow-md">
        <div class="bg-black text-white p-6 rounded-t-lg">
            <h2 class="text-3xl font-bold">Edit Harga Mobil</h2>
        </div>
        <div class="p-6">
        <img src="../../images_admin/<?=$data['gambar_mobil'];?>" alt="">
        <p class="text-sm text-gray-500 mb-1">Mobil : <strong><?= $data['merek_mobil'] . " " . $data['nama_mobil']; ?></strong></p>
        <p class="text-sm text-gray-500 mb-1">No-Plat : <strong><?= $data['nomor_plat'];?></strong></p>
        <p class="text-sm text-gray-500 mb-6">Id : <strong><?=$kode_mobil?></strong></p>

        <form method="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga per Hari</label>
                <input type="number" name="per_hari" value="<?= $data['per_hari']; ?>" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-primary">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga per Minggu</label>
                <input type="number" name="per_minggu" value="<?= $data['per_minggu']; ?>" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-primary">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga per Bulan</label>
                <input type="number" name="per_bulan" value="<?= $data['per_bulan']; ?>" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-primary">
            </div>
            <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                <a 
                    href="pengaturan_harga.php" 
                    class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition duration-300">                        Batal
                </a>
                <button type="submit" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition duration-300 flex items-center gap-2" name="edithargamobil">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd">
                    </svg>
                    Simpan
                </button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>
