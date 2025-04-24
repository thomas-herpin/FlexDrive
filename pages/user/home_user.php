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

    <!-- Search Section -->
    <section class="bg-gradient-to-r from-gray-700 to-black py-16 px-6 text-white">
        <div class="bg-white p-8 rounded-2xl shadow-2xl max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Titik Pengambilan -->
                <div class="flex flex-col">
                    <label class="font-semibold text-gray-800 text-sm md:text-base">Titik Pengambilan</label>
                    <div class="relative">
                        <img src="../../images/Location.png" alt="lokasi" 
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 opacity-70">
                        <input type="text"
                            class="pl-10 pr-4 py-3 rounded-lg border border-gray-400 focus:ring-2 focus:ring-blue-500 text-gray-800 w-full transition duration-300" placeholder="Jl.kerumah mantan No.18">
                    </div>
                </div>

                <!-- Titik Pengembalian -->
                <div class="flex flex-col">
                    <label class="font-semibold text-gray-800 text-sm md:text-base">Titik Pengembalian</label>
                    <div class="relative">
                        <img src="../../images/Location.png" alt="lokasi" 
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 opacity-70">
                        <input type="text"
                            class="pl-10 pr-4 py-3 rounded-lg border border-gray-400 focus:ring-2 focus:ring-blue-500 text-gray-800 w-full transition duration-300" placeholder="Jl.kerumah kosong No.28">
                    </div>
                </div>

                <!-- Tanggal Pengambilan -->
                <div class="flex flex-col">
                    <label class="font-semibold text-gray-800 text-sm md:text-base">Tanggal Pengambilan</label>
                    <input type="datetime-local"
                        class="p-3 rounded-lg border border-gray-400 focus:ring-2 focus:ring-blue-500 text-gray-800 w-full transition duration-300">
                </div>

                <!-- Tanggal Pengembalian -->
                <div class="flex flex-col">
                    <label class="font-semibold text-gray-800 text-sm md:text-base">Tanggal Pengembalian</label>
                    <input type="datetime-local"
                        class="p-3 rounded-lg border border-gray-400 focus:ring-2 focus:ring-blue-500 text-gray-800 w-full transition duration-300">
                </div>
            </div>

            <!-- Tombol Search -->
            <div class="flex justify-center mt-6">
                <a href="list_mobil.php"><button class="bg-black text-white px-12 py-3 rounded-full font-semibold text-lg hover:bg-gray-700 transition duration-300 shadow-lg">
                    SEARCH
                </button></a>
            </div>
        </div>
    </section>

    <!-- Top Picks -->
    <section id="top-picks" class="py-14 px-6 md:px-12 bg-gray-100">
        <h2 class="text-3xl font-bold text-center mb-8">Top Picks</h2>  
        <div class="container mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                
                <!-- Card 1 -->
                <a href="pemesanan.php">
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-300 transform transition-all hover:scale-105 hover:shadow-2xl">
                        <img src="../../images/toyota-veloz 2021.png" alt="Toyota Veloz 2021" class="w-full h-44 object-contain mt-4">
                        <div class="p-5">
                            <h3 class="text-xl font-semibold">2021 Toyota Veloz</h3>
                            <p class="text-gray-500 text-sm mb-3">TOYOTA - Model year 2021</p>
                            <div class="text-sm space-y-1">
                                <p><strong>Body type:</strong> MPV</p>
                                <p><strong>Engine:</strong> 1.5L 4-Cylinder DOHC Dual VVT-i</p>
                                <p><strong>Transmission:</strong> CVT (Continuously Variable Transmission)</p>
                                <p><strong>Interior & exterior colors:</strong> black, silver</p>
                                <p><strong>Seats:</strong> 7</p>
                            </div>
                            <p class="mt-4 text-gray-500">Start from</p>
                            <p class="text-lg font-bold text-green-600">Rp.600.000</p>
                        </div>
                    </div>
                </a>

                <!-- Card 2 -->
                <a href="pemesanan.php"><div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-300 transform transition-all hover:scale-105 hover:shadow-2xl">
                    <img src="../../images/toyota-venturer.png" alt="Toyota Innova Venturer" class="w-full h-44 object-contain mt-4">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold">2018 Innova Venturer</h3>
                        <p class="text-gray-500 text-sm mb-3">TOYOTA - Model year 2019</p>
                        <div class="text-sm space-y-1">
                            <p><strong>Body type:</strong> MPV</p>
                            <p><strong>Engine:</strong> 2.4L 4-Cylinder DOHC (Diesel)</p>
                            <p><strong>Transmission:</strong> 6-Speed Automatic</p>
                            <p><strong>Interior & exterior colors:</strong> black, silver</p>
                            <p><strong>Seats:</strong> 7</p>
                        </div>
                        <p class="mt-4 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.800.000</p>
                    </div>
                </div></a>
                

                <!-- Card 3 -->
                <a href="pemesanan.php">
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-300 transform transition-all hover:scale-105 hover:shadow-2xl">
                        <img src="../../images/Hiiace 2018.png" alt="Toyota Hiace Premio" class="w-full h-44 object-contain mt-4">
                        <div class="p-5">
                            <h3 class="text-xl font-semibold">2018 Hiace Premio</h3>
                            <p class="text-gray-500 text-sm mb-3">TOYOTA - Model year 2018</p>
                            <div class="text-sm space-y-1">
                                <p><strong>Body type:</strong> Van</p>
                                <p><strong>Engine:</strong> 2.8L 4-Cylinder Turbo Diesel</p>
                                <p><strong>Transmission:</strong> 6-Speed Manual</p>
                                <p><strong>Interior & exterior colors:</strong> black, white</p>
                                <p><strong>Seats:</strong> 15</p>
                            </div>
                            <p class="mt-4 text-gray-500">Start from</p>
                            <p class="text-lg font-bold text-green-600">Rp.1.000.000</p>
                        </div>
                    </div>
                </a>
                

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