<?php

// Security
defined('ABSPATH') || exit;

// Site Header
get_header();

?>

<article class="wrapper">
  <div class="container">
    <h1><?php echo get_the_title(); ?></h1>
    <div class="the-content">
     <?php the_content(); ?>
   </div>
  </div>
</article>

<?php

// Site Footer
get_footer();
