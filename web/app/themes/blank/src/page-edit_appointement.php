<?php

/**
 * Template Name: Edit Appointement
 */

?>

<?php get_header(); ?>

<main class="default">

  <?php include get_template_directory() . '/components/functions/edit_demo_from_mail.php'; ?>

  <section class="edit">
    <div class="container page_header edit_container">
      <?php if (empty($response)) : ?>

        <?php if ($_GET['what'] == "cancel") : ?>

          <h3>Hey <?= $appointement->first_name ?> <?= $appointement->last_name ?></h3>
          <p>- Formulaire annulation de RDV -</p>
          <p>Le <?= $appointement->date ?> à <?= $what_time->time ?></p>
          <p>Si vous êtes absolument sur de vouloir annuler ce RDV cliquez ici : </p>
          <button id="cancel_appointement_from_mail" class="button">ANNULATION</button>

        <?php elseif ($_GET['what'] == "update") : ?>

          <h3>Hey <?= $appointement->first_name ?> <?= $appointement->last_name ?></h3>
          <p>- Formulaire de modification de RDV -</p>
          <p class="update_date_display">Le <span id="update_date"><?= $appointement->date ?></span> à <span id="update_time"><?= $what_time->time ?></span></p>
          <p>Si vous êtes absolument sur de vouloir modifier ce RDV cliquez ici : </p>

          <div class="form_and_calendar">
            <form id="update_form" class="update_grid">

              <div class="form_grid">

                <div class="form_item">
                  <label for="first_name_update">First Name</label>
                  <input type="text" name="first_name_update" id="first_name_update" value="<?= $appointement->first_name; ?>">
                  <div class="response"></div>
                </div>

                <div class="form_item">
                  <label for="last_name_update">Last Name</label>
                  <input type="text" name="last_name_update" id="last_name_update" value="<?= $appointement->last_name; ?>">
                  <div class="response"></div>
                </div>

                <div class="form_item">
                  <label for="email_update">Email</label>
                  <input type="email" name="email_update" id="email_update" value="<?= $appointement->email ?>">
                  <div class="response"></div>
                </div>

                <div class="form_item">
                  <label for="phone_update">Phone Number</label>
                  <input type="tel" name="phone_update" id="phone_update" value="<?= $appointement->phone ?>">
                  <div class="response"></div>
                </div>

                <div class="form_item">
                  <label for="company_update">Company Name</label>
                  <input type="text" name="company_update" id="company_update" value="<?= $appointement->company ?>">
                  <div class="response"></div>
                </div>

                <div class="form_item">
                  <label for="update_agency"><?= __('Are you an agency?', 'hulkBanner') ?></label><br>
                  <div id="agency_container">
                    <div class="tabs update_agency">
                      <input type="radio" name="update_agency" id="no" value="0" checked>
                      <label class="tab" for="no"><?= __('No', 'hulkBanner') ?></label>
                      <input type="radio" name="update_agency" id="yes" value="1">
                      <label class="tab" for="yes"><?= __('Yes', 'hulkBanner') ?></label>
                      <span class="glider"></span>
                    </div>
                  </div>
                </div>

                <div class="form_item">
                  <label for="lang_update">Langue</label>
                  <select name="lang_update" id="lang_update">
                    <option value="en">English</option>
                    <option value="fr">French</option>
                    <option value="nl">Nederlands</option>
                  </select>
                  <div class="response"></div>
                </div>

              </div>
            </form>

            <div class="calendar_container update_grid">
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