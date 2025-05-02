<?php
require_once '../config.php';

// Cek session login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../sign_in.html");
    exit(); // Hentikan eksekusi script jika belum login
}

$id_usernya = $_SESSION['user_id'];

function tampilkanStatus($status) {
    switch (strtolower($status)) {
        case 'dikonfirmasi':
            return '<span class="inline-block px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full">Dikonfirmasi</span>';
        case 'menunggu':
            return '<span class="inline-block px-3 py-1 text-sm font-medium text-yellow-800 bg-yellow-100 rounded-full">Menunggu</span>';
        case 'dibatalkan':
            return '<span class="inline-block px-3 py-1 text-sm font-medium text-red-800 bg-red-100 rounded-full">Dibatalkan</span>';
        default:
            return '<span class="inline-block px-3 py-1 text-sm font-medium text-gray-800 bg-gray-100 rounded-full">Status tidak diketahui</span>';
    }
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
<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Navbar -->
    <?php require "../navbar_user.php"; ?>

        <!-- Tipe MPV -->
        <section class="relative p-4" id="pesanan_saya">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Pesanan Saya</h2>
            <div class="relative flex items-center">
                <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg lg:hidden">
                    &#10094;
                </button>

                <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">
                <?php
                    $ambildatapesanan = mysqli_query($conn, "SELECT p.*, m.*, u.*, pb.*
                    FROM pemesanan p
                    INNER JOIN mobil m ON p.id_mobil = m.id_mobil
                    INNER JOIN users u ON p.id_user = u.id_user
                    INNER JOIN pembayaran pb ON p.id_pesan = pb.id_pesan
                    WHERE p.id_user = '$id_usernya';");

                    if (!$ambildatapesanan) {
                        die("Query failed: " . mysqli_error($conn));
                    }

                    if (mysqli_num_rows($ambildatapesanan) > 0) {
                        while ($data = mysqli_fetch_array($ambildatapesanan)) {
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
                            $status = $data['status_pembayaran'];
                            $id_mobil = $data['id_mobil'];
                            $tgl_ambil = $data['tanggal_pengambilan'];
                            $tgl_kembali = $data['tanggal_pengembalian'];
                        
                        
                ?>
                    <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-65 flex-none">
                        <img src="../../images_admin/<?=$data['gambar_mobil'];?>" alt="<?=$merek;?> <?=$nama;?>" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold"><?=$tahun;?> <?=$merek;?> <?=$nama;?></h3>
                            <p class="text-gray-500 text-sm"><?=$merek;?> - Model year <?=$tahun;?></p>
                            <div class="text-sm mt-2 space-y-1">
                                <p><strong>Body type:</strong> <?=$tipe;?></p>
                                <p><strong>Engine:</strong> <?=$mesin;?> (<?=$bbm;?>)</p>
                                <p><strong>Transmission:</strong> <?=$transmission;?></p>
                                <p><strong>Interior & exterior colors:</strong> <?=$interior;?> <?=$exterior;?></p>
                                <p><strong>Seats:</strong> <?=$seats;?></p><br>
                                <p><strong>Status:</strong> <?=tampilkanStatus($status);?></p>
                                <p><strong>Tanggal Pengambilan:</strong> <?=$tgl_ambil;?></p>
                            </div>
                        </div>
                        <a href="https://api.whatsapp.com/send?phone=62082273555562&text=Halo%20admin%2C%20saya%20mau%20cek%20pesanan%20saya." target="_blank" class="block mt-3 w-full bg-black text-white text-center p-2 rounded hover:bg-gray-800 transition">
                            Hubungi kami
                        </a>
                    </div>
                <?php
                    }
                } else {
                    echo '<p class="text-2xl font-bold text-center my-8 text-gray-500">Tidak ada pesanan yang ditemukan</p>';
                }
                ?>
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
    <footer class="mt-auto">
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
    </footer> 
    

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

