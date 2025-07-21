<div class="px-4 py-8">
  <a href="<?= base_url('dashboard') ?>" class="flex items-center gap-2">
    <img src="<?= base_url('assets/icons/stokwarung-icons-arrow.svg') ?>" alt="arrow-icons">
    <h1 class="text-2xl">Notifikasi</h1>


  </a>

  <!-- notification content -->
  <div class="flex flex-col gap-7 mt-10">
  <?php foreach ($notifikasi as $n): ?>
    <?php
      $color = '#4CAF50';
      $icon = base_url('assets/icons/stokwarung-icons-aman-notification.svg');
      if (stripos($n->title, 'Habis') !== false) {
        $color = '#F44336';
        $icon = base_url('assets/icons/stokwarung-icons-habis-notification.svg');
      } elseif (stripos($n->title, 'Menipis') !== false) {
        $color = '#FFBF00';
        $icon = base_url('assets/icons/stokwarung-icons-menipis-notification.svg');
      }
    ?>
    <div class="flex items-center gap-2">
      <img src="<?= $icon ?>" alt="notifikasi">
      <div class="flex items-start justify-between w-full">
        <div>
          <p class="font-semibold" style="color: <?= $color ?>"><?= $n->title ?></p>
          <p class="text-sm"><?= $n->isi ?></p>
        </div>
        <p class="text-[12px] text-neutral-500">
          <?= time_elapsed_string($n->created_at) ?>
        </p>
      </div>
    </div>
  <?php endforeach; ?>
</div>

</div>