<?php

// Security
defined('ABSPATH') || exit;

if (!function_exists('wpst_pagination')) {

  function wpst_pagination($args = array(), $class = 'pagination') {

    if (!isset($args['total']) && $GLOBALS['wp_query']->max_num_pages <= 1) {
      return;
    }

    $args = wp_parse_args($args,
      array(
        'mid_size'           => 2,
        'prev_next'          => true,
        'prev_text'          => __('&laquo;', 'wpst'),
        'next_text'          => __('&raquo;', 'wpst'),
        'type'               => 'array',
        'current'            => max( 1, get_query_var('paged')),
        'screen_reader_text' => __('Paginación de entradas', 'wpst'),
      )
    );

    $links = paginate_links($args);
    if (!$links) {
      return;
    } ?>

    <nav aria-labelledby="posts-nav-label">
      <ul class="<?php echo esc_attr($class); ?>">
        <?php foreach ($links as $key => $link) { ?>
          <li class="page-item <?php echo strpos($link, 'current') ? 'active' : ''; ?>">
            <?php echo str_replace('page-numbers', 'page-link', $link); ?>
          </li>
        <?php } ?>
      </ul>
    </nav>

  <?php }
}
