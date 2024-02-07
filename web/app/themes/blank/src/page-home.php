<?php

/**
 * Template Name: Home
 */
?>

<?php get_header(); ?>

<main class="home" style="background-image: url(<?php the_field('bg_img'); ?>);">

	<section class="hero_1">
		<div class="container">
			<h2>One platform to share all your digital campaigns</h2>
			<?= get_field('catchphrase') ?>
			<?= get_field('sub_catchphrase') ?>
			<div class="grid_btn_2">
				<button class="trial_btn"><a href="http://hulk-landing.local/login/"><?= get_field('trial_btn') ?></a></button>
				<button class="demo_btn"><a href="http://hulk-landing.local/demo/"><?= get_field('demo_btn') ?></button></a>
			</div>
		</div>
	</section>

	<?php $hero2 = get_field('hero_2'); ?>
	<section class="hero_2">
		<div class="container">
			<h3><?= $hero2['catchphrase'] ?></h3>
		</div>
	</section>
</main>

<?php get_footer(); ?>
