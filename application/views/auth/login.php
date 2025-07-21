<div class="px-6">
  <!-- Header -->
  <div class="flex flex-col items-center justify-center gap-2 mt-5">
    <h1 class="text-5xl font-bold text-center">StokWarung</h1>
    <p class="text-sm text-gray-600 mb-4 text-center">Stok lancar, dagangan aman. Register dulu yuk!</p>
  </div>

  <!-- Main Content -->
  <div class="flex flex-col items-center justify-center">
    <img src="<?= base_url('assets/images/stokwarung-images-login.svg') ?>" alt="">
  </div>

  <!-- Contoh komponen alert -->
  <?php if (!empty($error)) $this->load->view('components/alert', ['message' => $error]); ?>

  <!-- login form -->
  <form action="<?= site_url('login') ?>" method="post" class="space-y-4">
    <div>
      <input type="text" name="email" class="w-full border rounded-full border-gray-300 px-6 bg-transparent py-4 rounded" placeholder="Email" required>
    </div>
    <div>
      <input type="password" name="password" class="w-full border rounded-full border-gray-300 px-6 bg-transparent py-4 rounded" placeholder="Password" required>
    </div>

    <a href="#" class="text-sm text-gray-600 text-end block">Lupa Kata Sandi?</a>
    <div class="flex flex-col items-center gap-4">
      <button type="submit" class="w-full bg-[#4CAF50] text-white py-2 rounded px-6 py-4 rounded-full mt-4">
        Masuk
      </button>
      <p class="text-sm">Belum punya akun? 
        <a href="<?= base_url('register') ?>" class="text-sm font-semibold"> Daftar Sekarang</a></p>
    </div>
  </form>
</div>