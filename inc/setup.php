<?php

// Security
defined('ABSPATH') || exit;


//-------------------------//
//--- Thumbnail Support ---//
//-------------------------//
add_theme_support('post-thumbnails');


//---------------------//
//--- Title Support ---//
//---------------------//
add_theme_support('title-tag');


//-----------------------------//
//--- Archive Titles Prefix ---//
//-----------------------------//
add_filter('get_the_archive_title_prefix', '__return_false');


//--------------------------//
//--- Custom Image Sizes ---//
//--------------------------//
add_image_size('landscape-small', 380, 260, true);
add_image_size('landscape-medium', 720, 500, true);
add_image_size('square-medium', 720, 720, true);
add_image_size('panoramic', 1920, 1080, true);


//--------------------------//
//--- Register Nav Menus ---//
//--------------------------//
register_nav_menus(array(
  'primary' => __('Primary Menu', 'wpst'),
  'secondary' => __('Secondary Menu', 'wpst'),
));


//------------------------//
//--- Add Logo Support ---//
//------------------------//
function wpst_custom_logo_setup() {
  $defaults = array(
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array('site-title', 'site-description'),
    'unlink-homepage-logo' => true,
  );
  add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'wpst_custom_logo_setup' );


//-------------------------------//
//--- Customizer Extra Fields ---//
//-------------------------------//
add_action('customize_register', 'wpst_customize_register');
function wpst_customize_register($wp_customize) {

  // Custom Logo (Desktop)
  $wp_customize->add_setting('wpst_theme_options[logo_desktop]', array(
    'default'     => '',
    'capability'  => 'edit_theme_options',
    'type'        => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'logo_desktop', array(
    'label'    => __('Logotipo en desktop', 'wpst'),
    'section'  => 'title_tagline',
    'settings' => 'wpst_theme_options[logo_desktop]',
  )));

  // Footer Logo
  $wp_customize->add_setting('wpst_theme_options[logo_footer]', array(
    'default'     => '',
    'capability'  => 'edit_theme_options',
    'type'        => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'logo_footer', array(
    'label'    => __('Logotipo en footer', 'wpst'),
    'section'  => 'title_tagline',
    'settings' => 'wpst_theme_options[logo_footer]',
    'flex_width'  => true, // Allow any width, making the specified value recommended. False by default.
    'flex_height' => false, // Require the resulting image to be exactly as tall as the height attribute (default).
    'width'       => 400,
    'height'      => 150,
  )));
}
