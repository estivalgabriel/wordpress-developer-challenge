<header>
  <div class="menu">
    <div class="logo">
      <a href="<?php echo home_url(); ?>/">
        <img src="<?php echo get_template_directory_uri(); ?>/public/assets/img/logo.svg" alt="Play">
      </a>
    </div>
    <?php
    wp_nav_menu( array(
        'theme_location' => 'my-custom-menu',
        'container_class' => 'custom-menu-class' ) );
    ?>
  </div>
</header>
