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

    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-center text-2xl font-bold mt-20 mb-6">Form Pemesanan Mobil</h2>
        
        <div class="mb-4">
            <label for="car" class="block font-semibold mb-1">Pilih Mobil</label>
            <select id="car" class="w-full p-2 border rounded">
                <option>Toyota Avanza 1.5 Veloz 2021 M/T</option>
                <option>Toyota Innova Venturer 2018 A/T</option>
                <option>Toyota Rush 2018 A/T</option>
                <option>Honda Brio 2022 A/T</option>
                <option>Hiace 2023 M/T</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="pickup" class="block font-semibold">Lokasi Antar-Jemput</label>
            <input type="text" id="pickup" class="w-full p-2 border rounded mt-1" placeholder="Masukkan lokasi">
        </div>
        
         <div class="w-full h-40 bg-gray-200 rounded mt-2 overflow-hidden">
            <img src="../../images/map.jpg" class="w-full h-full object-cover">
            
        </div>
        
        <h3 class="text-lg font-semibold mb-2">Progres Pembayaran</h3>
        <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
            <div class="bg-green-500 h-3 rounded-full" style="width: 50%;"></div>
        </div>
        
        <div class="mb-4">
            <label for="payment" class="block font-semibold mb-1">Pilih Metode Pelunasan</label>
            <select id="payment" class="w-full p-2 border rounded">
                <option>DP 50%</option>
                <option>Pelunasan Langsung</option>
            </select>
        </div>
              
        <a href="pembayaran.php"><button class="w-full bg-black text-white p-3 rounded text-lg hover:bg-gray-800 transition">Lanjutkan Pembayaran</button></a>
    </div>
    
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