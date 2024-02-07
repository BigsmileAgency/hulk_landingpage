<?php 
  /**
  * Template Name: Feat
  */
?>

<?php get_header(); ?>

<main class="default">
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>

  <header class="header">
    <h1 class="title"><?= get_field('title_header') ?></h1>
    <p class="title_content"><?= get_field('content_header') ?></p>      
  </header>
  <div class="features">
    <?php if( have_rows('features') ):

  // Loop through rows.
  while( have_rows('features') ) : the_row();

      // Load sub field value.
      $img_feature = get_sub_field('img_feature');
      $title_feature = get_sub_field('title_feature');
      $content_feature = get_sub_field('content_feature'); 
      // Do something, but make sure you escape the value if outputting directly... ?>
      <div class="feature">
        <div class="feature_img">
          <img src="<?=$img_feature?>" width="375">
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
  else :
  // Do something...
  endif; ?>
  </div>
  <?php endwhile; ?>
  <?php else: ?>
    <article>
      <div class="inner large">
        <div class="default__content">
          <h1><?php _e('Oups, rien à montrer.', 'bsa'); ?></h1>
        </div>
      </div>
    </article>
  <?php endif; ?>

</main>

<?php get_footer(); ?>
