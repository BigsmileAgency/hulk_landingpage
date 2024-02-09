<?php

/**
 * Template Name: Demo
 */
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
      </div>

      <!-- CONTACT FORM -->
      <?php $demo_form = get_field('demo_form') ?>

      <div class="form_and_calendar">

        <div class="demo_form_container">

          <div class="form_header">
            <h3><?= $demo_form['form_title'] ?></h3>
            <p><?= $demo_form['form_subtitle'] ?></p>
            <p class="demo_response response"></p>
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

              <div class="form_item">
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
            <h3>Calendar</h3>
            <p>Do canlendar</p>
            <p class="demo_response response"></p>
          </div>
          <div class="calendar">
            <table>
              <thead>
                <tr>
                  <th colspan="7">
                    <div id="prev_month">
                      <svg xmlns="http://www.w3.org/2000/svg" width="5.564" height="9.273" viewBox="0 0 5.564 9.273">
                        <path id="Icon_feather-chevron-left" data-name="Icon feather-chevron-left" d="M4.868,9.273a.711.711,0,0,1-.492-.194L.2,5.1a.64.64,0,0,1,0-.937L4.376.194a.72.72,0,0,1,.984,0,.64.64,0,0,1,0,.937L1.679,4.636,5.36,8.142a.64.64,0,0,1,0,.937A.711.711,0,0,1,4.868,9.273Z" fill="#293133" />
                      </svg>
                    </div>
                    <div class="header_date">${months[currentMonth]} ${currentYear}</div>
                    <div id="next_month">
                      <svg xmlns="http://www.w3.org/2000/svg" width="5.564" height="9.273" viewBox="0 0 5.564 9.273">
                        <path id="Icon_feather-chevron-left" data-name="Icon feather-chevron-left" d="M4.868,9.273a.711.711,0,0,1-.492-.194L.2,5.1a.64.64,0,0,1,0-.937L4.376.194a.72.72,0,0,1,.984,0,.64.64,0,0,1,0,.937L1.679,4.636,5.36,8.142a.64.64,0,0,1,0,.937A.711.711,0,0,1,4.868,9.273Z" transform="translate(5.564 9.273) rotate(180)" fill="#293133" />
                      </svg>
                    </div>
                  </th>
                </tr>
                <tr>
                  <th><?= __('L', 'calendar_days'); ?></th>
                  <th><?= __('Ma', 'calendar_days'); ?></th>
                  <th><?= __('Me', 'calendar_days'); ?></th>
                  <th><?= __('J', 'calendar_days'); ?></th>
                  <th><?= __('V', 'calendar_days'); ?></th>
                  <th><?= __('S', 'calendar_days'); ?></th>
                  <th><?= __('D', 'calendar_days'); ?></th>
                </tr>
              </thead>
              <tbody id="calendar-body"></tbody>
            </table>
          </div>
        </div>
      </div>

    </div>


  </section>

</main>

<!-- <?php var_dump($_POST) ?>  -->
<?php get_footer(); ?>