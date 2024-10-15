<?php

/**
 * Template Name: Faq
 */
?>

<?php get_header(); ?>

<main class="default faq">
  <?php if (have_posts()) :
    while (have_posts()) :
      the_post(); ?>
      <section class="bg_blue">
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

            <?php 
              endwhile;
            else :
            ?>  
              <div class="question">
              <h3 class="title_question bold">
                <?= __('Oops, something went wrong', 'hulkbanner') ?>
              </h3>
              <p class="content_question">
                <?= "" ?>
              </p>
            </div>

            <?php endif; ?>
          </div>
        </div>
      </section>
    <?php endwhile; ?>
  <?php else : ?>
  <?php endif; ?>
</main>

<?php get_footer(); ?>