<?php

/**
 * Template Name: Pricing
 */
?>

<?php get_header(); ?>

<main class="default pricing">
  <?php if (have_posts()) :
    while (have_posts()) :
      the_post(); ?>
      <section>
        <div class="container container_pricing">
          <div class="pricing_header">
            <h1 class="title section_title">
              <?= get_field('main_title') ?>
            </h1>
            <p class="title_content bottom_p">
              <?= get_field('main_title_content') ?>
            </p>
          </div>
          <div class="tabs_container">
            <div class="annual_promo main-color bold">
              <p class="promo_text">Get 20% off</p>
              <img class="promo_arrow" src="<?php echo get_template_directory_uri() ?>/images/promo_arrow.svg">
            </div>
            <div class="tabs">
              <input type="radio" name="tabs" id="monthly" onchange="showContent('monthly_price')" checked>
              <label class="tab" for="monthly"><?= __('Monthly billing', 'hulkBanner') ?></label>

              <input type="radio" name="tabs" id="annual" onchange="showContent('annual_price')">
              <label class="tab" for="annual"><?= __('Annual billing', 'hulkBanner') ?></label>

              <span class="glider"></span>
            </div>
          </div>
          <div class="billing_options_container">
            <div class="billing_options">

              <div class="billing_option">
                <?php $small = get_field('billing_small') ?>
                <h3 class="bold">
                  <?= $small['billing_title'] ?>
                </h3>
                <div class="small_inside_container">
                  <div class="price bold main-color">
                    <div class="monthly_price">
                      <p>
                        <?= $small['price_monthly'] ?>
                      </p>
                    </div>
                    <div class="hidden annual_price">
                      <p>
                        <?= $small['price_annual'] ?>
                      </p>
                    </div>
                  </div>
                  <div class="infos">
                    <div class="info">
                      <p>
                        <?= $small['billing_info1'] ?>
                      </p>
                    </div>
                    <div class="info">
                      <p>
                        <?= $small['billing_info2'] ?>
                      </p>
                    </div>
                    <div class="info">
                      <p>
                        <?= $small['billing_info3'] ?>
                      </p>
                    </div>
                  </div>
                  <button class="billing_button">
                    <a href="#" target="_blank">
                      <?= $small['button_billing'] ?>
                    </a>
                  </button>

                  <div class="see_more main-color">
                    <a href="<?php echo get_home_url() . '/feat'; ?>">
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
                      <p>
                        <?= $medium['price_monthly'] ?>
                      </p>
                    </div>
                    <div class="hidden annual_price">
                      <p>
                        <?= $medium['price_annual'] ?>
                      </p>
                    </div>
                  </div>
                  <div class="infos">
                    <div class="info">
                      <p>
                        <?= $medium['billing_info1'] ?>
                      </p>
                    </div>
                    <div class="info">
                      <p>
                        <?= $medium['billing_info2'] ?>
                      </p>
                    </div>
                    <div class="info">
                      <p>
                        <?= $medium['billing_info3'] ?>
                      </p>
                    </div>
                  </div>
                  <button class="billing_button">
                    <a href="">
                      <?= $medium['button_billing'] ?>
                    </a>
                  </button>
                  <div class="see_more"><a href="<?php echo get_home_url() . '/feat'; ?>">
                      <?= $medium['see_more'] ?>
                    </a></div>
                </div>
              </div>

              <div class="billing_option">
                <?php $large = get_field('billing_large') ?>
                <h3 class="bold">
                  <?= $large['billing_title'] ?>
                </h3>
                <div class="small_inside_container">
                  <div class="price bold main-color">
                    <div class="monthly_price">
                      <p>
                        <?= $large['price_monthly'] ?>
                      </p>
                    </div>
                    <div class="hidden annual_price">
                      <p>
                        <?= $large['price_annual'] ?>
                      </p>
                    </div>
                  </div>
                  <div class="infos">
                    <div class="info">
                      <p>
                        <?= $large['billing_info1'] ?>
                      </p>
                    </div>
                    <div class="info">
                      <p>
                        <?= $large['billing_info2'] ?>
                      </p>
                    </div>
                    <div class="info">
                      <p>
                        <?= $large['billing_info3'] ?>
                      </p>
                    </div>
                  </div>
                  <button class="billing_button">
                    <a href="">
                      <?= $large['button_billing'] ?>
                    </a>
                  </button>
                  <div class="see_more main-color"><a href="<?php echo get_home_url() . '/feat'; ?>">
                      <?= $large['see_more'] ?>
                    </a></div>
                </div>
              </div>

            </div>

            <div class="swiper-pagination"></div>

            <!-- left/right arrows if needed / to style -->
            <!-- <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div> -->

          </div>
          <div class="info_plans">
            <p><?= get_field('info_plans') ?></p>
          </div>
        </div>
      </section>

      <!-- FAQ moved to FAQ page so far -->
      <!-- <section class="bg_blue">
        <div class="container faq_container">
          <div class="faq_header">
            <h2 class="title">
              <?= get_field('faq_title') ?>
            </h2>
            <p class="title_content margin_bottom">
              <?= get_field('faq_title_content') ?>
            </p>
          </div>
          <div class="questions">
            <?php if (have_rows('questions')) :

              // Loop through rows.
              while (have_rows('questions')) :
                the_row();

                // Load sub field value.
                $title_question = get_sub_field('title_question');
                $content_question = get_sub_field('content_question');
                // Do something, but make sure you escape the value if outputting directly... 
            ?>
                <div class="question">
                  <h3 class="title_question bold">
                    <?= $title_question ?>
                  </h3>
                  <p class="content_question">
                    <?= $content_question ?>
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
      </section> -->

      <section class="bg_blue">
        <div class="container">
          <div class="add_ons_box">
            <div class="add_ons_container">
              <h2 class="title">
                <?= get_field('title_add-ons') ?>
              </h2>
              <p class="title_content margin_bottom">
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
              endif; ?>
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="container compare_container">
          <div class="compare_header">
            <h2 class="title">
              <?= get_field('compare_title') ?>
            </h2>
            <p class="title_content bottom_p">
              <?= get_field('compare_title_content') ?>
            </p>
          </div>
          <div class="columns_title">
            <div class="column">
  
            </div>
            <div class="column">
              <div class="title_column bold">
                <div class="title_small title_desktop"><?= get_field('title_small') ?></div>
                <div class="title_small_mobile title_mobile"><?= get_field('title_small_mobile') ?></div>
              </div>
              <div class="free_trial_button">
                <?= get_field('free_trial_button') ?>
              </div>
            </div>
            <div class="column">
              <div class="title_column bold">
                <div class="title_medium title_desktop"><?= get_field('title_medium') ?></div>
                <div class="title_medium_mobile title_mobile"><?= get_field('title_medium_mobile') ?></div>
              </div>
              <div class="free_trial_button">
                <?= get_field('free_trial_button') ?>
              </div>
            </div>
            <div class="column">
              <div class="title_column bold">
                <div class="title_large title_desktop"><?= get_field('title_large') ?></div>
                <div class="title_large_mobile title_mobile"><?= get_field('title_large_mobile') ?></div>
              </div>
              <div class="free_trial_button">
                <?= get_field('free_trial_button') ?>
              </div>
            </div>
          </div>
          <div class="plans_table">
            <?php
            // !!! The value used in ACF field has to match the string displayed as 'unilimited' in the compare table so we can replace it by infinity sign on mobile
            $unlimited = get_field('unlimited_value');
            // !!! You hear?
            ?>
            <?php if (have_rows('plans_table')) :
  
              // Loop through rows.
              while (have_rows('plans_table')) :
                the_row();
  
                // Load sub field value.
                $table_title = get_sub_field('table_title');
                // Do something, but make sure you escape the value if outputting directly... 
            ?>
                <div class="table">
                  <div class="titre_table bold">
                    <?= $table_title ?>
                  </div>
                  <?php if (have_rows('table_row')) :
                    // Loop through rows.
                    while (have_rows('table_row')) :
                      the_row();
                      $row_title = get_sub_field('row_title');
                      $small_row = get_sub_field('small_row');
                      $medium_row = get_sub_field('medium_row');
                      $large_row = get_sub_field('large_row');
                  ?>
                      <div class="table_row">
                        <div class="row_title row ">
                          <p><?= $row_title ?></p>
                        </div>
  
                        <div class="small_row row">
                          <?php
                          if ($small_row === "true") { ?>
                            <img class="true_icon" src="<?php echo get_template_directory_uri() ?>/images/icon_true.svg">
                          <?php } else if ($small_row === "false") { ?>
                            <img class="false_icon" src="<?php echo get_template_directory_uri() ?>/images/icon_false.svg">
                          <?php } else if ($small_row == $unlimited) { ?>
                            <span class="unlimited"><?= $small_row ?></span>
                          <?php } else {
                            echo $small_row;
                          } ?>
                        </div>
  
                        <div class="medium_row row">
                          <?php
                          if ($medium_row === "true") { ?>
                            <img class="true_icon" src="<?php echo get_template_directory_uri() ?>/images/icon_true.svg">
                          <?php } else if ($medium_row === "false") { ?>
                            <img class="false_icon" src="<?php echo get_template_directory_uri() ?>/images/icon_false.svg">
                          <?php } else if ($medium_row == $unlimited) { ?>
                            <span class="unlimited"><?= $medium_row ?></span>
                          <?php } else {
                            echo $medium_row;
                          } ?>
                        </div>
  
                        <div class="large_row row">
                          <?php
                          if ($large_row === "true") { ?>
                            <img class="true_icon" src="<?php echo get_template_directory_uri() ?>/images/icon_true.svg">
                          <?php } else if ($large_row === "false") { ?>
                            <img class="false_icon" src="<?php echo get_template_directory_uri() ?>/images/icon_false.svg">
                          <?php } else if ($large_row == $unlimited) { ?>
                            <span class="unlimited"><?= $large_row ?></span>
                          <?php } else {
                            echo $large_row;
                          } ?>
                        </div>
                      </div>
                  <?php endwhile;
                  endif; ?>
                </div>
  
            <?php // End loop.
              endwhile;
            endif; ?>
          </div>
          <div class="mobile_button_container">
            <button class="free_trial_button">
              <?= get_field('free_trial_button') ?>
            </button>
          </div>
        </div>
      </section>

    <?php endwhile; ?>
    <?php else : ?>
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
  let swiper;
  function showContent(contentId) {
    // Masquer tous les contenus
    // Affiche le contenu si l'élément contient la classe du paramètre contentId
    const allContents = document.querySelectorAll('.price div');
    allContents.forEach(function(content) {
      content.style.display = 'none';
      if(content.classList.contains(contentId)){
        content.style.display = 'block';
      }
    });
  }


  function resizePrices(){
    const container = document.querySelector('.billing_options_container');
    const wrapper = document.querySelector('.billing_options');
    const elements = document.querySelectorAll('.billing_option');
    if (window.innerWidth < 992) {
      container.classList.add('swiper');
      wrapper.classList.add('swiper-wrapper');
      elements.forEach(e => {
        e.classList.add('swiper-slide')
      })
      if(!swiper){
        swiper = new Swiper('.swiper', {
          
          initialSlide: 1,
          direction: 'horizontal',
          centeredSlides: true,
          spaceBetween: 30,
    
          pagination: {
            el: '.swiper-pagination',
          },
    
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
    
          scrollbar: {
            el: '.swiper-scrollbar',
          },
        });
      }
    }else{
      container.classList.remove('swiper');
      wrapper.classList.remove('swiper-wrapper');
      elements.forEach(e => {
        e.classList.remove('swiper-slide')
      })
    }
  }

  resizePrices();

  window.addEventListener('resize',resizePrices)

</script>
<?php get_footer(); ?>