<?php get_header(); ?>

<main class="default">

  <section id="top__title" class="center page__error">
    <div class="inner">

      <h1><?= __('Page introuvable', 'bsa') ?></h1>
      <div class="content">
        <a class="cta default" href="<?= esc_url(home_url()); ?>" aria-label="<?= __('Retour à accueil', 'bsa'); ?>">
          <span><?= __('Retour à accueil', 'bsa'); ?></span>
        </a>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>