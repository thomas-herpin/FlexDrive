<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran - FlexDrive</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    
    <!-- Navbar -->
    <?php require "navbar_user.php"; ?>

    <!-- Form Konfirmasi Pembayaran -->
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4 mt-20">Konfirmasi Pembayaran</h2>
        <form id="paymentForm">
            <div class="mb-4">
                <label for="name" class="block font-medium mb-1">Nama Pengirim</label>
                <input type="text" id="name" class="w-full p-2 border rounded" placeholder="Masukkan nama pengirim" required>
            </div>
            
            <div class="mb-4">
                <label for="bank" class="block font-medium mb-1">Bank Tujuan</label>
                <select id="bank" class="w-full p-2 border rounded" required>
                <option>Virtual Account BCA</option>
                <option>Virtual Account BRI</option>
                <option>PERMATA</option>
                <option>DANA</option>
                <option>Virtual Account MANDIRI</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label for="amount" class="block font-medium mb-1">Jumlah Transfer</label>
                <input type="number" id="amount" class="w-full p-2 border rounded" placeholder="Masukkan jumlah transfer" required>
            </div>
            
            <div class="mb-4">
                <label for="date" class="block font-medium mb-1">Tanggal Transfer</label>
                <input type="date" id="date" class="w-full p-2 border rounded" required>
            </div>
            
            <div class="mb-4">
                <label for="receipt" class="block font-medium mb-1">Upload Bukti Transfer</label>
                <input type="file" id="receipt" class="w-full p-2 border rounded" accept="image/*" required>
            </div>
            
            <button class="w-full bg-black text-white p-3 rounded text-lg hover:bg-gray-800 transition">Kirim Konfirmasi</button>
        </form>
    </div>

    <script>
        document.getElementById("paymentForm").addEventListener("submit", function(event) {
            event.preventDefault();
            
            let name = document.getElementById("name").value;
            let bank = document.getElementById("bank").value;
            let amount = document.getElementById("amount").value;
            let date = document.getElementById("date").value;
            let receipt = document.getElementById("receipt").files.length;
            
            if (name && bank && amount && date && receipt) {
                alert("Konfirmasi pembayaran berhasil dikirim!");
                this.reset(); // Reset form setelah submit
            } else {
                alert("Harap isi semua data sebelum mengirim konfirmasi!");
            }
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