<!-- File: application/views/components/alert.php -->
<div
  x-data="{ show: true }"
  x-show="show"
  x-transition
  class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
  role="alert"
>
  <strong class="font-bold">Error!</strong>
  <span class="block sm:inline"><?= $message ?></span>
  <span
    @click="show = false"
    class="absolute -top-5 bottom-0 -right-3 px-4 py-3 cursor-pointer text-red-700 text-2xl"
  >
    &times;
  </span>
</div>
