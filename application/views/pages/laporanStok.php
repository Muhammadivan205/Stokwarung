<?php
$warnaBarang = [];
foreach ($barang as $b) {
  $warnaBarang[$b->id] = random_color();
}
?>


<div class="px-4 py-8">
  <div class="flex items-center justify-between gap-2">
    <div>
      <h1 class="font-bold text-2xl">Laporan Stok</h1>
      <p class="text-sm text-neutral-600 mt-1">Pantau stok barangmu secara <br>harian atau mingguan.</p>
    </div>
    <div class="flex items-center gap-2">
      <img src="<?= base_url('assets/icons/stokwarung-icons-download-pdf.svg') ?>" alt="download-pdf">
      <img src="<?= base_url('assets/icons/stokwarung-icons-download-excel.svg') ?>" alt="download-excel">
    </div>
  </div>

  <!-- Donut Chart -->
  <div class="bg-white rounded-xl p-4 mt-6">
    <h2 class="text-lg font-semibold mb-2">Total Stok Barang</h2>
    <div class="flex flex-row items-center justify-start -mt-[20%] -mb-[20%]">
      <canvas id="stokChart" class="max-w-[140px] "></canvas>
      <ul class="text-sm space-y-2 ml-4 ">
        <?php foreach ($barang as $b): ?>
          <li>
            <span class="inline-block w-3 h-3 rounded-full mr-2"
              style="background-color: <?= $warnaBarang[$b->id] ?>"></span>
            <?= $b->nama_barang ?> – <?= $b->total_stok ?> <?= $b->satuan ?>
          </li>
        <?php endforeach; ?>

      </ul>
    </div>
  </div>

  <!-- Daftar Barang -->
  <div class="mt-6">
    <h3 class="text-sm font-semibold text-neutral-600 mb-3">Daftar Barang</h3>
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
          <?php foreach ($barang as $b): ?>
            <tr class="text-neutral-600">
              <td class="px-4 py-2"><?= $b->nama_barang ?></td>
              <td class="px-4 py-2 font-medium"><?= $b->total_stok ?></td>
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



<script>
  const ctx = document.getElementById('stokChart').getContext('2d');
  const stokChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: <?= json_encode(array_column($barang, 'nama_barang')) ?>,
      datasets: [{
        label: 'Total Stok',
        data: <?= json_encode(array_column($barang, 'total_stok')) ?>,
        backgroundColor: <?= json_encode(array_values($warnaBarang)) ?>,
        borderWidth: 2,
        cutout: '60%'
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });
</script>