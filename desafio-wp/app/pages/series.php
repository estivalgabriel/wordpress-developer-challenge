<?php
$args = array(
      'showposts' => -1,
      'post_type' => 'videos',
      'order' => 'ASC',
      'tax_query' => array(
          array(
          'taxonomy' => 'categoria_videos',
          'field' => 'slug',
          'terms' => 'series',
      )
    )
  );
$query = new WP_Query ($args);

?>

<section id="lista">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="box-text">
          <h2><?php echo the_title(); ?></h2>
          <p><?php echo the_content(); ?></p>
        </div>
      </div>
      <div class="col-md-6">
        <nav>
          <ul>
            <?php
              while ($query->have_posts()) : $query->the_post();

              $titulo  = get_post_meta( $post->ID, 'input_videos_titulo', true );
              $duracao = get_post_meta( $post->ID, 'input_videos_duracao', true );
              $capa    = get_the_post_thumbnail_url(get_the_ID(),'full');
              $link    = get_permalink();
            ?>
            <li>
              <a href="<?php echo $link; ?>">
                <img src="<?php echo $capa; ?>" alt="<?php echo $titulo; ?>">
                <p><span><?php echo $duracao; ?></span></p>
                <p><?php echo $titulo; ?></p>
              </a>
            </li>
            <?php endwhile; ?>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</section>
