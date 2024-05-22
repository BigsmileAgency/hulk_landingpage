<?php

/**
 * Template Name: Edit Appointement
 */

?>

<?php get_header(); ?>

<main class="default">
  <?php include get_template_directory() . '/components/functions/edit_demo_from_mail.php'; ?>
  <!-- <?php get_template_part('components/home/header', null, array(
          'test' => 'coucou'
        )); ?> -->

  <!-- <?php var_dump($appointement); ?> -->

  <section class="cancel">
    <div class="container page_header cancel_container">

      <?php if (isset($appointement)) : ?>
        <?php if ($_GET['what'] == "cancel") : ?>

          <h3>Hey <?= $appointement->first_name ?> <?= $appointement->last_name ?></h3>
          <p>- Formulaire annulation de RDV -</p>
          <p>Le <?= $appointement->date ?> à <?= $what_time->time ?></p>
          <p>Si vous êtes absolument sur de vouloir annuler ce RDV cliquez ici : </p>
          <button id="cancel_appointement_from_mail" class="button">ANNULATION</button>

        <?php elseif ($_GET['what'] == "update") : ?>

          <h3>Hey <?= $appointement->first_name ?> <?= $appointement->last_name ?></h3>
          <p>- Formulaire de modification de RDV -</p>
          <p>Le <?= $appointement->date ?> à <?= $what_time->time ?></p>
          <p>Si vous êtes absolument sur de vouloir modifier ce RDV cliquez ici : </p>

          <div class="form_and_calendar">
            <div class="calendar_container demo_grid" style="display: block;">
              <div class="form_header">
                <h3>Change la date</h3>
              </div>
              <?php get_template_part('./components/layouts/calendar') ?>
              <button id="update_appointement_from_mail">MODIFIER</button>
            </div>
          </div>
        <?php endif; ?>

      <?php else : ?>
        <p><?= $response ?></p>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>