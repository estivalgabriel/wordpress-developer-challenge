<?php

add_theme_support('post-thumbnails');

// funções gerais do tema
include_once(get_template_directory().'/app/system/global-functions.php');

// carrega todos os custom post type do tema
include_once(get_template_directory().'/app/admin/load.php');


// css do painel administrativo
function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/app/admin/style/style_admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

// adiciona o menu
function wp_custom_new_menu() {
  register_nav_menu('my-custom-menu',__( 'Menu Principal' ));
}
add_action( 'init', 'wp_custom_new_menu' );


?>
