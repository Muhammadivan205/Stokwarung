<div class="px-4 py-8" x-data="barangKeluarForm()">
  <a href="<?= base_url('atur-stok') ?>" class="flex items-center gap-2">
    <img src="<?= base_url('assets/icons/stokwarung-icons-arrow.svg') ?>" alt="arrow-icons">
    <h1 class="text-2xl">Barang Keluar</h1>
  </a>

  <form class="mt-5" action="<?= base_url('barang-keluar/store') ?>" method="post">
    <!-- Dropdown Nama Barang -->
    <div class="flex flex-col">
      <label for="barang_id" class="text-sm">Nama Barang</label>
      <select name="barang_id" id="barang_id"
        class="px-4 py-3 mt-2 border border-neutral-300 rounded-full bg-transparent"
        x-model="selectedBarangId" required>
        <option value="" disabled selected>Pilih Barang</option>
        <?php foreach ($barang as $b): ?>
          <option value="<?= $b->id ?>"><?= $b->nama_barang ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Kode Barang -->
    <template x-if="selectedKode">
      <div class="flex flex-col mt-4">
        <label class="text-sm">Kode Barang</label>
        <input type="text"
          class="px-4 py-3 mt-2 border border-neutral-300 rounded-full bg-gray-100 text-gray-600"
          x-model="selectedKode" readonly />
      </div>
    </template>

    <!-- Satuan Barang -->
    <template x-if="selectedSatuan">
      <div class="flex flex-col mt-4">
        <label class="text-sm">Satuan Barang</label>
        <input type="text"
          class="px-4 py-3 mt-2 border border-neutral-300 rounded-full bg-gray-100 text-gray-600"
          x-model="selectedSatuan" readonly />
      </div>
    </template>

    <!-- Jumlah Barang -->
    <div class="flex flex-col mt-4" x-data="{ jumlah: 0 }">
      <label for="jumlah_barang" class="text-sm">Jumlah Barang</label>
      <div class="flex items-center gap-2 justify-between mt-2">
        <input type="number" id="jumlah_barang" name="jumlah_barang"
          x-model="jumlah"
          class="px-4 py-3 border border-neutral-300 rounded-full w-full"
          placeholder="Jumlah Barang" min="0">
        <div class="flex items-center gap-2 w-[50%]">
          <button type="button" @click="jumlah++">
            <img src="<?= base_url('assets/icons/stokwarung-icons-tambah-barang.svg') ?>" class="w-full" />
          </button>
          <button type="button" @click="if(jumlah > 0) jumlah--">
            <img src="<?= base_url('assets/icons/stokwarung-icons-kurang-barang.svg') ?>" class="w-full" />
          </button>
        </div>
      </div>
    </div>

    <!-- Stok Tersedia -->
    <template x-if="selectedStok">
      <div class="flex flex-col mt-4">
        <label class="text-sm">Stok Tersedia</label>
        <input type="text"
          class="px-4 py-3 mt-2 border border-neutral-300 rounded-full bg-gray-100 text-gray-600"
          x-model="selectedStok"
          readonly />
      </div>
    </template>



    <button type="submit"
      class="bg-[#679F6A] w-full py-4 rounded-full mt-10 text-center text-white font-semibold">
      Simpan
    </button>
    <div class="mb-20"></div>
  </form>
</div>

<script>
  function barangKeluarForm() {
    return {
      selectedBarangId: '',
      barangMap: <?= json_encode(array_column($barang, null, 'id')) ?>,
      get selectedKode() {
        return this.barangMap[this.selectedBarangId]?.kode_barang || '';
      },
      get selectedSatuan() {
        return this.barangMap[this.selectedBarangId]?.nama_satuan || '';
      },
      get selectedStok() {
        return this.barangMap[this.selectedBarangId]?.total_stok ?? '';
      }
    }
  }
</script>