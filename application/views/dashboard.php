<div class="py-8">
  <div class="flex items-center justify-between w-full px-4">
    <div class="font-medium text-2xl ">
      <h1>Halo, <br><span><?= $salam ?>!</span></h1>

    </div>
    <a href="<?= base_url('notification') ?>" class="bg-[#81C784] p-2 rounded-full">
      <img src="<?= base_url('assets/icons/stokwarung-icons-notification.svg') ?>" alt="notification-icons">
    </a>
  </div>
  <img src="<?= base_url('assets/images/stokwarung-images-dashboard.svg') ?>" alt="dashboard-images" class="">

  <div class="w-full mt-3 bg-white px-4 py-4 min-h-[600px]">
    <!-- title -->
    <div class="flex items-center justify-between">
      <div class="flex gap-1 flex-col">
        <h1 class="font-bold text-2xl">DASHBOARD</h1>
        <p class="text-sm text-[#757575]">Cek
          Lagi Persediaan kamu, yuk !</p>
      </div>
      <a href="<?= base_url('laporan-stok') ?>" class="text-sm text-[#679F6A] font-semibold">Lihat Semua</a>
    </div>
    <div class="flex items-start flex-col w-full rounded-lg" x-data="dashboardSearch()" x-init="initBarang()">

      <!-- search -->
      <div class="flex items-center mt-5 w-full">
        <div class="flex items-center gap-2 px-4 py-4 border border-[#DBDBDB] rounded-full w-full">
          <img src="<?= base_url('assets/icons/stokwarung-icons-search.svg') ?>" alt="search-icons">
          <input
            type="text"
            placeholder="Cari barangmu..."
            class="outline-none border-none w-full"
            x-model="searchQuery">

        </div>
        <!-- <div class="flex items-center justify-center p-5 rounded-full border border-[#DBDBDB]">
        <img src="<?= base_url('assets/icons/stokwarung-icons-filter.svg') ?>" alt="filter-icons">
      </div> -->
      </div>

      <!-- card -->


      <!-- Pesan jika tidak ada hasil pencarian -->
      <div x-show="filteredBarang().length === 0 && searchQuery !== ''" class="text-sm text-neutral-500 mt-6">
        Tidak ada barang yang cocok dengan pencarian.
      </div>

      <!-- Menampilkan kartu produk -->
      <template x-for="row in filteredBarangRows()" :key="row[0].id">
        <div class="flex gap-6 mt-8">
          <template x-for="item in row" :key="item.id">
            <div class="relative">
              <div class="absolute top-2 left-2 w-40 h-40 rounded-lg z-0" :class="shadowClass(item.total_stok)"></div>
              <div class="relative rounded-lg" :style="'background-color: ' + bgColor(item.total_stok)">
                <div class="text-white p-6 rounded-2xl w-40 h-40 z-10">
                  <div class="text-3xl font-bold" x-text="item.total_stok + ' pcs'"></div>
                  <div class="mt-1 font-semibold" x-text="item.nama_barang"></div>
                  <a
                    class="text-sm mt-2 underline underline-offset-2"
                    :href="'<?= base_url('barang/edit/') ?>' + item.id">
                    Detail &gt;
                  </a>
                </div>
              </div>
            </div>
          </template>
        </div>
      </template>
    </div>
  </div>


  <script>
    function dashboardSearch() {
      return {
        searchQuery: '',
        barang: <?= json_encode($barang) ?>,

        filteredBarang() {
          const keyword = this.searchQuery.toLowerCase();
          return this.barang.filter(b => {
            return b.nama_barang.toLowerCase().includes(keyword);
          });
        },

        filteredBarangRows() {
          const filtered = this.filteredBarang();
          const rows = [];
          for (let i = 0; i < filtered.length; i += 2) {
            rows.push(filtered.slice(i, i + 2));
          }
          return rows;
        },

        bgColor(stok) {
          if (stok == 0) return '#F44336'; // merah
          if (stok <= 5) return '#FFBF00'; // kuning
          return '#4CAF50'; // hijau
        },

        shadowClass(stok) {
          if (stok == 0) return 'bg-[#F44336]/10';
          if (stok <= 5) return 'bg-yellow-100';
          return 'bg-[#4CAF50]/10';
        }
      };
    }
  </script>