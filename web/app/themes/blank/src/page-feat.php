<?php

/**
 * Template Name: Feat
 */
?>

<?php get_header(); ?>

<main class="default feat">
  <?php if (have_posts()) :
    while (have_posts()) :
      the_post(); ?>
      <section>
        <div class="container">
          <header class="feat_header page_header">
            <h2 class="title">
              <?= get_field('title_header') ?>
            </h2>
            <p class="title_content">
              <?= get_field('content_header') ?>
            </p>
          </header> 
          <div class="features">
            <?php if (have_rows('features')) :

              // Loop through rows.
              while (have_rows('features')) :
                the_row();

                // Load sub field value.
                $img_feature = get_sub_field('img_feature');
                $title_feature = get_sub_field('title_feature');
                $content_feature = get_sub_field('content_feature');
                // Do something, but make sure you escape the value if outputting directly... 
            ?>
                <div class="feature">
                  <div class="feature_img">
                    <img src="<?= $img_feature ?>">
                  </div>
                  <h3 class="feature_title">
                    <?= $title_feature ?>
                  </h3>
                  <p class="feature_content">
                    <?= $content_feature ?>
                  </p>
                </div>

            <?php // End loop.
              endwhile;

            // No value.
            else :
            // Do something...
            endif; ?>
          </div>
        </div>
      </section>
      <section class="bg_blue">
        <div class="container">
          <div class="add_ons_container">
            <h2 class="title">
              <?= get_field('title_add-ons') ?>
            </h2>
            <p class="title_content">
              <?= get_field('content_add-ons') ?>
            </p>
          </div>
          <div class="add_ons">
            <?php if (have_rows('add-ons')) :

              // Loop through rows.
              while (have_rows('add-ons')) :
                the_row();

                // Load sub field value.
                $title_add_on = get_sub_field('title_add-on');
                $content_add_on = get_sub_field('content_add-on');
                $price_add_on = get_sub_field('price_add-on');
                // Do something, but make sure you escape the value if outputting directly... 
            ?>
                <div class="add_on">
                  <div class="add_on_top">

                    <p class="add_on_title">
                      <?= $title_add_on ?>
                    </p>
                    <p class="add_on_content">
                      <?= $content_add_on ?>
                    </p>
                  </div>
                  <p class="add_on_price">
                    <?= $price_add_on ?>
                  </p>
                </div>

            <?php // End loop.
              endwhile;

            // No value.
            else :
            // Do something...
            endif; ?>
          </div>
        </div>
      </section>
      <section>
        <div class="container">
          <div class="free_trial_container">
            <h2 class="free_trial_title">
              <?= get_field('tilte_free_trial') ?>
            </h2>
            <p class="free_trial_content">
              <?= get_field('content_free_trial') ?>
            </p>
            <div class="free_trial_button">
              <?= get_field('bouton_free_trial') ?>
            </div>
          </div>
        </div>
      </section>
      <section class="bg_blue">
        <div class="container container_qualities">
          <div class="qualities">

            <?php if (have_rows('qualities')) :

              // Loop through rows.
              while (have_rows('qualities')) :
                the_row();

                // Load sub field value.
                $img_quality = get_sub_field('img_quality');
                $title_quality = get_sub_field('title_quality');
                // Do something, but make sure you escape the value if outputting directly... 
            ?>
                <div class="quality">
                  <div class="quality_img">
                    <img src="<?= get_template_directory_uri() ?>/images/check.svg" alt="" width="30" height="30">
                  </div>
                  <div class="quality_title">
                    <p>
                      <?= $title_quality ?>
                    </p>
                  </div>
                </div>

            <?php // End loop.
              endwhile;

            // No value.
            else :
            // Do something...
            endif; ?>
          </div>
      </section>
      <section>
        <div class="container bottom_container">
          <img class="bottom_img" src="<?= get_field('bottom_img') ?>">
        </div>
      </section>
    <?php endwhile; ?>
  <?php else : ?>
    </div>


  <?php endif; ?>

</main>

<?php get_footer(); ?>