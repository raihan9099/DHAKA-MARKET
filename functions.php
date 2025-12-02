<?php
// Theme setup
add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form','comment-form','gallery','caption']);
  load_theme_textdomain('dhaka-market', get_template_directory() . '/languages');
  register_nav_menus([
    'primary' => __('Primary Menu', 'dhaka-market'),
    'footer'  => __('Footer Menu', 'dhaka-market'),
  ]);
});

// Enqueue assets
add_action('wp_enqueue_scripts', function () {
  $ver = wp_get_theme()->get('Version');
  wp_enqueue_style('dm-style', get_template_directory_uri() . '/assets/dist/style.css', [], $ver);
  wp_enqueue_script('dm-app', get_template_directory_uri() . '/assets/dist/app.js', ['jquery'], $ver, true);
});
