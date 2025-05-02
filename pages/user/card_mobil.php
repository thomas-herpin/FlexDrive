<div class="bg-white min-w-[250px] w-[250px] shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex flex-col justify-between min-h-[520px]">
    <img src="../../images_admin/<?=$data['gambar_mobil'];?>" alt="<?=$merek;?> <?=$nama;?>" class="w-full h-40 object-cover">

    <div class="p-4 flex-1 flex flex-col justify-between">
        <div>
            <h3 class="text-lg font-semibold"><?=$tahun;?> <?=$merek;?> <?=$nama;?></h3>
            <p class="text-gray-500 text-sm"><?=$merek;?> - Model year <?=$tahun;?></p>
            <div class="text-sm mt-2 space-y-1">
                <p><strong>Body type:</strong> <?=$tipe;?></p>
                <p><strong>Engine:</strong> <?=$mesin;?> (<?=$bbm;?>)</p>
                <p><strong>Transmission:</strong> <?=$transmission;?></p>
                <p><strong>Interior & exterior colors:</strong> <?=$interior;?> <?=$exterior;?></p>
                <p><strong>Seats:</strong> <?=$seats;?></p>
            </div>
            <p class="mt-3 text-gray-500">Start from</p>
            <p class="text-lg font-bold text-green-600">Rp.<?=$harga?></p>
        </div>
    </div>

    <form action="pemesanan.php" method="POST" class="mt-auto">
        <input type="hidden" name="id_mobil" value="<?= $id_mobil; ?>">
        <button type="submit" class="w-full bg-black text-white p-2 rounded-b-xl hover:bg-gray-800 transition">
            Sewa Sekarang
        </button>
    </form>
</div>
