<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($title) ? $title : 'Stok Warung' ?></title>

  <!-- PWA Manifest -->
  <link rel="manifest" href="<?= base_url('manifest.json') ?>">
  <meta name="theme-color" content="#4CAF50">

  <!-- Icons -->
  <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('icon-192.png') ?>">
  <link rel="apple-touch-icon" href="<?= base_url('icon-192.png') ?>">



  <!-- tailwind css configuration cdn -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- alpine js configuration cdn -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <!-- donut chart -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


  <!-- jakarta plus sans configuration -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">




  <!-- Service Worker Registration -->
  <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', function() {
        navigator.serviceWorker.register('<?= base_url('service-worker.js') ?>')
          .then(function(registration) {
            console.log('ServiceWorker registered with scope:', registration.scope);
          }).catch(function(error) {
            console.log('ServiceWorker registration failed:', error);
          });
      });
    }
  </script>
</head>

<body class="relative" style="font-family: 'Plus Jakarta Sans', sans-serif;">


  <div class="h-screen flex flex-col items-center justify-between w-full md:max-w-[900px] md:mx-auto">

    <?php
    $controller = $this->router->class;
    $bgClass = 'bg-[#F1F8E9]';

    if (in_array($controller, ['NotificationController', 'BarangMasukController', 'BarangKeluarController', 'BarangController'])) {
      $bgClass = 'bg-white';
    } elseif (in_array($controller, ['AturBarangController', 'HistoryController', 'LaporanController'])) {
      $bgClass = 'bg-yellow-100';
    }
    ?>



    <!-- Main Content -->
    <div class="w-full max-w-full md:max-w-sm min-h-screen md:h-screen rounded-lg  <?= $bgClass ?>">
      <?= $contents ?>
    </div>

    <!-- Footer -->
    <?php if (!in_array($this->router->class, ['AuthController', 'BarangMasukController', 'BarangKeluarController', 'BarangController'])): ?>
      <div class="fixed bottom-8 left-1/2 transform -translate-x-1/2 w-full max-w-xs z-50 flex items-center justify-center gap-3 px-4">
        <?php
        $controller = $this->router->class;

        $isDashboard = $controller === 'CommonController';
        $isHistory = $controller === 'HistoryController';
        $isLaporan = $controller === 'LaporanController';
        ?>

        <!-- Menu Navigasi -->
        <div class="bg-white shadow-md rounded-full py-4 px-8 w-full">
          <div class="flex items-center justify-between">
            <a href="<?= base_url('dashboard') ?>">
              <img src="<?= base_url('assets/icons/stokwarung-icons-dashboard-' . ($isDashboard ? 'active' : 'disable') . '.svg') ?>" alt="Dashboard">
            </a>
            <a href="<?= base_url('history-stok') ?>">
              <img src="<?= base_url('assets/icons/stokwarung-icons-history-' . ($isHistory ? 'active' : 'disable') . '.svg') ?>" alt="History">
            </a>
            <a href="<?= base_url('laporan-stok') ?>">
              <img src="<?= base_url('assets/icons/stokwarung-icons-laporan-' . ($isLaporan ? 'active' : 'disable') . '.svg') ?>" alt="Laporan">
            </a>

          </div>
        </div>

        <!-- Tombol Tambah -->
        <a href="<?= base_url('atur-stok') ?>" class="bg-white shadow-lg rounded-full p-4">
          <img src="<?= base_url('assets/icons/stokwarung-icons-manage.svg') ?>" alt="Add">
        </a>

      </div>

    <?php endif; ?>



  </div>

</body>

</html>