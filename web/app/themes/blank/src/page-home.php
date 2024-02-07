<?php

/**
 * Template Name: Home
 */
?>

<?php get_header(); ?>

<main class="home"">

	<section class=" hero_1">
		<div class="container">
			<h2>One platform to share all your digital campaigns</h2>
			<?= get_field('catchphrase') ?>
			<?= get_field('sub_catchphrase') ?>
			<div class="grid_btn_2">
				<button class="trial_btn"><a href="http://hulk-landing.local/login/"><?= get_field('trial_btn') ?></a></button>
				<button class="demo_btn"><a href="http://hulk-landing.local/demo/"><?= get_field('demo_btn') ?></a></button>
			</div>
		</div>
	</section>

	<?php $hero2 = get_field('hero_2'); ?>

	<section class="hero_2">
		<div class="container">
			<div class="hero_2_box">
				<div class="left_box">
					<h3><?= $hero2['catchphrase'] ?></h3>
					<p><?= $hero2['sub_catchphrase'] ?></p>
					<button class="demo_btn"><a href="http://hulk-landing.local/demo/"><?= $hero2['btn_trial'] ?></a></button>
				</div>
				<img src="<?= $hero2['img_hero2'] ?>" alt="">
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>