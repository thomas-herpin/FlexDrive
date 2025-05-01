<?php
require_once '../config.php';

$id_mobil = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($id_mobil)) {
    header("Location: list_mobil_admin.php");
    exit();
}

$query = "SELECT m.*, h.per_hari, h.per_minggu, h.per_bulan 
          FROM mobil m 
          INNER JOIN harga_mobil h ON m.id_mobil = h.id_mobil 
          WHERE m.id_mobil = '$id_mobil'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    header("Location: list_mobil_admin.php");
    exit();
}

$data = mysqli_fetch_assoc($result);

if (isset($_POST['updatemobil'])) {
    $merek_mobil = $_POST['merek_mobil'];
    $nama_mobil = $_POST['nama_mobil'];
    $tahun_produksi = $_POST['tahun_produksi'];
    $nomor_plat = $_POST['nomor_plat'];
    $tipe_mobil = $_POST['tipe_mobil'];
    $engine = $_POST['engine'];
    $bahan_bakar = $_POST['bahan_bakar'];
    $transmission = $_POST['transmission'];
    $interior_color = $_POST['interior_color'];
    $exterior_color = $_POST['exterior_color'];
    $seats = $_POST['seats'];
    $per_hari = $_POST['per_hari'];
    $per_minggu = $_POST['per_minggu'];
    $per_bulan = $_POST['per_bulan'];
    $status = $_POST['status'];

    if ($_FILES['gambar_mobil']['size'] > 0) {
        $gambar_mobil = $_FILES['gambar_mobil']['name'];
        $tmp = $_FILES['gambar_mobil']['tmp_name'];
        $location = '../../images_admin/' . $gambar_mobil;
        move_uploaded_file($tmp, $location);
        
        $updatemobil = mysqli_query($conn, "UPDATE mobil SET 
            merek_mobil = '$merek_mobil', 
            nama_mobil = '$nama_mobil', 
            tahun_produksi = '$tahun_produksi', 
            nomor_plat = '$nomor_plat', 
            tipe_mobil = '$tipe_mobil', 
            engine = '$engine', 
            bahan_bakar = '$bahan_bakar', 
            transmission = '$transmission', 
            interior_color = '$interior_color', 
            exterior_color = '$exterior_color', 
            seats = '$seats', 
            status = '$status',
            gambar_mobil = '$gambar_mobil'
            WHERE id_mobil = '$id_mobil'");
    } else {
        $updatemobil = mysqli_query($conn, "UPDATE mobil SET 
            merek_mobil = '$merek_mobil', 
            nama_mobil = '$nama_mobil', 
            tahun_produksi = '$tahun_produksi', 
            nomor_plat = '$nomor_plat', 
            tipe_mobil = '$tipe_mobil', 
            engine = '$engine', 
            bahan_bakar = '$bahan_bakar', 
            transmission = '$transmission', 
            interior_color = '$interior_color', 
            exterior_color = '$exterior_color', 
            seats = '$seats', 
            status = '$status'
            WHERE id_mobil = '$id_mobil'");
    }
    
    $updateharga = mysqli_query($conn, "UPDATE harga_mobil SET 
        per_hari = '$per_hari', 
        per_minggu = '$per_minggu', 
        per_bulan = '$per_bulan' 
        WHERE id_mobil = '$id_mobil'");
        
    if ($updatemobil && $updateharga) {
        header("Location: list_mobil_admin.php");
        exit();
    } else {
        echo "<script>alert('Gagal mengupdate data mobil: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mobil | FlexDrive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-white min-h-screen flex items-center justify-center p-6">
    <div class="container max-w-3xl mx-auto">
        <div class="bg-white shadow-2xl rounded-xl overflow-hidden">
            <div class="bg-black text-white p-6">
                <h2 class="text-3xl font-bold">Edit Data Mobil</h2>
                <p class="text-gray-300">Perbarui informasi detail mobil pada armada FlexDrive.</p>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Merek Mobil</label>
                        <input 
                            type="text" 
                            name="merek_mobil" 
                            value="<?= htmlspecialchars($data['merek_mobil']); ?>"
                            placeholder="Contoh: Toyota" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Nama Mobil</label>
                        <input 
                            type="text" 
                            name="nama_mobil" 
                            value="<?= htmlspecialchars($data['nama_mobil']); ?>"
                            placeholder="Contoh: Veloz" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Tahun Produksi</label>
                        <input 
                            type="number" 
                            name="tahun_produksi" 
                            value="<?= htmlspecialchars($data['tahun_produksi']); ?>"
                            min="1990" 
                            max="2025" 
                            placeholder="Tahun produksi" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Nomor Plat</label>
                        <input 
                            type="text" 
                            name="nomor_plat" 
                            value="<?= htmlspecialchars($data['nomor_plat']); ?>"
                            placeholder="BK 1234 XYZ"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Body Type</label>
                        <select 
                            name="tipe_mobil" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                            <option value="">Pilih Body Type</option>
                            <option value="MPV" <?= $data['tipe_mobil'] == 'MPV' ? 'selected' : ''; ?>>MPV</option>
                            <option value="SUV" <?= $data['tipe_mobil'] == 'SUV' ? 'selected' : ''; ?>>SUV</option>
                            <option value="Hatchback" <?= $data['tipe_mobil'] == 'Hatchback' ? 'selected' : ''; ?>>Hatchback</option>
                            <option value="Minibus" <?= $data['tipe_mobil'] == 'Minibus' ? 'selected' : ''; ?>>Minibus</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Engine</label>
                        <input 
                            type="text" 
                            name="engine" 
                            value="<?= htmlspecialchars($data['engine']); ?>"
                            placeholder="Contoh: 1.5L 4-cylinder" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Bahan Bakar</label>
                        <select 
                            name="bahan_bakar" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                            <option value="">Pilih Bahan Bakar</option>
                            <option value="Bensin" <?= $data['bahan_bakar'] == 'Bensin' ? 'selected' : ''; ?>>Bensin</option>
                            <option value="Diesel" <?= $data['bahan_bakar'] == 'Diesel' ? 'selected' : ''; ?>>Diesel</option>
                            <option value="Hybrid" <?= $data['bahan_bakar'] == 'Hybrid' ? 'selected' : ''; ?>>Hybrid</option>
                            <option value="Elektrik" <?= $data['bahan_bakar'] == 'Elektrik' ? 'selected' : ''; ?>>Elektrik</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Transmission</label>
                        <select 
                            name="transmission" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                            <option value="">Pilih Transmission</option>
                            <option value="Manual" <?= $data['transmission'] == 'Manual' ? 'selected' : ''; ?>>Manual</option>
                            <option value="Automatic" <?= $data['transmission'] == 'Automatic' ? 'selected' : ''; ?>>Automatic</option>
                            <option value="CVT" <?= $data['transmission'] == 'CVT' ? 'selected' : ''; ?>>CVT</option>
                            <option value="DCT" <?= $data['transmission'] == 'DCT' ? 'selected' : ''; ?>>DCT</option>
                        </select>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Interior Color</label>
                        <input 
                            type="text" 
                            name="interior_color" 
                            value="<?= htmlspecialchars($data['interior_color']); ?>"
                            placeholder="Contoh: Hitam" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Exterior Color</label>
                        <input 
                            type="text" 
                            name="exterior_color" 
                            value="<?= htmlspecialchars($data['exterior_color']); ?>"
                            placeholder="Contoh: Putih Metalik" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Jumlah Kursi</label>
                        <input 
                            type="number" 
                            name="seats" 
                            value="<?= htmlspecialchars($data['seats']); ?>"
                            min="2" 
                            max="20" 
                            placeholder="Jumlah kursi" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Status</label>
                        <select 
                            name="status" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                            <option value="Tersedia" <?= $data['status'] == 'Tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                            <option value="Sedang Disewa" <?= $data['status'] == 'Sedang Disewa' ? 'selected' : ''; ?>>Sedang Disewa</option>
                            <option value="Tidak Aktif" <?= $data['status'] == 'Tidak Aktif' ? 'selected' : ''; ?>>Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Harga Sewa per Hari</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                            <input 
                                type="number" 
                                name="per_hari" 
                                value="<?= htmlspecialchars($data['per_hari']); ?>"
                                min="0" 
                                placeholder="Masukkan harga" 
                                class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Harga Sewa per Minggu</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                            <input 
                                type="number" 
                                name="per_minggu" 
                                value="<?= htmlspecialchars($data['per_minggu']); ?>"
                                min="0" 
                                placeholder="Masukkan harga" 
                                class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" 
                                required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Harga Sewa per Bulan</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                            <input 
                                type="number" 
                                name="per_bulan" 
                                value="<?= htmlspecialchars($data['per_bulan']); ?>"
                                min="0" 
                                placeholder="Masukkan harga" 
                                class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" 
                                required>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-gray-700 mb-2 font-medium">Gambar Mobil</label>
                    <?php if (!empty($data['gambar_mobil'])): ?>
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="text-sm text-gray-500">Gambar saat ini:</span>
                        <span class="text-sm font-medium"><?= htmlspecialchars($data['gambar_mobil']); ?></span>
                    </div>
                    <?php endif; ?>
                    <input 
                        type="file" 
                        name="gambar_mobil" 
                        accept=".jpg, .jpeg, .png" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                </div>

                <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                    <a 
                        href="list_mobil_admin.php" 
                        class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition duration-300">
                        Batal
                    </a>
                    <button type="submit" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition duration-300 flex items-center gap-2" name="updatemobil">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd">
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>