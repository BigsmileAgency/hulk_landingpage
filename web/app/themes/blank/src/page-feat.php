<?php 
  /**
  * Template Name: Feat
  */
?>

<?php get_header(); ?>

<main class="default">
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>

  <?php get_template_part('components/home/header', null, array(
      'test' => 'coucou'
    )); ?>

     <section class="center page">
      <div class="inner">
        
      <h2><?= the_title() ?></h2>
        <div class="content">
          <?php the_content(); ?>
        </div>
      </div>
    </section>

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
