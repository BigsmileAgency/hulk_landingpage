<?php

/**
 * Template Name: Home
 */
?>

<?php get_header(); ?>

<main class="home" style="background-image: url(<?php the_field('bg_img'); ?>);">
	<section class="center page">
		<div class="inner" >
			<h2>One platform to share all your digital campaigns</h2>
			<div class="content">

				<?php the_content(); ?>
				<?= get_field('catchphrase') ?>	
				<?= get_field('sub_catchphrase') ?>		

				<div class="grid_btn_2">					
					<button class="trial_btn"><a href="http://hulk-landing.local/login/"><?= get_field('trial_btn')?></a></button>
					<button class="demo_btn"><a href="http://hulk-landing.local/demo/"><?= get_field('demo_btn')?></button></a>						
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>

