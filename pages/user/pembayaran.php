<?php
require_once '../config.php';

// Cek session login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../sign_in.html");
    exit();
}

// Ambil ID pesanan dari URL atau session
if (isset($_GET['id_pesan'])) {
    $id_pesan = $_GET['id_pesan'];
} else {
    // Ambil pesanan terbaru dari user ini
    $id_user = $_SESSION['user_id'];
    
    // Debug: Print the query and check for errors
    $query_string = "SELECT id_pesan FROM pemesanan WHERE id_user = '$id_user' ORDER BY id_pesan DESC LIMIT 1";
    $query = mysqli_query($conn, $query_string);
    
    // Check if query failed
    if (!$query) {
        echo "Error in query: " . mysqli_error($conn);
        echo "<br>Query: " . $query_string;
        exit();
    }
    
    // Check if any rows were returned
    if (mysqli_num_rows($query) == 0) {
        echo "No orders found for this user. Please make an order first.";
        echo "<br><a href='index.php'>Return to Home</a>";
        exit();
    }
    
    $data = mysqli_fetch_assoc($query);
    $id_pesan = $data['id_pesan'];
}

// Ambil data pesanan dengan JOIN ke tabel harga_mobil
$query_pesanan = "SELECT p.*, m.nama_mobil, m.merek_mobil, h.per_hari, h.per_minggu, h.per_bulan 
                 FROM pemesanan p 
                 JOIN mobil m ON p.id_mobil = m.id_mobil 
                 JOIN harga_mobil h ON m.id_mobil = h.id_mobil
                 WHERE p.id_pesan = $id_pesan";
$result_pesanan = mysqli_query($conn, $query_pesanan);

// Check if query failed
if (!$result_pesanan) {
    echo "Error in query: " . mysqli_error($conn);
    echo "<br>Query: " . $query_pesanan;
    exit();
}

// Check if any rows were returned
if (mysqli_num_rows($result_pesanan) == 0) {
    echo "Order #$id_pesan not found.";
    echo "<br><a href='index.php'>Return to Home</a>";
    exit();
}

$pesanan = mysqli_fetch_assoc($result_pesanan);

// Hitung total hari sewa
$tgl_ambil = new DateTime($pesanan['tanggal_pengambilan']);
$tgl_kembali = new DateTime($pesanan['tanggal_pengembalian']);
$selisih = $tgl_ambil->diff($tgl_kembali);
$total_hari = $selisih->days + 1; // Termasuk hari pengambilan

// Hitung total biaya berdasarkan durasi sewa
$total_biaya = 0;
$jenis_harga = '';

if ($total_hari <= 7) {
    // Harga harian
    $total_biaya = $pesanan['per_hari'] * $total_hari;
    $jenis_harga = 'per hari';
} elseif ($total_hari <= 30) {
    // Hitung berapa minggu penuh dan sisa hari
    $minggu_penuh = floor($total_hari / 7);
    $sisa_hari = $total_hari % 7;
    
    // Harga mingguan untuk minggu penuh + harga harian untuk sisa hari
    $total_biaya = ($pesanan['per_minggu'] * $minggu_penuh) + ($pesanan['per_hari'] * $sisa_hari);
    $jenis_harga = 'per minggu + ' . $sisa_hari . ' hari';
} else {
    // Hitung berapa bulan penuh, sisa minggu, dan sisa hari
    $bulan_penuh = floor($total_hari / 30);
    $sisa_hari_setelah_bulan = $total_hari % 30;
    $sisa_minggu = floor($sisa_hari_setelah_bulan / 7);
    $sisa_hari_final = $sisa_hari_setelah_bulan % 7;
    
    // Harga bulanan untuk bulan penuh + harga mingguan untuk sisa minggu + harga harian untuk sisa hari
    $total_biaya = ($pesanan['per_bulan'] * $bulan_penuh) + 
                  ($pesanan['per_minggu'] * $sisa_minggu) + 
                  ($pesanan['per_hari'] * $sisa_hari_final);
    $jenis_harga = 'per bulan + ' . $sisa_minggu . ' minggu + ' . $sisa_hari_final . ' hari';
}

// Hitung jumlah yang harus dibayar berdasarkan pelunasan
$jumlah_bayar = ($pesanan['pelunasan'] == '50') ? $total_biaya * 0.5 : $total_biaya;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran | FlexDrive</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <div style="height: 70px;">
        <?php require "../navbar_user.php"; ?>
    </div>
    

    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg ">
        <h2 class="text-center text-2xl font-bold mb-6">Detail Pembayaran</h2>
        
        <div class="border-b pb-4 mb-4">
            <p class="text-lg font-semibold"><?= $pesanan['merek_mobil'] . ' ' . $pesanan['nama_mobil']; ?></p>
            <div class="flex justify-between mt-2">
                <span class="text-gray-600">Tanggal Sewa:</span>
                <span><?= date('d M Y', strtotime($pesanan['tanggal_pengambilan'])); ?> - <?= date('d M Y', strtotime($pesanan['tanggal_pengembalian'])); ?></span>
            </div>
            <div class="flex justify-between mt-1">
                <span class="text-gray-600">Durasi:</span>
                <span><?= $total_hari; ?> hari</span>
            </div>
            <div class="flex justify-between mt-1">
                <span class="text-gray-600">Tarif:</span>
                <span>
                    <?php if ($total_hari <= 7): ?>
                        Rp <?= number_format($pesanan['per_hari'], 0, ',', '.'); ?> per hari
                    <?php elseif ($total_hari <= 30): ?>
                        Rp <?= number_format($pesanan['per_minggu'], 0, ',', '.'); ?> per minggu
                    <?php else: ?>
                        Rp <?= number_format($pesanan['per_bulan'], 0, ',', '.'); ?> per bulan
                    <?php endif; ?>
                </span>
            </div>
            <div class="flex justify-between mt-1 text-xs text-gray-500">
                <span>Perhitungan:</span>
                <span><?= $jenis_harga; ?></span>
            </div>
        </div>
        
        <div class="border-b pb-4 mb-4">
            <div class="flex justify-between font-semibold">
                <span>Total Biaya:</span>
                <span>Rp <?= number_format($total_biaya, 0, ',', '.'); ?></span>
            </div>
            
            <?php if ($pesanan['pelunasan'] == '50'): ?>
            <div class="flex justify-between mt-2 text-green-600 font-semibold">
                <span>DP (50%):</span>
                <span>Rp <?= number_format($jumlah_bayar, 0, ',', '.'); ?></span>
            </div>
            <p class="text-sm text-gray-500 mt-1">Sisa pembayaran dapat dilunasi saat pengambilan mobil</p>
            <?php endif; ?>
        </div>
        
        <!-- Metode Pembayaran Sederhana -->
        <div class="mb-6">
            <h3 class="font-semibold mb-3">Pilih Metode Pembayaran</h3>
            
            <div class="space-y-3">
                <div class="border rounded p-3 flex items-center cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="payment_method" id="transfer" value="transfer" checked class="mr-3">
                    <label for="transfer" class="flex-grow cursor-pointer">
                        <span class="font-medium">Transfer Bank</span>
                        <p class="text-sm text-gray-500">BCA, Mandiri, BNI, BRI</p>
                    </label>
                    <img src="/images/payment/bank.png" alt="Bank Transfer" class="h-8">
                </div>
                
                <div class="border rounded p-3 flex items-center cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="payment_method" id="ewallet" value="ewallet" class="mr-3">
                    <label for="ewallet" class="flex-grow cursor-pointer">
                        <span class="font-medium">E-Wallet</span>
                        <p class="text-sm text-gray-500">GoPay, OVO, DANA, LinkAja</p>
                    </label>
                    <img src="/images/payment/ewallet.png" alt="E-Wallet" class="h-8">
                </div>
            </div>
        </div>
        
        <!-- Informasi Rekening (untuk Transfer Bank) -->
        <div id="bank-info" class="mb-6 p-4 bg-gray-50 rounded">
            <h4 class="font-semibold mb-2">Informasi Rekening</h4>
            <p class="mb-1">Bank BCA</p>
            <p class="font-medium mb-1">1234567890</p>
            <p class="mb-3">a.n. PT FlexDrive Indonesia</p>
            
            <p class="text-sm text-gray-600">
                Silakan transfer sejumlah <span class="font-semibold">Rp <?= number_format($jumlah_bayar, 0, ',', '.'); ?></span> 
                ke rekening di atas.
            </p>
            <p class="text-sm text-gray-600 mt-1">
                Setelah transfer, silakan upload bukti pembayaran di bawah ini.
            </p>
        </div>
        
        <!-- Form Upload Bukti Transfer -->
        <form action="proses_pembayaran.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_pesan" value="<?= $id_pesan; ?>">
            <input type="hidden" name="jumlah_bayar" value="<?= $jumlah_bayar; ?>">
            
            <div class="mb-4">
                <label for="bukti" class="block font-semibold mb-1">Upload Bukti Pembayaran</label>
                <input type="file" id="bukti" name="bukti_pembayaran" class="w-full p-2 border rounded" accept="image/*" required>
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, atau PDF. Maks 2MB</p>
            </div>
            
            <button type="submit" name="submit_payment" class="w-full bg-black text-white p-3 rounded text-lg hover:bg-gray-800 transition">
                Konfirmasi Pembayaran
            </button>
        </form>
    </div>
    
    <script>
        // Toggle payment method info
        const transferRadio = document.getElementById('transfer');
        const ewalletRadio = document.getElementById('ewallet');
        const bankInfo = document.getElementById('bank-info');
        
        transferRadio.addEventListener('change', function() {
            if (this.checked) {
                bankInfo.style.display = 'block';
            }
        });
        
        ewalletRadio.addEventListener('change', function() {
            if (this.checked) {
                bankInfo.style.display = 'none';
                // In a real implementation, you would show QR codes or e-wallet instructions here
                alert('Fitur pembayaran e-wallet akan segera tersedia!');
                transferRadio.checked = true;
                bankInfo.style.display = 'block';
            }
        });
    </script>
</body>
</html>
