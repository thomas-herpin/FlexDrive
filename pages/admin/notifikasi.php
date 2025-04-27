<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi | FlexDrive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <?php require "../sidebar_admin.php";?>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-semibold mb-4">Notifikasi</h1>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="space-y-3">
                <div class="p-3 border-l-4 border-blue-500 bg-blue-50 text-blue-900 rounded">
                    <p><strong>Permintaan Baru:</strong> Siti Rahma memesan Suzuki Ertiga</p>
                    <span class="text-sm text-gray-600">7 Maret 2025, 09:00</span>
                </div>
                <div class="p-3 border-l-4 border-green-500 bg-green-50 text-green-900 rounded">
                    <p><strong>Konfirmasi:</strong> Penyewaan Daihatsu Xenia oleh Budi Santoso telah dikonfirmasi</p>
                    <span class="text-sm text-gray-600">6 Maret 2025, 08:00</span>
                </div>
                <div class="p-3 border-l-4 border-yellow-500 bg-yellow-50 text-yellow-900 rounded">
                    <p><strong>Peringatan:</strong> Toyota Rush (BK 9876 DF) masih dalam perjalanan</p>
                    <span class="text-sm text-gray-600">6 Maret 2025, 12:00</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>