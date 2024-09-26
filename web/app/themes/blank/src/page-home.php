<?php

/**
 * Template Name: Home
 */
?>

<?php get_header(); ?>

<main class="default home">

  <section class="hero_1" style="background-image: url(<?= get_field('bg_img') ?>);">
    <div class="container page_header">
      <h1><?= get_field('catchphrase') ?></h1>
      <h3><?= get_field('sub_catchphrase') ?></h3>
      <div class="grid_btn_2">
        <button class="trial_btn"><a href="<?php echo get_home_url() . '/login'; ?>"><?= get_field('trial_btn') ?></a></button>
        <button class="demo_btn"><a href="<?php echo get_home_url() . '/demo'; ?>"><?= get_field('demo_btn') ?></a></button>
      </div>
    </div>
  </section>

  <?php $hero2 = get_field('hero_2'); ?>
  <section class="hero_2">
    <div class="container">
      <div class="hero_2_box">
        <div class="left_box">
          <h2><?= $hero2['catchphrase'] ?></h2>
          <!-- <p><?= $hero2['sub_catchphrase'] ?></p> -->
          <?php 
          $list = $hero2["hero_2_list"];
          var_dump($list[0]["list_img"]['url']);
          // if(have_rows($list)): 
          //   while(have_rows($list)): the_row();
          //     echo get_sub_field($list["list_img"]);
          //     echo get_sub_field($list["list_txt"]);
          //   endwhile;
          // endif;
          ?>

          <button class="hero_btn"><a href="<?php echo get_home_url() . '/demo'; ?>"><?= $hero2['btn_trial'] ?></a></button>
        </div>
        <img src="<?= $hero2['img_hero2'] ?>" alt="">
      </div>
    </div>
  </section>

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
              <img src="<?= $img ?>" alt="">
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
                <button class="feat_btn"><a href="<?php echo get_home_url() . '/feat'; ?>"><?= $btn ?></a></button>
              </div>
            </div>
        <?php endwhile;
        endif; ?>
      </div>
    </div>
  </section>

  <?php $hero3 = get_field('hero_3'); ?>
  <section class="hero_3">
    <div class="container">
      <div class="hero_3_box">
        <h2>Lorem ipsum <span class="main-color"> dolor sit </span>amet.</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris malesuada nulla eget ipsum pretium molestie. Cras lobortis dui non volutpat posuere. Mauris lacinia neque sed nisl aliquam dapibus.</p>
        <button class="full_btn"><a href="#"><?= $hero3['btn_trial'] ?></a></button>
      </div>
    </div>
  </section>
  <section class="hero_4">
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
  </section>
</main>

<?php get_footer(); ?>