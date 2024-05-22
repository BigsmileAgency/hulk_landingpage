<?php

/**
 * Template Name: Cancel
 */
?>

<?php get_header(); ?>

<main class="default">
  <?php include get_template_directory() . '/components/functions/cancel_demo_by_mail.php'; ?>
  <!-- <?php get_template_part('components/home/header', null, array(
          'test' => 'coucou'
        )); ?> -->

  <!-- <?php var_dump($appointement); ?> -->

  <section class="cancel">
    <div class="container page_header cancel_container">
      <?php if(isset($appointement)) : ?>        
        <h3>Hey <?= $appointement->first_name ?> <?= $appointement->last_name ?></h3>
        <p>- Formulaire annulation de RDV -</p>
        <p>Le <?= $appointement->date ?> à <?= $what_time->time ?></p>
        <p>Si vous êtes absolument sur de vouloir annuler ce RDV cliquez ici : </p>
        <button id="cancel_appointement_from_mail" class="button">ANNULATION</button>
      <?php else :?>
        <p><?= $response ?></p>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>