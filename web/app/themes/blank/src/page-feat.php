<?php
/**
 * Template Name: Feat
 */
?>

<?php get_header(); ?>

<main class="default feat">
  <?php if (have_posts()):
    while (have_posts()):
      the_post(); ?>

      <header class="feat_header container">
        <h1 class="title">
          <?= get_field('title_header') ?>
        </h1>
        <p class="title_content">
          <?= get_field('content_header') ?>
        </p>
      </header>
      <div class="features">
        <?php if (have_rows('features')):

          // Loop through rows.
          while (have_rows('features')):
            the_row();

            // Load sub field value.
            $img_feature = get_sub_field('img_feature');
            $title_feature = get_sub_field('title_feature');
            $content_feature = get_sub_field('content_feature');
            // Do something, but make sure you escape the value if outputting directly... ?>
            <div class="feature">
              <div class="feature_img">
                <img src="<?= $img_feature ?>" width="375" height="250">
              </div>
              <div class="feature_title">
                <?= $title_feature ?>
              </div>
              <div class="feature_content">
                <?= $content_feature ?>
              </div>
            </div>

          <?php // End loop.
          endwhile;

          // No value.
        else:
          // Do something...
        endif; ?>
      </div>
      <section>
        <div class="add_ons_container">
          <h1 class="title">
            <?= get_field('title_add-ons') ?>
          </h1>
          <p class="title_content">
            <?= get_field('content_add-ons') ?>
          </p>
        </div>
        <div class="add_ons">
          <?php if (have_rows('add-ons')):

            // Loop through rows.
            while (have_rows('add-ons')):
              the_row();

              // Load sub field value.
              $title_add_on = get_sub_field('title_add-on');
              $content_add_on = get_sub_field('content_add-on');
              $price_add_on = get_sub_field('price_add-on');
              // Do something, but make sure you escape the value if outputting directly... ?>
              <div class="add_on">
                <div class="add_on_top">

                  <div class="add_on_title">
                    <?= $title_add_on ?>
                  </div>
                  <div class="add_on_content">
                    <?= $content_add_on ?>
                  </div>
                </div>
                <div class="add_on_price">
                  <?= $price_add_on ?>
                </div>
              </div>

            <?php // End loop.
            endwhile;

            // No value.
          else:
            // Do something...
          endif; ?>
        </div>
        </div>
        <div class="free_trial_container container">
          <h1 class="free_trial_title">
            <?= get_field('tilte_free_trial') ?>
          </h1>
          <p class="free_trial_content">
            <?= get_field('content_free_trial') ?>
          </p>
          <div class="free_trial_button">
            <?= get_field('bouton_free_trial') ?>
          </div>
        </div>
        <div class="qualities">

          <?php if (have_rows('qualities')):

            // Loop through rows.
            while (have_rows('qualities')):
              the_row();

              // Load sub field value.
              $img_quality = get_sub_field('img_quality');
              $title_quality = get_sub_field('title_quality');
              // Do something, but make sure you escape the value if outputting directly... ?>
              <div class="quality">
                <div class="quality_img">
                  <img src="<?= $img_quality ?>" width="30" height="30">
                </div>
                <div class="quality_title">
                  <?= $title_quality ?>
                </div>
              </div>

            <?php // End loop.
            endwhile;

            // No value.
          else:
            // Do something...
          endif; ?>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
    </section>

  <?php endif; ?>

</main>

<?php get_footer(); ?>