<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('random_color')) {
  function random_color()
  {
    $colors = ['#4CAF50', '#FFC107', '#EF5350', '#42A5F5', '#E040FB'];
    return $colors[array_rand($colors)];
  }
}
