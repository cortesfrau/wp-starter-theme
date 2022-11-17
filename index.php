<?php

// Security
defined('ABSPATH') || exit;

// Site Header
get_header();

?>


<section class="wrapper">
  <div class="container">
    <div class="row g-3">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="col-md-6 col-lg-4 col-xl-3">
          <h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
        </div>

      <?php endwhile; wp_reset_postdata(); endif; ?>

    </div>

  </div>
</section>

<?php

// Site Footer
get_footer();
