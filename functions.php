<?php

// Security
defined('ABSPATH') || exit;

$wpst_includes = array(
  '/setup.php',                           // Theme setup.
  '/enqueue.php',                         // Enqueue scripts and styles.
  '/acf.php',                             // Advanced Custom Fields functions.
  '/class-wp-bootstrap-navwalker.php',    // Custom navwalker for Bootstrap.
  '/cf7.php',                             // Contact Form 7 custom functions.
  '/pagination.php',                      // Pagination.
);

foreach ($wpst_includes as $file) {
  require_once get_template_directory() . '/inc' . $file;
}
