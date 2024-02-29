<?php

/**
 * Template Name: Demo
 */

// GET FIELDS FROM OPTION TAB : 
//  <?= get_field('time', 'Options') 
?>

<?php get_header(); ?>
<main class="demo">

  <div class="container">
    <section class="hero_demo">
      <h1><?= get_field("title") ?></h1>
      <p><?= get_field("explanation") ?></p>
    </section>
  </div>

  <section class="demo_section">
    <div class="container demo_container" >
      <div class="explanation_list">
        <h3><?= get_field("list_title") ?></h3>
        <ol>
          <?php if (have_rows("explanation_list")) :
            while (have_rows("explanation_list")) : the_row();
              $item = get_sub_field('explanation_item'); ?>
              <li><span class="black"><?= $item ?></span></li>
          <?php
            endwhile;
          endif;
          ?>
        </ol>
        <div class="icons_demo">
          <img src="<?= get_template_directory_uri() ?>/images/icones.svg" alt="">
        </div>
      </div>

      <!-- CONTACT FORM -->
      <?php $demo_form = get_field('demo_form') ?>
      
      <div class="form_and_calendar">       
        <p class="demo_response response"></p>
        <div class="demo_form_container">
          <div class="form_header">
            <h3><?= $demo_form['form_title'] ?></h3>
            <p><?= $demo_form['form_subtitle'] ?></p>
          </div>

          <form action="" method="POST" id="demo_form">
            <div id="form_grid">
              <div class="form_item">
                <label for="demo_first_name"><?= $demo_form['first_name'] ?></label><br>
                <input id="demo_first_name" type="text" name="demo_first_name">
              </div>

              <div class="form_item">
                <label for="demo_last_name"><?= $demo_form['last_name'] ?></label><br>
                <input id="demo_last_name" type="text" name="demo_last_name">
              </div>

              <div class="form_item">
                <label for="demo_email"><?= $demo_form['email'] ?></label><br>
                <input id="demo_email" type="text" name="demo_email">
              </div>

              <div class="form_item">
                <label for="demo_phone"><?= $demo_form['phone'] ?></label><br>
                <input id="demo_phone" type="text" name="demo_phone">
              </div>

              <div class="form_item">
                <label for="demo_company_name"><?= $demo_form['company_name'] ?></label><br>
                <input id="demo_company_name" type="text" name="demo_company_name">
              </div>

              <div class="form_item" id="agency_container">
                <label for="are_you_agency"><?= $demo_form['are_you_agency'] ?></label><br>
                <input id="are_you_agency" type="checkbox" name="are_you_agency">
              </div>
            </div>

            <div class="form_item" id="consent_container">
              <input id="demo_consent" type="checkbox" name="demo_consent">
              <label for="demo_consent"><?= $demo_form['consent'] ?></label>
            </div>

            <input id="demo_send_btn" type="submit" value="<?= $demo_form['send_btn'] ?>">

          </form>
        </div>

        <div class="demo_gif">
          <?php $gif = get_field('demo_gif') ?>
          <img src="<?= $gif["url"] ?>" alt="">
        </div>

        <div class="calendar_container">
          <div class="form_header">
            <i id="back_arrow" class="fa-solid fa-arrow-left"></i>
            <h3><?= get_field('calendar_title') ?></h3>
            <p><?= get_field('calendar_sub_title') ?></p>
          </div>

          <?php get_template_part('./components/layouts/calendar') ?>

          <button type="submit" id="book_btn"><?= get_field('calendar_btn') ?></button>

        </div>
      </div>
    </div>
  </section>
</main>

<!-- <?php var_dump($_POST) ?>  -->
<?php get_footer(); ?>