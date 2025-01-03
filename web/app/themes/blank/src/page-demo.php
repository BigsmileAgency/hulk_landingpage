<?php

/**
 * Template Name: Demo
 */

// GET FIELDS FROM OPTION TAB : 
//  <?= get_field('time', 'Options') 
do_action('demo_handle');
?>

<?php get_header(); ?>
<main class="default demo">

  <div class="container">
    <div class="page_header">
      <h1 class="section_title"><?= get_field("title") ?></h1 >
      <p class="header_p"><?= get_field("explanation") ?></p>
    </div>
  </div>

  <section class="demo_section">
    <div class="container demo_container">
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
          <img src=<?= get_field("bg_img") ?> alt="">
        </div>
      </div>

      <!-- CONTACT FORM -->
      <?php $demo_form = get_field('demo_form') ?>

      <div class="form_and_calendar">
        <div class="demo_form_container">
          <form action="" method="POST" id="demo_form" class="demo_grid">
            <div class="form_header">
              <h3><?= $demo_form['form_title'] ?></h3>
              <p><?= $demo_form['form_subtitle'] ?></p>
            </div>

            <div class="form_grid">
              <div class="form_item">
                <label for="demo_first_name"><?= $demo_form['first_name'] ?></label><br>
                <input id="demo_first_name" type="text" name="demo_first_name">
                <div class="response"></div>
              </div>

              <div class="form_item">
                <label for="demo_last_name"><?= $demo_form['last_name'] ?></label><br>
                <input id="demo_last_name" type="text" name="demo_last_name">
                <div class="response"></div>
              </div>

              <div class="form_item">
                <label for="demo_email"><?= $demo_form['email'] ?></label><br>
                <input id="demo_email" type="text" name="demo_email">
                <div class="response"></div>
              </div>

              <div class="form_item">
                <label for="demo_phone"><?= $demo_form['phone'] ?></label><br>
                <input id="demo_phone" type="text" name="demo_phone">
                <div class="response"></div>
              </div>

              <div class="form_item">
                <label for="demo_company_name"><?= $demo_form['company_name'] ?></label><br>
                <input id="demo_company_name" type="text" name="demo_company_name">
                <div class="response"></div>
              </div>

              <div class="form_item">
                <label for="is_agency"><?= __('Are you an agency?', 'hulkBanner') ?></label><br>
                <div id="agency_container">
                  <div class="tabs is_agency">
                    <input type="radio" name="is_agency" id="no" value="0" checked>
                    <label class="tab" for="no"><?= __('No', 'hulkBanner') ?></label>

                    <input type="radio" name="is_agency" id="yes" value="1">
                    <label class="tab" for="yes"><?= __('Yes', 'hulkBanner') ?></label>

                    <span class="glider"></span>
                  </div>
                </div>
              </div>
              <div class="form_item" id="consent_container">
                <input id="demo_consent" type="checkbox" name="demo_consent">
                <label for="demo_consent">
                  <p><?= $demo_form['consent'] ?></p>
                </label>
              </div>
            </div>
            <input class="demo_btn" id="demo_send_btn" type="submit" value="<?= $demo_form['send_btn'] ?>">
          </form>
        </div>

        <div class="demo_gif">
          <?php $gif = get_field('demo_gif') ?>
          <img src="<?= $gif["url"] ?>" alt="">
        </div>

        <div class="calendar_container demo_grid">
          <div class="form_header">
            <i id="back_arrow" class="fa-solid fa-arrow-left"></i>
            <h3><?= get_field('calendar_title') ?></h3>
            <p><?= get_field('calendar_sub_title') ?></p>
          </div>
          <!-- <?php get_template_part('./components/layouts/calendar') ?> -->
          <button class="demo_btn" type="submit" id="book_btn"><?= get_field('calendar_btn') ?></button>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>