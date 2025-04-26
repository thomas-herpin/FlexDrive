<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Posisi Mobil | FlexDrive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#3E92CC",
                        secondary: "black",
                        success: "#10B981",
                        warning: "#F59E0B",
                        danger: "#EF4444",
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <?php require "../sidebar_admin.php";?>
        
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h1 class="text-2xl font-bold text-gray-700">Lacak Posisi Mobil</h1>
            <div class="mt-4 flex space-x-4">
                <select class="p-2 border rounded w-1/3">
                    <option value="">Pilih Mobil</option>
                    <option value="daihatsu_xenia">Daihatsu Xenia - BK 14 XY</option>
                    <option value="toyota_rush">Toyota Rush - BK 9876 DF</option>
                </select>
                <button class="bg-black text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-300">Lacak</button>
            </div>
            <div class="mt-4 w-full h-96 bg-gray-300 flex items-center justify-center text-gray-500">
                <i class="fas fa-map-marked-alt text-4xl"></i>
                <p class="ml-2">Peta akan ditampilkan di sini</p>
            </div>
        </div>
    </div>
</body>
</html>