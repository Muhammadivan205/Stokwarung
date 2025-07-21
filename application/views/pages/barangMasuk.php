<div class="px-4 py-8 ">
  <a href="<?= base_url('atur-stok') ?>" class="flex items-center gap-2">
    <img src="<?= base_url('assets/icons/stokwarung-icons-arrow.svg') ?>" alt="arrow-icons">
    <h1 class="text-2xl">Barang Masuk</h1>
  </a>

  <form class="mt-5" action="<?= base_url('barang-masuk/store') ?>" method="post" enctype="multipart/form-data">
    
    <!-- Nama Barang -->
    <div class="flex flex-col">
      <label for="nama_barang" class="text-sm">Nama Barang</label>
      <input type="text" id="nama_barang" name="nama_barang" class="px-4 py-3 mt-2 border border-neutral-300 rounded-full" placeholder="Nama Barang" required>
    </div>

    <!-- Kode Barang -->
    <div class="flex flex-col mt-4">
      <label for="kode_barang" class="text-sm">Kode Barang</label>
      <input type="text" id="kode_barang" name="kode_barang" class="px-4 py-3 mt-2 border border-neutral-300 rounded-full" placeholder="Kode Barang" required>
    </div>

    <!-- Jumlah Barang -->
    <div class="flex flex-col mt-4" x-data="{ jumlah: 0 }">
      <label for="jumlah_barang" class="text-sm">Jumlah Barang</label>
      <div class="flex items-center gap-2 justify-between mt-2">
        <input
          type="number"
          id="jumlah_barang"
          name="jumlah_barang"
          x-model="jumlah"
          class="px-4 py-3 border border-neutral-300 rounded-full w-full"
          placeholder="Jumlah Barang"
          min="0"
          required>
        <div class="flex items-center gap-2 w-[50%]">
          <button type="button" @click="jumlah++">
            <img src="<?= base_url('assets/icons/stokwarung-icons-tambah-barang.svg') ?>" alt="tambah-barang-svg" class="w-full">
          </button>
          <button type="button" @click="if(jumlah > 0) jumlah--">
            <img src="<?= base_url('assets/icons/stokwarung-icons-kurang-barang.svg') ?>" alt="kurang-barang-svg" class="w-full">
          </button>
        </div>
      </div>
    </div>

    <!-- Satuan Barang -->
    <div class="flex flex-col mt-4">
      <label for="satuan_barang" class="text-sm">Satuan Barang</label>
      <select
        name="satuan_barang"
        id="satuan_barang"
        class="px-4 py-3 mt-2 border border-neutral-300 rounded-full bg-transparent"
        required>
        <option value="" disabled selected>Pilih Satuan</option>
        <option value="pcs">pcs</option>
        <option value="kg">kg</option>
        <option value="liter">liter</option>
        <option value="pack">pack</option>
        <option value="dus">dus</option>
      </select>
    </div>

    <!-- Gambar -->
    <div class="flex flex-col mt-4" x-data="{ preview: null }">
      <label class="text-sm font-medium mb-2">Tambahkan Gambar <span class="text-gray-500">(Optional)</span></label>

      <label
        for="gambar"
        class="cursor-pointer flex flex-col items-center justify-center w-full h-40 bg-gray-100 rounded-2xl border border-dashed border-gray-300 text-gray-400">
        <template x-if="!preview">
          <div class="flex flex-col items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12l4-4m0 0l-4-4m4 4H8" />
            </svg>
            <p class="text-sm">Ketuk untuk memilih gambar</p>
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
        @change="const file = $event.target.files[0];
             if (file) {
               const reader = new FileReader();
               reader.onload = (e) => preview = e.target.result;
               reader.readAsDataURL(file);
             }" />
    </div>

    <button type="submit" class="bg-[#679F6A] w-full py-4 rounded-full mt-10 text-center text-white font-semibold">Simpan</button>
    <div class="mb-20"></div>
  </form>
</div>
