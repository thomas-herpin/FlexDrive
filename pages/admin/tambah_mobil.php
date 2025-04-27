<?php
require_once '../config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mobil | FlexDrive</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen flex items-center justify-center p-6">
    <div class="container max-w-3xl mx-auto">
        <div class="bg-white shadow-2xl rounded-xl overflow-hidden">
            <div class="bg-black text-white p-6">
                <h2 class="text-3xl font-bold">Tambah Mobil Baru</h2>
                <p class="text-gray-300">Lengkapi informasi detail mobil untuk ditambahkan ke armada FlexDrive.</p>
            </div>
            <form action="#" class="p-6 space-y-6">
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Merek Mobil</label>
                        <input 
                            type="text" 
                            name="merek_mobil" 
                            placeholder="Contoh: Toyota" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Nama Mobil</label>
                        <input 
                            type="text" 
                            name="nama_mobil" 
                            placeholder="Contoh: Veloz" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Tahun Produksi</label>
                        <input 
                            type="number" 
                            name="tahun" 
                            min="1990" 
                            max="2025" 
                            placeholder="Tahun produksi" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Nomor Plat</label>
                        <input 
                            type="text" 
                            name="nomor_plat" 
                            placeholder="BK 1234 XYZ"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Body Type</label>
                        <select 
                            name="body_type" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                            <option value="">Pilih Body Type</option>
                            <option value="MPV">MPV</option>
                            <option value="SUV">SUV</option>
                            <option value="Hatchback">Hatchback</option>
                            <option value="Minibus">Minibus</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Engine</label>
                        <input 
                            type="text" 
                            name="engine" 
                            placeholder="Contoh: 1.5L 4-cylinder" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Bahan Bakar</label>
                        <select 
                            name="bahan_bakar" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                            <option value="">Pilih Bahan Bakar</option>
                            <option value="Bensin">Bensin</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Hybrid">Hybrid</option>
                            <option value="Elektrik">Elektrik</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Transmission</label>
                        <select 
                            name="transmission" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                            <option value="">Pilih Transmission</option>
                            <option value="Manual">Manual</option>
                            <option value="Automatic">Automatic</option>
                            <option value="CVT">CVT</option>
                            <option value="DCT">DCT</option>
                        </select>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Interior Color</label>
                        <input 
                            type="text" 
                            name="interior_color" 
                            placeholder="Contoh: Hitam" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Exterior Color</label>
                        <input 
                            type="text" 
                            name="exterior_color" 
                            placeholder="Contoh: Putih Metalik" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Jumlah Kursi</label>
                        <input 
                            type="number" 
                            name="seats" 
                            min="2" 
                            max="12" 
                            placeholder="Jumlah kursi" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Konsumsi BBM (km/liter)</label>
                        <input 
                            type="number" 
                            name="konsumsi_BBM" 
                            step="0.1" 
                            min="0" 
                            placeholder="Contoh: 12.5" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Harga Sewa per Hari</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                            <input 
                                type="number" 
                                name="harga_sewa_hari" 
                                min="0" 
                                placeholder="Masukkan harga" 
                                class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Harga Sewa per Minggu</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                            <input 
                                type="number" 
                                name="harga_sewa_minggu" 
                                min="0" 
                                placeholder="Masukkan harga" 
                                class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" 
                                required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Harga Sewa per Bulan</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                            <input 
                                type="number" 
                                name="harga_sewa_bulan" 
                                min="0" 
                                placeholder="Masukkan harga" 
                                class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" 
                                required>
                        </div>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Status</label>
                        <select 
                            name="status" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                            <option value="Tersedia">Tersedia</option>
                            <option value="Disewa">Sedang Disewa</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Upload Gambar Mobil</label>
                        <input 
                            type="file" 
                            name="gambar_mobil" 
                            accept="image/*" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-blue-700 hover:file:bg-blue-100" required>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                    <a 
                        href="list_mobil_admin.php" 
                        class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition duration-300">
                        Batal
                    </a>
                    <a href="list_mobil_admin.php" 
                        class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition duration-300 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd">
                        </svg>
                        Simpan
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>