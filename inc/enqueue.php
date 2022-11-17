<?php

// Security
defined('ABSPATH') || exit;

//-------------------------------//
//--- Public Scripts & Styles ---//
//-------------------------------//
add_action('wp_enqueue_scripts', 'wpst_public_scripts_and_styles');
function wpst_public_scripts_and_styles() {

  $directories = [
    $dirCSS = new DirectoryIterator(get_stylesheet_directory() . '/dist/css'),
    $dirJS = new DirectoryIterator(get_stylesheet_directory() . '/dist/js'),
  ];

  foreach ($directories as $directory) {
    foreach ($directory as $file) {

      $fullName = basename($file);
      $name = substr(basename($fullName), 0, strpos(basename($fullName), '.'));
      $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

      // Enqueues
      switch ($fileExtension) {
        case 'css' :
          $deps = null;
          if ($name != 'admin') {
            wp_enqueue_style($name, get_template_directory_uri() . '/dist/css/' . $fullName, $deps, null);
          }
          break;
        case 'js' :
          $deps = ['jquery'];
          wp_enqueue_script($name, get_template_directory_uri() . '/dist/js/' . $fullName, $deps, null, true);
          break;
      }
    }
  }
}


//------------------------------//
//--- Admin Styles & Scripts ---//
//------------------------------//
add_action('admin_enqueue_scripts', 'wpst_admin_scripts_and_styles');
function wpst_admin_scripts_and_styles() {

  $directories = [
    $dirCSS = new DirectoryIterator(get_stylesheet_directory() . '/dist/css'),
    $dirJS = new DirectoryIterator(get_stylesheet_directory() . '/dist/js'),
  ];

  foreach ($directories as $directory) {
    foreach ($directory as $file) {

      $fullName = basename($file);
      $name = substr(basename($fullName), 0, strpos(basename($fullName), '.'));
      $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

      // Enqueues
      switch ($fileExtension) {
        case 'css' :
          $deps = null;
          if ($name == 'admin') {
            wp_enqueue_style($name, get_template_directory_uri() . '/dist/css/' . $fullName, $deps, null);
          }
          break;
        case 'js' :
          $deps = ['jquery'];
          if ($name == 'admin') {
            wp_enqueue_script($name, get_template_directory_uri() . '/dist/js/' . $fullName, $deps, null, true);
          }
          break;
      }
    }
  }
}
