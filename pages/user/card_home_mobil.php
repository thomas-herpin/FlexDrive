<div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-300 transform transition-all hover:scale-105 hover:shadow-2xl w-full h-full flex flex-col">
    <img src="../../images_admin/<?=$data['gambar_mobil'];?>" alt="<?=$merek;?> <?=$nama;?>" class="w-full h-44 object-contain mt-4">

    <div class="p-5 flex-grow">
        <h3 class="text-xl font-semibold"><?=$tahun;?> <?=$merek;?> <?=$nama;?></h3>
        <p class="text-gray-500 text-sm mb-3"><?=$merek;?> - Model year <?=$tahun;?></p>
        <div class="text-sm space-y-1">
            <p><strong>Body type:</strong> <?=$tipe;?></p>
            <p><strong>Engine:</strong> <?=$mesin;?> (<?=$bbm;?>)</p>
            <p><strong>Transmission:</strong> <?=$transmission;?></p>
            <p><strong>Interior & exterior colors:</strong> <?=$interior;?> <?=$exterior;?></p>
            <p><strong>Seats:</strong> <?=$seats;?></p> 
        </div>
        <p class="mt-4 text-gray-500">Start from</p>
        <p class="text-lg font-bold text-green-600">Rp. <?=$harga;?></p>
    </div>

    <form action="pemesanan.php" method="POST" class="px-5 pb-5">
        <input type="hidden" name="id_mobil" value="<?= $id_mobil; ?>">
        <button type="submit" class="w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800 transition">
            Sewa Sekarang
        </button>
    </form>
</div>