<?php
require_once '../config.php';

// Cek session login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../sign_in.html");
    exit(); // Hentikan eksekusi script jika belum login
}
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>FlexDrive</title>
    <style>
        ion-icon {
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php require "../navbar_user.php"; ?>

    <!-- hero section -->
    <section class="relative text-black bg-white py-16 md:py-24 px-6 -z-50">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 items-center relative z-10">
            <!-- Teks di Kiri -->
            <div class="text-left md:pl-10 relative z-20">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold tracking-widest leading-tight">
                    PERJALANAN NYAMAN,<br> HARGA BERSAHABAT
                </h1>
            </div>
    
            <!-- Gambar Mobil -->
            <div class="relative">
                <img src="../../images/toyota-veloz 2021.png" alt="Toyota Veloz"
                    class="w-full max-w-[500px] mx-auto drop-shadow-lg relative z-20 scale-125">
            </div>
        </div>
    
        <!-- Gambar Background Map di Sebelah Kanan -->
        <div class="absolute inset-y-0 right-0 w-1/2 hidden md:block">
            <img src="../../images/gambar_map.png" alt="Map Background" 
                 class="w-full h-full object-cover opacity-30">
        </div>
    </section>

    <!-- Testimoni -->
    <section class="bg-gradient-to-r from-gray-700 to-black py-16 px-6 text-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-center mb-10">Apa Kata Pengguna Kami?</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Testimoni Card 1 -->
                <div class="bg-white text-gray-800 p-6 rounded-2xl shadow-2xl flex flex-col justify-between h-full">
                    <p class="italic mb-6">"Udah beberapa kali sewa di sini, gak pernah kecewa. Harganya masuk akal, mobil selalu dalam kondisi bagus."</p>
                    <div class="flex items-center mt-auto">
                        <div class="w-10 h-10 bg-black text-white rounded-full flex items-center justify-center font-bold mr-4">
                            AH
                        </div>
                        <div>
                            <p class="font-semibold">Ahmad Fadli</p>
                            <p class="text-sm text-gray-500">Pengguna dari Medan Maimun</p>
                        </div>
                    </div>
                </div>

                <!-- Testimoni Card 2 -->
                <div class="bg-white text-gray-800 p-6 rounded-2xl shadow-2xl flex flex-col justify-between h-full">
                    <p class="italic mb-6">"Udah nyoba beberapa tempat, tapi yang ini paling cocok. Nggak ribet dan aman dipakai ke mana-mana."</p>
                    <div class="flex items-center mt-auto">
                        <div class="w-10 h-10 bg-black text-white rounded-full flex items-center justify-center font-bold mr-4">
                            SR
                        </div>
                        <div>
                            <p class="font-semibold">Siti Rahma</p>
                            <p class="text-sm text-gray-500">Pengguna dari Medan Polonia</p>
                        </div>
                    </div>
                </div>

                <!-- Testimoni Card 3 -->
                <div class="bg-white text-gray-800 p-6 rounded-2xl shadow-2xl flex flex-col justify-between h-full">
                    <p class="italic mb-6">"Pelayanannya oke banget, mobilnya bersih dan nyaman dipakai. Proses sewa juga cepet, gak ribet sama sekali. Recommended deh."</p>
                    <div class="flex items-center mt-auto">
                        <div class="w-10 h-10 bg-black text-white rounded-full flex items-center justify-center font-bold mr-4">
                            MP
                        </div>
                        <div>
                            <p class="font-semibold">Maya Putri</p>
                            <p class="text-sm text-gray-500">Pengguna dari Medan Marelan</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Top Picks -->
    <section id="top-picks" class="py-14 px-6 md:px-12">
        <h2 class="text-3xl font-bold text-center mb-8">Top Picks</h2>  
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">    
            <?php
                    $ambildatamobil = mysqli_query($conn, "SELECT m.*, h.per_hari FROM mobil m INNER JOIN harga_mobil h ON m.id_mobil = h.id_mobil WHERE m.id_mobil = '1'");
                    while($data=mysqli_fetch_array($ambildatamobil)){
                        $merek = $data['merek_mobil'];
                        $nama = $data['nama_mobil'];
                        $tahun = $data['tahun_produksi'];
                        $tipe = $data['tipe_mobil'];
                        $transmission = $data['transmission'];
                        $mesin = $data['engine'];
                        $plat = $data['nomor_plat'];
                        $bbm = $data['bahan_bakar'];
                        $interior = $data['interior_color'];
                        $exterior = $data['exterior_color'];
                        $seats = $data['seats'];
                        $status = $data['status'];
                        $harga = number_format($data['per_hari'], 0, ',', '.');
                        $id_mobil = $data['id_mobil'];
                    
                        include 'card_home_mobil.php';
                    }
                ?>
            <?php
                    $ambildatamobil = mysqli_query($conn, "SELECT m.*, h.per_hari FROM mobil m INNER JOIN harga_mobil h ON m.id_mobil = h.id_mobil WHERE m.id_mobil = '3'");
                    while($data=mysqli_fetch_array($ambildatamobil)){
                        $merek = $data['merek_mobil'];
                        $nama = $data['nama_mobil'];
                        $tahun = $data['tahun_produksi'];
                        $tipe = $data['tipe_mobil'];
                        $transmission = $data['transmission'];
                        $mesin = $data['engine'];
                        $plat = $data['nomor_plat'];
                        $bbm = $data['bahan_bakar'];
                        $interior = $data['interior_color'];
                        $exterior = $data['exterior_color'];
                        $seats = $data['seats'];
                        $status = $data['status'];
                        $harga = number_format($data['per_hari'], 0, ',', '.');
                        $id_mobil = $data['id_mobil'];
                    
                        include 'card_home_mobil.php';
                    }
                ?>
            <?php
                    $ambildatamobil = mysqli_query($conn, "SELECT m.*, h.per_hari FROM mobil m INNER JOIN harga_mobil h ON m.id_mobil = h.id_mobil WHERE m.id_mobil = '9'");
                    while($data=mysqli_fetch_array($ambildatamobil)){
                        $merek = $data['merek_mobil'];
                        $nama = $data['nama_mobil'];
                        $tahun = $data['tahun_produksi'];
                        $tipe = $data['tipe_mobil'];
                        $transmission = $data['transmission'];
                        $mesin = $data['engine'];
                        $plat = $data['nomor_plat'];
                        $bbm = $data['bahan_bakar'];
                        $interior = $data['interior_color'];
                        $exterior = $data['exterior_color'];
                        $seats = $data['seats'];
                        $status = $data['status'];
                        $harga = number_format($data['per_hari'], 0, ',', '.');
                        $id_mobil = $data['id_mobil'];
                    
                        include 'card_home_mobil.php';
                    }
                ?>
            </div>
        </div>
    </section>

    <!-- Search by Categories -->
    <section class="px-6 md:px-12 py-10 mb-10">
        <h2 class="text-3xl font-bold mb-6 text-gray-900">Search by Categories</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-8 gap-4">

            <!-- Category Buttons -->
            <a href="list_mobil.php#mpv" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">MPV</a>
            <a href="list_mobil.php#suv" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">SUV</a>
            <a href="list_mobil.php#hatchback" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">HATCHBACK</a>
            <a href="list_mobil.php#minibus" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">MINIBUS</a>
            <a href="list_mobil.php#manual" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">MANUAL</a>
            <a href="list_mobil.php#auto" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">AUTO</a>
            <a href="list_mobil.php#bensin" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">BENSIN</a>
            <a href="list_mobil.php#diesel" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">DIESEL</a>

        </div>
    </section>

    <!-- Tentang Kami -->
    <section id="tentang_kami" class="bg-black text-white py-14 px-6 md:px-12">
    <div class="container mx-auto flex flex-col md:flex-row items-center gap-8">

        <!-- Bagian Teks -->
        <div class="md:w-1/2">
            <h2 class="text-3xl font-bold mb-4">Tentang Kami</h2>
            <p class="mb-6 text-justify leading-relaxed">
                FlexDrive hadir untuk memudahkan perjalanan Anda dengan layanan rental mobil cepat, aman, dan tanpa ribet.
                Dengan berbagai pilihan mobil, kami memastikan pengalaman sewa yang nyaman dan terpercaya.
            </p>

            <!-- Contact Info -->
            <h3 class="text-xl font-semibold mb-3">Contact</h3>
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <img src="../../images/Location putih.png" alt="Lokasi" class="w-6 h-6">
                    <span>Jalan Gandhi No. 99A</span>
                </div>
                <div class="flex items-center gap-3">
                    <img src="../../images/Phone.png" alt="Telepon" class="w-6 h-6">
                    <span>084978652349</span>
                </div>
                <div class="flex items-center gap-3">
                    <img src="../../images/email.png" alt="Email" class="w-6 h-6">
                    <span>customerservice@flexdrive.com</span>
                </div>
                <div class="flex items-center gap-3">
                    <img src="../../images/jam.png" alt="Jam Operasional" class="w-6 h-6">
                    <div class="flex flex-col">
                        <span class="font-bold">Jam Operasional</span>
                        <span>Senin-Sabtu: 07:00AM - 11:00PM</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Logo -->
        <div class="md:w-1/2 flex justify-center">
            <img src="../../images/logoFlexDrive.png" alt="FlexDrive Logo" class="w-2/3 md:w-1/2 h-auto">
        </div>

    </div>
</section>
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