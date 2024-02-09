<?php
/**
 * Template Name: Pricing
 */
?>

<?php get_header(); ?>

<main class="default pricing">
  <?php if (have_posts()):
    while (have_posts()):
      the_post(); ?>
      <section>
        <div class="container container_pricing">
          <div class="pricing_header">
            <h1 class="title">
              <?= get_field('main_title') ?>
            </h1>
            <p class="title_content">
              <?= get_field('main_title_content') ?>
            </p>
          </div>
          <div class="tabs_container">
            <div class="tabs">
              <input type="radio" name="tabs" id="monthly" onchange="showContent('monthly_price')" checked>
              <label class="tab" for="monthly">Monthly billing</label>

              <input type="radio" name="tabs" id="annual" onchange="showContent('annual_price')">
              <label class="tab" for="annual">Annual billing</label>

              <span class="glider"></span>
            </div>
          </div>
          <div class="billing_options">
            <div class="billing_option">
              <?php $small = get_field('billing_small') ?>
              <h3 class="bold">
                <?= $small['billing_title'] ?>
              </h3>
              <div class="small_inside_container">
                <div class="price bold">
                  <div class="monthly_price">
                    <?= $small['price_monthly'] ?>
                  </div>
                  <div class="hidden annual_price">
                    <?= $small['price_annual'] ?>
                  </div>
                </div>
                <div class="info">
                  <?= $small['billing_info1'] ?>
                </div>
                <div class="info">
                  <?= $small['billing_info2'] ?>
                </div>
                <div class="info">
                  <?= $small['billing_info3'] ?>
                </div>
                <div class="billing_button">
                  <?= $small['button_billing'] ?>
                </div>
                <div class="see_more"><a href="#">
                    <?= $small['see_more'] ?>
                  </a></div>
              </div>
            </div>
            <div class="billing_option medium">
              <?php $medium = get_field('billing_medium') ?>
              <h3 class="bold">
                <?= $medium['billing_title'] ?>
              </h3>
              <div class="small_inside_container">
                <div class="price bold">
                  <div class="monthly_price">
                    <?= $medium['price_monthly'] ?>
                  </div>
                  <div class="hidden annual_price">
                    <?= $medium['price_annual'] ?>
                  </div>

                </div>
                <div class="info">
                  <?= $medium['billing_info1'] ?>
                </div>
                <div class="info">
                  <?= $medium['billing_info2'] ?>
                </div>
                <div class="info">
                  <?= $medium['billing_info3'] ?>
                </div>
                <div class="billing_button">
                  <?= $medium['button_billing'] ?>
                </div>
                <div class="see_more"><a href="#">
                    <?= $medium['see_more'] ?>
                  </a></div>
              </div>
            </div>
            <div class="billing_option ">
              <?php $large = get_field('billing_large') ?>
              <h3 class="bold">
                <?= $large['billing_title'] ?>
              </h3>
              <div class="small_inside_container">
                <div class="price bold">
                  <div class="monthly_price">
                    <?= $large['price_monthly'] ?>
                  </div>
                  <div class="hidden annual_price">
                    <?= $large['price_annual'] ?>
                  </div>
                </div>
                <div class="info">
                  <?= $large['billing_info1'] ?>
                </div>
                <div class="info">
                  <?= $large['billing_info2'] ?>
                </div>
                <div class="info">
                  <?= $large['billing_info3'] ?>
                </div>
                <div class="billing_button">
                  <?= $large['button_billing'] ?>
                </div>
                <div class="see_more"><a href="#">
                    <?= $large['see_more'] ?>
                  </a></div>
              </div>
            </div>
          </div>
          <div class="info_plans">
            <?= get_field('info_plans') ?>
          </div>
        </div>
      </section>
      <section class="bg_blue">
        <div class="container faq_container">
          <div class="faq_header">
            <h1 class="title">
              <?= get_field('faq_title') ?>
            </h1>
            <p class="title_content">
              <?= get_field('faq_title_content') ?>
            </p>
          </div>
          <div class="questions">
            <?php if (have_rows('questions')):

              // Loop through rows.
              while (have_rows('questions')):
                the_row();

                // Load sub field value.
                $title_question = get_sub_field('title_question');
                $content_question = get_sub_field('content_question');
                // Do something, but make sure you escape the value if outputting directly... ?>
                <div class="question">
                  <div class="title_question bold">
                    <?= $title_question ?>
                  </div>
                  <div class="content_question">
                    <?= $content_question ?>
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
      </section>
      <section>
        <div class="container compare_container">
          <div class="compare_header">
            <h1 class="title">
              <?= get_field('compare_title') ?>
            </h1>
            <p class="title_content">
              <?= get_field('compare_title_content') ?>
            </p>
          </div>
          <div class="columns_title">
            <div class="column">
               
            </div>
            <div class="column">
              <div class="title_column bold">
                <div class="title_small title_desktop"><?= get_field('title_small') ?></div>
                <div class="hidden title_small_mobile title_mobile"><?= get_field('title_small_mobile') ?></div>
              </div>
              <div class="free_trial_button">
                <?= get_field('free_trial_button') ?>
              </div>
            </div>
            <div class="column">
              <div class="title_column bold">
              <div class="title_medium title_desktop"><?= get_field('title_medium') ?></div>
                <div class="hidden title_medium_mobile title_mobile"><?= get_field('title_medium_mobile') ?></div>
              </div>
              <div class="free_trial_button">
                <?= get_field('free_trial_button') ?>
              </div>
            </div>
            <div class="column">
              <div class="title_column bold">
              <div class="title_large title_desktop"><?= get_field('title_large') ?></div>
                <div class="hidden title_large_mobile title_mobile"><?= get_field('title_large_mobile') ?></div>
              </div>
              <div class="free_trial_button">
                <?= get_field('free_trial_button') ?>
              </div>
            </div>
          </div>
          <div class="plans_table">
            <?php if (have_rows('plans_table')):

              // Loop through rows.
              while (have_rows('plans_table')):
                the_row();

                // Load sub field value.
                $table_title = get_sub_field('table_title');
                // Do something, but make sure you escape the value if outputting directly... ?>
                <div class="table">
                  <div class="titre_table bold">
                    <?= $table_title ?>
                  </div>
                  <?php if (have_rows('table_row')):
                    // Loop through rows.
                    while (have_rows('table_row')):
                      the_row();
                      $row_title = get_sub_field('row_title');
                      $small_row = get_sub_field('small_row');
                      $medium_row = get_sub_field('medium_row');
                      $large_row = get_sub_field('large_row');
                      ?>
                      <div class="table_row">
                        <div class="row_title row bold">
                          <?= $row_title ?>
                        </div>
                        <div class="small_row row">
                          <?php
                          if ($small_row === "true") { ?>
                            <img class="true_icon" src="<?php echo get_template_directory_uri() ?>/images/icon_true.png">
                          <?php } else if ($small_row === "false") { ?>
                              <img class="false_icon" src="<?php echo get_template_directory_uri() ?>/images/icon_false.png">
                          <?php } else { ?>
                              <script>
                                // Utilisation de JavaScript pour vérifier la largeur de l'écran
                                if (window.innerWidth < 480 && "<?= $small_row ?>" === "Unlimited") {
                                  document.write('<img class="false_icon" src="<?php echo get_template_directory_uri() ?>/images/infinity.png">');
                                } else {
                                  document.write("<?php echo $small_row; ?>");
                                }
                              </script>
                          <?php
                          }
                          ?>
                        </div>
                        <div class="medium_row row">
                          <?php
                          if ($medium_row === "true") { ?>
                            <img class="true_icon" src="<?php echo get_template_directory_uri() ?>/images/icon_true.png">
                          <?php } else if ($medium_row === "false") { ?>
                              <img class="false_icon" src="<?php echo get_template_directory_uri() ?>/images/icon_false.png">
                          <?php } else { ?>
                              <script>
                                // Utilisation de JavaScript pour vérifier la largeur de l'écran
                                if (window.innerWidth < 480 && "<?= $medium_row ?>" === "Unlimited") {
                                  document.write('<img class="false_icon" src="<?php echo get_template_directory_uri() ?>/images/infinity.png">');
                                } else {
                                  document.write("<?php echo $medium_row; ?>");
                                }
                              </script>
                          <?php } ?>
                        </div>
                        <div class="large_row row">
                          <?php
                          if ($large_row === "true") { ?>
                            <img class="true_icon" src="<?php echo get_template_directory_uri() ?>/images/icon_true.png">
                          <?php } else if ($large_row === "false") { ?>
                              <img class="false_icon" src="<?php echo get_template_directory_uri() ?>/images/icon_false.png">
                          <?php } else { ?>
                              <script>
                                // Utilisation de JavaScript pour vérifier la largeur de l'écran
                                if (window.innerWidth < 480 && "<?= $large_row ?>" === "Unlimited") {
                                  document.write('<img class="false_icon" src="<?php echo get_template_directory_uri() ?>/images/infinity.png">');
                                } else {
                                  document.write("<?php echo $large_row; ?>");
                                }
                              </script>
                          <?php
                          } ?>
                        </div>
                      </div>

                    <?php endwhile;
                  endif; ?>

                </div>

              <?php // End loop.
              endwhile;

              // No value.
            else:
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
        </div>
      </section>



    <?php endwhile; ?>
  <?php else: ?>
    <!-- fin contenu page -->
    <article>
      <div class="inner large">
        <div class="default__content">
          <h1>
            <?php _e('Oups, rien à montrer.', 'bsa'); ?>
          </h1>
        </div>
      </div>
    </article>
  <?php endif; ?>

</main>
<script>
  function showContent(contentId) {
    // Masquer tous les contenus
    var allContents = document.querySelectorAll('.price div');
    allContents.forEach(function (content) {
      content.style.display = 'none';
    });

    // Afficher le contenu sélectionné
    var elements = document.querySelectorAll('.' + contentId);
    elements.forEach(function (content) {
      content.style.display = 'block';
    });
  }
  if(window.innerWidth < 480) {

    var title_mobile = document.querySelectorAll('.title_mobile');
    var title_desktop = document.querySelectorAll('.title_desktop');
    title_mobile.forEach(function (content) {
      content.style.display = 'block';
    });
    title_desktop.forEach(function (content) {
      content.style.display = 'none';
    });

    
  }
</script>
<?php get_footer(); ?>