<?php

/**
 * Template Name: Home
 */
?>

<?php
$upload_dir = wp_upload_dir();
get_header();
?>


<main class="default home">

  <section class="hero_1" style="background-image: url(<?= get_field('bg_img') ?>);">
    <div class="container page_header">
      <div class="hero_left">
        <h1><?= get_field('catchphrase') ?></h1>
        <h3><?= get_field('sub_catchphrase') ?></h3>
        <div class="grid_btn_2">
          <button class="trial_btn"><a href="<?php echo get_home_url() . '/login'; ?>"><?= get_field('trial_btn') ?></a></button>
          <button class="demo_btn"><a href="<?php echo get_home_url() . '/demo'; ?>"><?= get_field('demo_btn') ?></a></button>
        </div>
      </div>
      <!-- video secion -->
      <div class="video">
        <iframe id="vimeo_video" src="https://player.vimeo.com/video/682956628?mute=1" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  </section>


  <!-- AUTO PLAY VIDEO WHEN SCROLL INTO VIEW -->
  <!-- <script src="https://player.vimeo.com/api/player.js"></script>
  <script>
    // Sélectionne l'iframe Vimeo avec son ID
    const iframe = document.querySelector('#vimeo_video');
    const player = new Vimeo.Player(iframe);
    player.setVolume(0);

    // Fonction pour vérifier si l'élément est visible dans la fenêtre du navigateur
    function isElementInViewport(el) {
      const rect = el.getBoundingClientRect();
      return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
      );
    }

    // Fonction pour démarrer la vidéo lorsque visible
    function playVideoOnScroll() {
      if (isElementInViewport(iframe)) {
        player.play().catch(function(error) {
          console.error("Erreur lors de la lecture de la vidéo : ", error);
        });
      }
    }

    // Écoute l'événement de scroll et de resize
    window.addEventListener('scroll', playVideoOnScroll);
    window.addEventListener('resize', playVideoOnScroll);

    // Lancer la vérification de visibilité au chargement de la page
    document.addEventListener('DOMContentLoaded', playVideoOnScroll);

    function playVideoOnScroll() {
      if (isElementInViewport(iframe)) {
        player.play().catch(function(error) {
          console.error("Erreur lors de la lecture de la vidéo : ", error);
        });
      } else {
        player.pause().catch(function(error) {
          console.error("Erreur lors de la pause de la vidéo : ", error);
        });
      }
    }
  </script> -->
  <!-- video secion end -->

  <?php $hero2 = get_field('hero_2'); ?>
  <section class="hero_2">
    <div class="container">
      <h2><?= $hero2['catchphrase'] ?></h2>
      <div class="hero_2_box">
        <div class="left_box">
          <?php
          $list = $hero2["hero_2_list"];
          foreach ($list as $item):
          ?>
            <div class="hero_list">
              <div class="picto_bubble">
                <img src="<?= $item["list_img"]["url"]  ?>" alt="" class="picto">
              </div>
              <p><?= $item["list_txt"] ?></p>
            </div>
          <?php
          endforeach;
          ?>

        </div>
        <button class="hero_btn"><a href="<?php echo get_home_url() . '/demo'; ?>"><?= $hero2['btn_trial'] ?></a></button>
        <!-- <img src="<?= $hero2['img_hero2'] ?>" alt=""> -->
      </div>
    </div>
  </section>

  <!-- OLD FEATs 02/24 -->
  <section class="feats_section">
    <div class="container">
      <h2><?= get_field('feats_diplay_title') ?></h2>
      <div class="feats_display_container">
        <?php
        if (have_rows("feat_display")) :
          while (have_rows("feat_display")) : the_row();
            $title = get_sub_field('feat_title');
            $img = get_sub_field('feat_img');
            $btn = get_sub_field('feat_btn');
        ?>
            <div class="feat_container">
              <div class="img_shadow"></div>
              <img src="<?= $img ?>" class="computer" alt="computers decorating">
              <div class="side_grid">
                <h3><?= $title ?></h3>
                <div class="feat_list">
                  <ul>
                    <?php if (have_rows("feat_list")) :
                      while (have_rows("feat_list")) : the_row();
                        $item = get_sub_field('feat_item');
                    ?>
                        <li class="feat_item"><?= $item ?></li>
                    <?php endwhile;
                    endif; ?>
                  </ul>
                </div>
              </div>
            </div>
            <?php endwhile;
        endif; ?>
      </div>
      <!-- <button class="feat_btn"><a href="<?php echo get_home_url() . '/feat'; ?>"><?= $btn ?></a></button> -->
    </div>
  </section>

  <?php $cta_block_1 = get_field('cta_block_1'); ?>
  <section class="cta_block" id="cta_block_1">
    <div class="container">
      <div class="cta_block_box">
        <h2><?= $cta_block_1['title']; ?></h2>
        <p><?= $cta_block_1['content']; ?></p>
        <a href="<?php echo get_home_url() . '/feat'; ?>"><button class="full_btn"><?= $cta_block_1['btn']; ?></button></a>
      </div>
    </div>
  </section>


  <!-- NEW FEATS TEST 09/24-->
  <section class="feats_section">
    <div class="container">
      <h2>An <span class="main-color">easy tool to use</span> and to configurate!</h2>
      <div class="feat_container_bis">

        <div class="feats_left feats_box">
          <p class="title"><?= __('YOUR AGENCY', 'hulkbanner') ?></p>
          <div class="feats_line">
            <p class="bold"><?= __('UPLOAD', 'hulkbanner') ?></p>
            <p><?= __('your banner', 'hulkbanner') ?></p>
          </div>
          <div class="feats_line">
            <p class="bold"><?= __('SHARE', 'hulkbanner') ?></p>
            <p><?= __('with your client', 'hulkbanner') ?></p>
          </div>
          <div class="feats_line">
            <p class="bold"><?= __('RECEIVE', 'hulkbanner') ?></p>
            <p><?= __('notifications', 'hulkbanner') ?></p>
          </div>
        </div>

        <div class="desktop_block">
          <img src="<?= $upload_dir['baseurl'] ?>/2024/09/desktop.png" alt="">
        </div>

        <div class="feats_right feats_box">
          <p class="title"><?= __('YOUR CLIENT', 'hulkbanner') ?></p>
          <div class="feats_line">
            <p class="bold"><?= __('PREVIEW', 'hulkbanner') ?></p>
            <p><?= __('your ads', 'hulkbanner') ?></p>
          </div>
          <div class="feats_line">
            <p class="bold"><?= __('COMMENT', 'hulkbanner') ?></p>
            <p><?= __('or validate', 'hulkbanner') ?></p>
          </div>
          <div class="feats_line">
            <p class="bold"><?= __('DOWNLOAD', 'hulkbanner') ?></p>
            <p><?= __('banners or ads', 'hulkbanner') ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php $cta_block_2 = get_field('cta_block_2'); ?>
  <section class="cta_block">
    <div class="container">
      <div class="cta_block_box">
        <h2><?= $cta_block_2['title']; ?></h2>
        <p><?= $cta_block_2['content']; ?></p>
        <a href="<?php echo get_home_url() . '/pricing'; ?>"><button class="full_btn"><?= $cta_block_2['btn']; ?></button></a>
      </div>
    </div>
  </section>

  <!-- <section class="hero_4">
    <div class="container">
      <div class="hero_4_box">
        <div class="left_box">
          <h2><?= $hero3['catchphrase'] ?></h2>
          <p><?= $hero3['sub_catchphrase'] ?></p>
          <button class="hero_btn"><a href="<?php echo get_home_url() . '/demo'; ?>"><?= __('Book a demo call', 'hulkbanner') ?></a></button>
        </div>
        <img src="<?= $hero3['img_hero3'] ?>" alt="">
      </div>
    </div>
  </section> -->
</main>



<?php get_footer(); ?>