<?php

// Security
defined('ABSPATH') || exit;

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header id="site-header">
  <nav class="navbar navbar-expand-xl bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header-menu" aria-controls="header-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <?php wp_nav_menu(array(
        'theme_location' => 'primary',
        'container_class' => 'collapse navbar-collapse',
        'container_id' => 'header-menu',
        'menu_class' => 'navbar-nav ms-auto',
        'walker' => new bootstrap_5_wp_nav_menu_walker(),
      )); ?>

    </div>
  </nav>
</header>

<!-- Site Main (This tag is closed in footer.php) -->
<main id="site-main">
