<?php
  $args = array(
    'showposts' => 1,
    'post_type' => 'videos',
    'order' => 'DESC',
);
  $query = new WP_Query ($args);

  while ($query->have_posts()) : $query->the_post();

  $titulo  = get_post_meta( $post->ID, 'input_videos_titulo', true );
  $duracao = get_post_meta( $post->ID, 'input_videos_duracao', true );
  $link    = get_permalink();
?>

<section id="last-post">
  <div class="wrap-banner">
    <div class="box-options">
      <p class="categoria"><?php echo the_title(); ?></p>
      <p><?php echo $duracao; ?></p>
    </div>
    <div class="box-title">
      <h1><?php echo $titulo; ?></h1>
    </div>
    <div class="box-link">
      <a href="<?php echo $link; ?>">Assistir</a>
    </div>
  </div>
</section>
<?php endwhile; ?>

<section class="categories">
  <div class="box-title">
    <h2>Filmes</h2>
  </div>
  <div class="owl-carousel owl-theme">
    <?php
      $args = array(
        'showposts' => -1,
        'post_type' => 'videos',
        'order' => 'DESC',
        'tax_query' => array(
            array(
            'taxonomy' => 'categoria_videos',
            'field' => 'slug',
            'terms' => 'filmes',
        )
      )
    );
      $query = new WP_Query ($args);

      while ($query->have_posts()) : $query->the_post();

      $titulo  = get_post_meta( $post->ID, 'input_videos_titulo', true );
      $duracao = get_post_meta( $post->ID, 'input_videos_duracao', true );
      $capa    = get_the_post_thumbnail_url(get_the_ID(),'full');
      $link    = get_permalink();
    ?>
    <div class="item">
      <a href="<?php echo $link; ?>">
        <img src="<?php echo $capa; ?>" alt="<?php echo $titulo; ?>">
        <p class="time"><?php echo $duracao; ?></p>
        <p><?php echo $titulo; ?></p>
      </a>
    </div>
    <?php endwhile; ?>
  </div>
</section>

<section class="categories">
  <div class="box-title">
    <h2>Documentários</h2>
  </div>
  <div class="owl-carousel owl-theme">
    <?php
      $args = array(
        'showposts' => -1,
        'post_type' => 'videos',
        'order' => 'DESC',
        'tax_query' => array(
            array(
            'taxonomy' => 'categoria_videos',
            'field' => 'slug',
            'terms' => 'documentarios',
        )
      )
    );
      $query = new WP_Query ($args);

      while ($query->have_posts()) : $query->the_post();

      $titulo  = get_post_meta( $post->ID, 'input_videos_titulo', true );
      $duracao = get_post_meta( $post->ID, 'input_videos_duracao', true );
      $capa    = get_the_post_thumbnail_url(get_the_ID(),'full');
      $link    = get_permalink();
    ?>
    <div class="item">
      <a href="<?php echo $link; ?>">
        <img src="<?php echo $capa; ?>" alt="<?php echo $titulo; ?>">
        <p class="time"><?php echo $duracao; ?></p>
        <p><?php echo $titulo; ?></p>
      </a>
    </div>
    <?php endwhile; ?>
  </div>
  </div>
</section>

<section class="categories">
  <div class="box-title">
    <h2>Séries</h2>
  </div>
  <div class="owl-carousel owl-theme">
    <?php
      $args = array(
        'showposts' => -1,
        'post_type' => 'videos',
        'order' => 'DESC',
        'tax_query' => array(
            array(
            'taxonomy' => 'categoria_videos',
            'field' => 'slug',
            'terms' => 'filmes',
        )
      )
    );
      $query = new WP_Query ($args);

      while ($query->have_posts()) : $query->the_post();

      $titulo  = get_post_meta( $post->ID, 'input_videos_titulo', true );
      $duracao = get_post_meta( $post->ID, 'input_videos_duracao', true );
      $capa    = get_the_post_thumbnail_url(get_the_ID(),'full');
      $link    = get_permalink();
    ?>
    <div class="item">
      <a href="<?php echo $link; ?>">
        <img src="<?php echo $capa; ?>" alt="<?php echo $titulo; ?>">
        <p class="time"><?php echo $duracao; ?></p>
        <p><?php echo $titulo; ?></p>
      </a>
    </div>
    <?php endwhile; ?>
  </div>
  </div>
</section>
