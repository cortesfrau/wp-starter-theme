<?php

// Security
defined('ABSPATH') || exit;

// ACF Options page
if (function_exists('acf_add_options_page')) {
  $args = [
    'position'    => '2.666',
    'page_title' 	=> 'Opciones',
    'menu_title' 	=> 'Opciones',
    'menu_slug' 	=> 'theme-options',
    'capability' 	=> 'edit_posts',
    'redirect' 	  => false
  ];
  acf_add_options_page($args);
}
