<?php   
require_once '../config.php';

// Cek session login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../sign_in.html");
    exit(); // Hentikan eksekusi script jika belum login
}

// Ambil id_mobil dari POST
if (isset($_POST['id_mobil'])) {
    $id_mobil = $_POST['id_mobil']; // Ambil id_mobil dari POST
} else {
    echo "ID Mobil tidak ditemukan.";
    exit();
}

$id_user = $_SESSION['user_id'];

// Ambil data mobil dan harga berdasarkan id_mobil
$query = mysqli_query($conn, "SELECT * FROM mobil WHERE id_mobil = $id_mobil");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Mobil tidak ditemukan.";
    exit();
}

if (isset($_POST['pesan'])) {
    $no_telp = $_POST['no_telp'];
    $lok_ambil = $_POST['lokasi_pengambilan'];
    $lok_kembali = $_POST['lokasi_pengembalian'];
    $tgl_ambil = $_POST['tanggal_pengambilan'];
    $tgl_kembali = $_POST['tanggal_pengembalian'];
    $pelunasan = $_POST['pelunasan'];

    $addpesanan = mysqli_query($conn, "INSERT INTO pemesanan 
    (id_mobil, id_user, no_telp, lokasi_pengambilan, lokasi_pengembalian, tanggal_pengambilan, tanggal_pengembalian, pelunasan) 
    VALUES 
    ('$id_mobil', '$id_user', '$no_telp', '$lok_ambil', '$lok_kembali', '$tgl_ambil', '$tgl_kembali', '$pelunasan')");

    if($addpesanan){
        header('Location: pembayaran.php');
        exit(); 
    } else {
        echo mysqli_error($conn); // Menampilkan pesan error dari query
        echo "<script>alert('Gagal menambahkan pesanan'); window.location='pemesanan.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan & Pembayaran | FlexDrive</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <?php require "../navbar_user.php"; ?>

    <!-- Form Pemesanan -->

    <form action="pemesanan.php" method="POST">
        <input type="hidden" name="id_mobil" value="<?= $id_mobil; ?>">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-center text-2xl font-bold mt-20 mb-6">Form Pemesanan Mobil</h2>
            
            <div class="mb-4">
                <img src="../../images_admin/<?=$data['gambar_mobil'];?>" alt="">
                <p class="text-sm text-gray-500 mb-1">Mobil : <strong><?= $data['merek_mobil'] . " " . $data['nama_mobil']; ?></strong></p>
            </div>

            <div class="mb-4">
                <label for="no_telp" class="block font-semibold mb-1">Nomor Telepon</label>
                <input type="text" id="lokasi-pengambilan" name="no_telp" class="w-full p-2 border rounded mt-1" placeholder="Masukkan nomor telepon">
            </div>

            <div class="mb-4">
                <label for="lokasi-pengambilan" class="block font-semibold mb-1">Lokasi Pengambilan</label>
                <input type="text" id="lokasi-pengambilan" name="lokasi_pengambilan" class="w-full p-2 border rounded mt-1" placeholder="Masukkan lokasi pengambilan">
            </div>

            <div class="mb-4">
                <label for="lokasi-pengembalian" class="block font-semibold mb-1">Lokasi Pengembalian</label>
                <input type="text" id="lokasi-pengembalian" name="lokasi_pengembalian"class="w-full p-2 border rounded mt-1" placeholder="Masukkan lokasi pengembalian">
            </div>
            
            <div class="w-full h-64 bg-gray-200 rounded mt-2 overflow-hidden">
                <iframe id="mapFrame" 
                        class="w-full h-full" 
                        frameborder="0" 
                        style="border:0" 
                        allowfullscreen
                        src="https://maps.google.com/maps?q=medankota&output=embed">
                </iframe>
            </div>

            <div class="mb-4">
                <label for="tanggal-pengambilan" class="block font-semibold mb-1">Tanggal Pengambilan</label>
                <input type="date" id="lokasi-pengembalian" name="tanggal_pengambilan" class="w-full p-2 border rounded mt-1" placeholder="Masukkan tanggal pengambilan">
            </div>

            <div class="mb-4">
                <label for="tanggal-pengembalian" class="block font-semibold mb-1">Tanggal Pengembalian</label>
                <input type="date" id="tanggal-pengembalian" name="tanggal_pengembalian" class="w-full p-2 border rounded mt-1" placeholder="Masukkan tanggal pengembalian">
            </div>
            
            
            <div class="mb-4">
                <label for="payment" class="block font-semibold mb-1">Pilih Metode Pelunasan</label>
                <select id="payment" name="pelunasan" class="w-full p-2 border rounded">
                    <option value="50">DP 50%</option>
                    <option value="100">Pelunasan Langsung</option>
                </select>
            </div>
                
            <button type="submit" class="w-full bg-black text-white p-3 rounded text-lg hover:bg-gray-800 transition" name="pesan">Lanjutkan Pembayaran</button>
        </div>
    </form>
    
    <script>
        const navLinks = document.getElementById("nav-links");
        const menuIcon = document.getElementById("menu-icon");

        menuIcon.addEventListener("click", () => {
            if (navLinks.classList.contains("top-12")) {
                navLinks.classList.remove("top-12");
                navLinks.classList.add("top-[-500px]");
                menuIcon.name = "menu";
            } else {
                navLinks.classList.remove("top-[-500px]");
                navLinks.classList.add("top-12");
                menuIcon.name = "close";
            }
        });
    </script>
</body>
</html>