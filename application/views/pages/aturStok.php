<div class="px-4 py-8">
  <h1 class="font-bold text-2xl">Atur Stok</h1>
  <p class="text-sm text-neutral-600 mt-1">Perbarui data barang kamu !</p>
  <div class="flex items-center justify-between mt-5">
    <a href="<?= base_url('barang-masuk') ?>" class="w-[48%]">
      <img src="<?= base_url('assets/images/stokwarung-images-barang-masuk.svg') ?>" alt="barang-masuk">
    </a>
    <a href="<?= base_url('barang-keluar') ?>"" class=" w-[48%]">
      <img src="<?= base_url('assets/images/stokwarung-images-barang-keluar.svg') ?>" alt="barang-masuk">
    </a>
  </div>

</div>
<div class="bg-white px-4 py-4 pb-24 min-h-[70%]">
  <h1 class="font-bold text-2xl">Daftar Stok</h1>
  <p class="text-sm text-neutral-600 mt-1">Cek kelengkapan barang kamu !</p>


  <div class="mt-4 flex flex-col gap-4">
    <?php foreach ($barang as $b) :
      $gambar = $b->gambar ? base_url('uploads/' . $b->gambar) : base_url('assets/images/stokwarung-images-sunscreen.png');
      $createdAt = date('d F Y', strtotime($b->created_at));
    ?>
      <div class="flex items-start gap-3 border border-neutral-100 rounded-lg p-4">
        <img src="<?= $gambar ?>" alt="<?= $b->nama_barang ?>" class="w-[70px] h-[70px] rounded-sm object-cover">

        <div class="flex items-center justify-between gap-2 w-full">
          <div class="flex-1 ">
            <div class="text-sm mb-1 flex items-start w-full ">
              <p class="font-semibold w-full"><?= $b->nama_barang ?></p>
              <span class="text-neutral-700 w-full">(<?= $createdAt ?>)</span>
            </div>
            <p class="text-sm">Tersedia <?= $b->total_stok ?> <?= $b->satuan ?> </p>
          </div>

          <a href="<?= base_url('barang/edit/' . $b->id) ?>">
            <img src="<?= base_url('assets/icons/stokwarung-icons-edit.svg') ?>" alt="edit-icons">
          </a>

        </div>
      </div>
    <?php endforeach; ?>
  </div>

</div>