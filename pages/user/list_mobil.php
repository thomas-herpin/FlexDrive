<?php
require_once '../config.php';

// Cek session login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../sign_in.html");
    exit(); // Hentikan eksekusi script jika belum login
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        ion-icon {
            color: white;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            scrollbar-width: none;  
        }
    </style>
    <title>List Mobil | FlexDrive</title>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <?php require "../navbar_user.php"; ?>

    <!-- Search by Categories -->
    <section class="px-6 md:px-12 py-10 mb-10">
        <h2 class="text-3xl font-bold mt-11 mb-6  text-gray-900">Search by Categories</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-8 gap-4">

        <!-- Category Buttons -->
        <a href="#mpv" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">MPV</a>
        <a href="#suv" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">SUV</a>
        <a href="#hatchback" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">HATCHBACK</a>
        <a href="#minibus" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">MINIBUS</a>
        <a href="#manual" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">MANUAL</a>
        <a href="#auto" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">AUTO</a>
        <a href="#bensin" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">BENSIN</a>
        <a href="#diesel" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">DIESEL</a>

        </div>
    </section>

    <!-- Tipe MPV -->
    <section class="relative p-4" id="mpv">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">MPV</h2>
        <div class="relative flex items-center">
            <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                &#10094;
            </button>

            <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">
                <?php
                    $ambildatamobil = mysqli_query($conn, "SELECT m.*, h.per_hari FROM mobil m INNER JOIN harga_mobil h ON m.id_mobil = h.id_mobil WHERE m.tipe_mobil = 'MPV' AND m.status != 'Tidak Aktif'");
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
                    
                        include 'card_mobil.php';
                    }
                ?>
        </div>

        <button class="next-btn absolute right-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
            &#10095;
        </button>
    </div>

    <!-- Tipe: SUV -->
    </section>
        <section class="relative p-4" id="suv">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">SUV</h2>
            <div class="relative flex items-center">
                <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                    &#10094;
                </button>

                <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">
                <?php
                    $ambildatamobil = mysqli_query($conn, "SELECT m.*, h.per_hari FROM mobil m INNER JOIN harga_mobil h ON m.id_mobil = h.id_mobil WHERE m.tipe_mobil = 'SUV' AND m.status != 'Tidak Aktif'");
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
                    
                        include 'card_mobil.php';
                    }
                ?>
            </div>

            <button class="next-btn absolute right-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                &#10095;
            </button>
        </div>
    </section>

    <!-- Tipe: Hatchback -->
    </section>
        <section class="relative p-4" id="hatchback">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Hatchback</h2>
            <div class="relative flex items-center">
                <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                    &#10094;
                </button>

                <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">
                <?php
                    $ambildatamobil = mysqli_query($conn, "SELECT m.*, h.per_hari FROM mobil m INNER JOIN harga_mobil h ON m.id_mobil = h.id_mobil WHERE m.tipe_mobil = 'Hatchbac AND m.status != 'Tidak Aktif'k'");
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
                    
                        include 'card_mobil.php';
                    }
                ?>
            </div>

            <button class="next-btn absolute right-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                &#10095;
            </button>
        </div>
    </section>

    <!-- Tipe: Minibus -->
    </section>
        <section class="relative p-4" id="minibus">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Minibus</h2>
            <div class="relative flex items-center">
                <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                    &#10094;
                </button>

                <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">
                <?php
                    $ambildatamobil = mysqli_query($conn, "SELECT m.*, h.per_hari FROM mobil m INNER JOIN harga_mobil h ON m.id_mobil = h.id_mobil WHERE m.tipe_mobil = 'Minibus' AND m.status != 'Tidak Aktif'");
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
                    
                        include 'card_mobil.php';
                    }
                ?>
            </div>

            <button class="next-btn absolute right-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                &#10095;
            </button>
        </div>
    </section>

    <!-- Transmission: Manual -->
    </section>
        <section class="relative p-4" id="manual">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Manual</h2>
            <div class="relative flex items-center">
                <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                    &#10094;
                </button>

                <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">
                <?php
                    $ambildatamobil = mysqli_query($conn, "SELECT m.*, h.per_hari FROM mobil m INNER JOIN harga_mobil h ON m.id_mobil = h.id_mobil WHERE m.transmission = 'Manual AND m.status != 'Tidak Aktif''");
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
                    
                        include 'card_mobil.php';
                    }
                ?>
            </div>

            <button class="next-btn absolute right-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                &#10095;
            </button>
        </div>
    </section>

    <!-- Transmission: Automatic -->
    </section>
        <section class="relative p-4" id="auto">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Automatic</h2>
            <div class="relative flex items-center">
                <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                    &#10094;
                </button>

                <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">
                <?php
                    $ambildatamobil = mysqli_query($conn, "SELECT m.*, h.per_hari FROM mobil m INNER JOIN harga_mobil h ON m.id_mobil = h.id_mobil WHERE m.transmission = 'Automa AND m.status != 'Tidak Aktif'tic'");
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
                    
                        include 'card_mobil.php';
                    }
                ?>
            </div>

            <button class="next-btn absolute right-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                &#10095;
            </button>
        </div>
    </section>

    <!-- Bahan Bakar: Bensin -->
    </section>
        <section class="relative p-4" id="bensin">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Bensin</h2>
            <div class="relative flex items-center">
                <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                    &#10094;
                </button>

                <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">
                <?php
                    $ambildatamobil = mysqli_query($conn, "SELECT m.*, h.per_hari FROM mobil m INNER JOIN harga_mobil h ON m.id_mobil = h.id_mobil WHERE m.bahan_bakar = 'Bensin' AND m.status != 'Tidak Aktif'");
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
                    
                        include 'card_mobil.php';
                    }
                ?>
            </div>

            <button class="next-btn absolute right-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                &#10095;
            </button>
        </div>
    </section>

    <!-- Bahan Bakar: Diesel -->
    </section>
        <section class="relative p-4" id="diesel">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Diesel</h2>
            <div class="relative flex items-center">
                <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                    &#10094;
                </button>

                <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">
                <?php
                    $ambildatamobil = mysqli_query($conn, "SELECT m.*, h.per_hari FROM mobil m INNER JOIN harga_mobil h ON m.id_mobil = h.id_mobil WHERE m.bahan_bakar = 'Diesel' AND m.status != 'Tidak Aktif'");
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
                    
                        include 'card_mobil.php';
                    }
                ?>
            </div>

            <button class="next-btn absolute right-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                &#10095;
            </button>
        </div>
    </section>
    
    <button id="scrollToTop" class="hidden fixed bottom-8 right-8 bg-black hover:bg-gray-600 text-white p-4 rounded-full shadow-lg transition duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg>
    </button>

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
        document.querySelectorAll(".prev-btn").forEach(button => {
            button.addEventListener("click", () => {
                const carList = button.closest("section").querySelector(".car-list");
                carList.scrollBy({ left: -320, behavior: "smooth" });
            });
        });

        document.querySelectorAll(".next-btn").forEach(button => {
            button.addEventListener("click", () => {
                const carList = button.closest("section").querySelector(".car-list");
                carList.scrollBy({ left: 320, behavior: "smooth" });
            });
        });

        const scrollToTopBtn = document.getElementById("scrollToTop");

        window.addEventListener("scroll", function () {
            if (window.scrollY > 300) {
                scrollToTopBtn.classList.remove("hidden");
            } else {
                scrollToTopBtn.classList.add("hidden");
            }
        });

        scrollToTopBtn.addEventListener("click", function () {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
        
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

