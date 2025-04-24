<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <!-- Navbar -->
    <?php require "navbar_user.php"; ?>

    <section class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mt-20 mb-6">Account Settings</h2>
        <div class="space-y-6">
            <div class="w-40 h-40 rounded-full bg-gray-500 flex items-center justify-center">
                <i class="fas fa-user text-white"></i>
            </div>
            <div>
                <p class="text-gray-600">Nama</p>
                <p class="font-semibold">Arron Taslim</p>
            </div>
            <div>
                <p class="text-gray-600">Tanggal lahir</p>
                <p class="font-semibold">December 24, 1991</p>
            </div>
            <div>
                <p class="text-gray-600">Jenis Kelamin</p>
                <p class="font-semibold">Laki-laki</p>
            </div>
            <div>
                <p class="text-gray-600">Email</p>
                <p class="font-semibold">arron@gmail.com</p>
            </div>
            <div>
                <p class="text-gray-600">Username</p>
                <p class="font-semibold">arron08</p>
            </div>
            <div>
                <p class="text-gray-600">Password</p>
                <p class="font-semibold">**********</p>
            </div>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section id="tentang_kami" class="bg-black text-white mt-10 py-14 px-6 md:px-12">
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