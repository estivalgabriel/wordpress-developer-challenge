<?php
  if( have_posts() ):
    while( have_posts() ): the_post(); ?>

    <?php
      $titulo    = get_post_meta( $post->ID, 'input_videos_titulo', true );
      $descricao = get_post_meta( $post->ID, 'input_videos_descricao', true );
      $duracao   = get_post_meta( $post->ID, 'input_videos_duracao', true );
      $embed     = get_post_meta( $post->ID, 'input_videos_embed', true );
    ?>

    <section id="detalhes">
      <div class="wrap-content">
        <div class="box-options">
          <ul>
            <li>
              <span><?php echo the_title(); ?></span>
            </li>
            <li>
              <p><?php echo $duracao; ?></p>
            </li>
          </ul>
          <h3><?php echo $titulo; ?></h3>
        </div>
        <div class="box-video">
          <?php echo $embed; ?>
        </div>
        <div class="box-text">
          <p><?php echo $descricao; ?></p>
        </div>
      </div>
    </section>

<?php
  endwhile;
  endif;
?>
