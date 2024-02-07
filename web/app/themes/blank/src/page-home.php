<?php

/**
 * Template Name: Home
 */
?>

<?php get_header(); ?>

<main class="default" style="background-image: url(<?php the_field('bg_img'); ?>);">
	<section class="center page">
		<div class="inner" >
			<h2>One platform to share all your digital campaigns</h2>
			<div class="content">
				<?php the_content(); ?>
				<?= get_field('catchphrase') ?>	
				<?= get_field('sub_catchphrase') ?>		

				<div class="grid_2">
					<button><?= get_field('trial_btn')?></button>
					<button><?= get_field('demo_btn')?></button>
				</div>

			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>

