<div class="px-4 py-8">
  <div class="flex items-center justify-between gap-2">
    <div>
      <h1 class="font-bold text-2xl">Histori Stok</h1>
      <p class="text-sm text-neutral-600 mt-1">Pantau pergerakan stok <br>harian tanpa ribet.</p>
    </div>
    <div class="flex items-center gap-2">
      <img src="<?= base_url('assets/icons/stokwarung-icons-download-pdf.svg') ?>" alt="download-pdf">
      <img src="<?= base_url('assets/icons/stokwarung-icons-download-excel.svg') ?>" alt="download-excel">
    </div>
  </div>

  <!-- Card Barang Masuk -->
  <div class="mt-6">
    <h3 class="text-sm font-semibold text-neutral-600 mb-3">Barang Masuk (Incoming Stock)</h3>
    <div class="bg-white p-4 rounded-xl">
      <table class="w-full text-sm text-left">
        <thead>
          <tr class="text-black font-normal">
            <th class="px-4 py-2 font-normal">Nama Barang</th>
            <th class="px-4 py-2 font-normal">Jumlah Barang</th>
            <th class="px-4 py-2 font-normal">Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($barangMasuk as $b): ?>
            <tr class="text-neutral-600">
              <td class="px-4 py-2"><?= $b->nama_barang ?></td>
              <td class="px-4 py-2 font-medium">+<?= $b->jumlah ?></td>
              <td class="px-4 py-2">
                <?php
                if ($b->total_stok == 0) {
                  $status = ['label' => 'Habis', 'bg' => '#F44336'];
                } elseif ($b->total_stok <= 5) {
                  $status = ['label' => 'Menipis', 'bg' => '#FFBF00'];
                } else {
                  $status = ['label' => 'Aman', 'bg' => '#4CAF50'];
                }
                ?>
                <span class="bg-[<?= $status['bg'] ?>]/20 text-[<?= $status['bg'] ?>] text-xs font-semibold px-3 py-1 rounded-full inline-block text-center">
                  <?= $status['label'] ?>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>

      </table>
    </div>
  </div>

  <!-- Card Barang Keluar -->
  <div class="mt-4">
    <h3 class="text-sm font-semibold text-neutral-600 mb-3">Barang Keluar (Ongoing Stock)</h3>
    <div class="bg-white p-4 rounded-xl">
      <table class="w-full text-sm text-left">
        <thead>
          <tr class="text-black font-normal">
            <th class="px-4 py-2 font-normal">Nama Barang</th>
            <th class="px-4 py-2 font-normal">Jumlah Barang</th>
            <th class="px-4 py-2 font-normal">Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($barangKeluar as $b): ?>
            <tr class="text-neutral-600">
              <td class="px-4 py-2"><?= $b->nama_barang ?></td>
              <td class="px-4 py-2 font-medium">-<?= $b->jumlah ?></td>
              <td class="px-4 py-2">
                <?php
                if ($b->total_stok == 0) {
                  $status = ['label' => 'Habis', 'bg' => '#F44336'];
                } elseif ($b->total_stok <= 5) {
                  $status = ['label' => 'Menipis', 'bg' => '#FFBF00'];
                } else {
                  $status = ['label' => 'Aman', 'bg' => '#4CAF50'];
                }
                ?>
                <span class="bg-[<?= $status['bg'] ?>]/20 text-[<?= $status['bg'] ?>] text-xs font-semibold px-3 py-1 rounded-full inline-block text-center">
                  <?= $status['label'] ?>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>

      </table>
    </div>
  </div>
</div>