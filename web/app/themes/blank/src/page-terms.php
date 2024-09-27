<?php

/**
 * Template Name: Terms
 */
?>

<?php get_header(); ?>

<main class="default terms">
  <section class="terms_container">
    <div class="container">
      <div class="term_container">
      <h4><?= get_field('terms_title'); ?></h4>  
      <?php 
      if(have_rows("term")): 
        while (have_rows("term")) : the_row();
        ?>
        <div class="term">
          <p class="term_title"><?= get_sub_field("term_title")?></p>

          <?php 
          if(have_rows("term_content")): 
            while (have_rows("term_content")) : the_row();
          ?>
            <p class="term_content"><?= get_sub_field("term_txt") ?></p>
          <?php
            endwhile;
          endif;
          ?>
        </div>
      <?php
        endwhile;
      endif;
      ?>
      </div>
    </div>
  </section>
</main>


<?php get_footer(); ?>
