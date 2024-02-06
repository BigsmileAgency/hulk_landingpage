<?php get_header(); ?>

    <main class="default">

        <?php if (have_posts()): while (have_posts()) : the_post(); ?>


        <section class="center page">
            <div class="inner">
                
            <h1><?= the_title() ?></h1>
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