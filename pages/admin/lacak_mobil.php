<?php
require_once '../config.php';
$ambilsemuadatamobil = mysqli_query($conn, "SELECT * FROM mobil");
$jumlah_ditampilkan = mysqli_num_rows($ambilsemuadatamobil);
?>

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
                    <?php
                        if ($jumlah_ditampilkan > 0) {
                            while($data=mysqli_fetch_array($ambilsemuadatamobil)){
                                $nama = $data['merek_mobil']." ".$data['nama_mobil'];
                                $plat = $data['nomor_plat'];
                                $id_mobil = $data['id_mobil'];
                                $kode_mobil = 'MBL_' . sprintf('%03d', $id_mobil);
                    ?> 
                        <option value="<?=$id_mobil;?>"><?=$kode_mobil;?> - <?=$nama;?> - <?=$plat;?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <button class="bg-black text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-300">Lacak</button>
            </div>
            <div class="w-full h-96 bg-gray-200 rounded mt-4 overflow-hidden">
                <iframe id="mapFrame" 
                        class="w-full h-full" 
                        frameborder="0" 
                        style="border:0" 
                        allowfullscreen 
                        src="https://maps.google.com/maps?q=medankota&output=embed">
                </iframe>
            </div>
        </div>
    </div>
</body>
</html>