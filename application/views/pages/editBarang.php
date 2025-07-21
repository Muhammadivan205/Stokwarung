<div class="px-4 py-8 ">
  <a href="<?= base_url('atur-stok') ?>" class="flex items-center gap-2">
    <img src="<?= base_url('assets/icons/stokwarung-icons-arrow.svg') ?>" alt="arrow-icons">
    <h1 class="text-2xl">Edit Barang</h1>
  </a>

  <form class="mt-5" action="<?= base_url('barang/update/' . $barang->id) ?>" method="post" enctype="multipart/form-data" x-data="{ jumlah: <?= $barang->total_stok ?>, preview: '<?= $barang->gambar ? base_url('uploads/' . $barang->gambar) : '' ?>' }">

    <!-- Nama Barang -->
    <div class="flex flex-col">
      <label for="nama_barang" class="text-sm">Nama Barang</label>
      <input type="text" id="nama_barang" name="nama_barang" value="<?= $barang->nama_barang ?>" class="px-4 py-3 mt-2 border border-neutral-300 rounded-full" required>
    </div>

    <!-- Kode Barang -->
    <div class="flex flex-col mt-4">
      <label for="kode_barang" class="text-sm">Kode Barang</label>
      <input type="text" id="kode_barang" name="kode_barang" value="<?= $barang->kode_barang ?>" class="px-4 py-3 mt-2 border border-neutral-300 rounded-full" required>
    </div>

    <!-- Jumlah Barang -->
    <div class="flex flex-col mt-4">
      <label for="jumlah_barang" class="text-sm">Jumlah Barang</label>
      <div class="flex items-center gap-2 justify-between mt-2">
        <input
          type="number"
          id="jumlah_barang"
          name="jumlah_barang"
          x-model="jumlah"
          class="px-4 py-3 border border-neutral-300 rounded-full w-full"
          min="0"
          required>
        <div class="flex items-center gap-2 w-[50%]">
          <button type="button" @click="jumlah++">
            <img src="<?= base_url('assets/icons/stokwarung-icons-tambah-barang.svg') ?>" alt="tambah-barang-svg">
          </button>
          <button type="button" @click="if(jumlah > 0) jumlah--">
            <img src="<?= base_url('assets/icons/stokwarung-icons-kurang-barang.svg') ?>" alt="kurang-barang-svg">
          </button>
        </div>
      </div>
    </div>

    <!-- Satuan Barang -->
    <div class="flex flex-col mt-4">
      <label for="satuan_barang" class="text-sm">Satuan Barang</label>
      <select name="satuan_barang" id="satuan_barang" class="px-4 py-3 mt-2 border border-neutral-300 rounded-full bg-transparent" required>
        <option value="" disabled>Pilih Satuan</option>
        <?php foreach (['pcs', 'kg', 'liter', 'pack', 'dus'] as $s): ?>
          <option value="<?= $s ?>" <?= $barang->nama_satuan == $s ? 'selected' : '' ?>><?= $s ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Gambar -->
    <div class="flex flex-col mt-4">
      <label class="text-sm font-medium mb-2">Gambar Barang <span class="text-gray-500">(Optional)</span></label>
      <label
        for="gambar"
        class="cursor-pointer flex flex-col items-center justify-center w-full h-40 bg-gray-100 rounded-2xl border border-dashed border-gray-300 text-gray-400">
        <template x-if="!preview">
          <div class="flex flex-col items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12l4-4m0 0l-4-4m4 4H8" />
            </svg>
            <p class="text-sm">Ketuk untuk pilih gambar baru</p>
          </div>
        </template>
        <template x-if="preview">
          <img :src="preview" alt="Preview" class="w-full h-full object-cover rounded-2xl" />
        </template>
      </label>

      <input
        type="file"
        id="gambar"
        name="gambar"
        accept="image/*"
        class="hidden"
        @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => preview = e.target.result; reader.readAsDataURL(file); }" />
    </div>

    <button type="submit" class="bg-[#679F6A] w-full py-4 rounded-full mt-10 text-white font-semibold mb-2">Simpan Perubahan</button>
    <!-- Tombol Hapus -->
    
  </form>
  <form action="<?= base_url('barang/delete/' . $barang->id) ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus barang ini?')" class="mt-4">
    <button type="submit" class="bg-red-500 w-full py-4 rounded-full text-white font-semibold">
      Hapus Barang
    </button>
    <div class="mb-20"></div>
  </form>
</div>