<?php

/**
 * Template Name: Home
 */
?>

<?php get_header(); ?>

<main class="home">

	<section class=" hero_1" style="background-image: url(<?= get_field('bg_img') ?>);">
  <div class="container">
    <h1><?= get_field('catchphrase') ?></h1>
    <h3><?= get_field('sub_catchphrase') ?></h3>
    <div class="grid_btn_2">
      <button class="trial_btn"><a href="http://hulk-landing.local/login/"><?= get_field('trial_btn') ?></a></button>
      <button class="demo_btn"><a href="http://hulk-landing.local/demo/"><?= get_field('demo_btn') ?></a></button>
    </div>
  </div>
  </section>

  <?php $hero2 = get_field('hero_2'); ?>
  <section class="hero_2">
    <div class="container">
      <div class="hero_2_box">
        <div class="left_box">
          <h2><?= $hero2['catchphrase'] ?></h2>
          <p><?= $hero2['sub_catchphrase'] ?></p>
          <button class="hollow_trial_btn"><a href="http://hulk-landing.local/demo/"><?= $hero2['btn_trial'] ?></a></button>
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
                <button class="feat_btn"><a href="http://hulk-landing.local/feat/"><?= $btn ?></a></button>
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
        <div class="left_box">
          <h2><?= $hero3['catchphrase'] ?></h2>
          <p><?= $hero3['sub_catchphrase'] ?></p>
          <button class="hollow_trial_btn"><a href="http://hulk-landing.local/demo/"><?= $hero3['btn_trial'] ?></a></button>
        </div>
        <img src="<?= $hero3['img_hero3'] ?>" alt="">
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>