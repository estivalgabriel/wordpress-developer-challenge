<nav class="menu-mobile">
  <ul>
    <li>
      <a href="<?php echo home_url(); ?>/filmes">
        <img src="<?php echo get_template_directory_uri(); ?>/public/assets/img/icon-1.svg" alt="">
        <p>Filmes</p>
      </a>
    </li>
    <li>
      <a href="<?php echo home_url(); ?>/documentarios">
        <img src="<?php echo get_template_directory_uri(); ?>/public/assets/img/icon-2.svg" alt="">
        <p>Documentários</p>
      </a>
    </li>
    <li>
      <a href="<?php echo home_url(); ?>/series">
        <img src="<?php echo get_template_directory_uri(); ?>/public/assets/img/icon-3.svg" alt="">
        <p>Séries</p>
      </a>
    </li>
  </ul>
</nav>

<footer>
  <div class="wrap-info">
    <div class="box-img">
      <a href="<?php echo home_url(); ?>/">
        <img src="<?php echo get_template_directory_uri(); ?>/public/assets/img/logo.svg" alt="Play">
      </a>
    </div>
    <div class="box-text">
      <p>© 2021 — Play — Todos os direitos reservados.</p>
    </div>
  </div>
</footer>


</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {

    $('.owl-carousel').owlCarousel({
      loop:false,
      autoWidth:true,
      margin:30,
      nav: true,
      responsive: {
        0: {
          items: 2
        },
        600: {
          items: 2
        },
        1000: {
          items: 4
        }
      }
    });

  });

</script>

</html>
