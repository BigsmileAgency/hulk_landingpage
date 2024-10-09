<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php include('components/functions/description.php'); ?>

	<meta name="theme-color" content="#ffffff">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.0/gsap.min.js" integrity="sha512-gWlyRVDsJvp5kesJt4cSdPPLZIBdln/uSwzYgUicQcbTgRNQE4QhP5KUBIYlLYLkiKIQiuD7KUMHzqGNW/D2bQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.0/ScrollTrigger.min.js" integrity="sha512-K7WgwKJAJIRoRV8yDALsY4+CZhsWKk0gVFotVxC2RzCRyoEVyWH1DRDjxw2DdBKdZdBMPr4cacHbYbNco9wOvQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

	<?php wp_head(); ?>
	<?php if (WP_ENV !== 'development' && !is_admin()) { ?>

		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?= GOOGLE_ANALYTICS_ID ?>"></script>
		<script>
			window.dataLayer = window.dataLayer || [];

			function gtag() {
				dataLayer.push(arguments);
			}
			gtag('js', new Date());

			gtag('config', <?= GOOGLE_ANALYTICS_ID ?>, {
				'anonymize_ip': true
			});
		</script>
	<?php } ?>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<header class="header">
		<nav aria-label="Main menu" class="container container_nav">

			<!-- remove .left_nav div if you wanna comme back to centered nav -->
			<!-- <div class="left_nav"> -->
			<div class="logo_nav">
				<a href="<?php echo get_home_url() . '/'; ?>"><img alt="logo FoxBanner" class="logo_hulk" src="<?php echo get_template_directory_uri() ?>/images/logo_header.svg"></a>
			</div>
			<?php wp_nav_menu(array('theme_location' => 'nav_menu', 'container_class' => 'nav_menu')); ?>
			<!-- </div> -->
			<!-- remove .left_nav div END -->

			<div class="nav_user">
				<ul id="menu-login">
					<li><a href="#"><?= __('Login', 'hulkbanner') ?></a></li>
					<li><a href="#"><?= __('Try for free', 'hulkbanner') ?></a></li>
				</ul>
				<nav id="lang_switch_wrap" aria-expanded="false">
					<!-- <div class="lang_btns" ></div> -->
					<!-- generate by: lang_switch_handler.php -->
					<?php
						do_action('wpml_add_language_selector');
					?>
				</nav>
			</div>
			<!-- <?php wp_nav_menu(array('theme_location' => 'login', 'container_class' => 'nav_menu')); ?> -->
			<div id="burger-simple" class="burger_to_open">
				<div class="burger-bar burger-bar-simple burger-bg-1 "></div>
				<div class="burger-bar burger-bar-simple burger-bg-1"></div>
				<div class="burger-bar burger-bar-simple burger-bg-1"></div>
			</div>
			<div class="nav_mobile">
				<div class="mobile_logo_container">
					<div class="logo_mobile"><a href="<?php echo get_home_url() . '/'; ?>"><img alt="logo FoxBanner" src="<?php echo get_template_directory_uri() ?>/images/logo_footer.svg"></a></div>
					<div class="empty_squarre"></div>
				</div>
				<div class="nav_mobile_items">
					<?php wp_nav_menu(array('theme_location' => 'burger', 'container' => '', 'container_id' => '#menu-burger',)); ?>
					<li></li>
					<li></li>
					<li><a href="#"><?= __('Login', 'hulkbanner') ?></a></li>
					<li class="try"><a href="#"><?= __('Try for free', 'hulkbanner') ?></a></li>
				</div>
				<div id="mobile_lang_switch">
					<div class="mobile_lang_btns"></div>
				</div>
			</div>
		</nav>
	</header>

	<script>
		// NAVBAR SCROLL ON TOP
		window.addEventListener('scroll', (e) => {
			const nav = document.querySelector('.header');
			if (window.pageYOffset > 0) {
				nav.classList.add("add-shadow");
			} else {
				nav.classList.remove("add-shadow");
			}
		});

		// BURGER MENU //  
		document.addEventListener("DOMContentLoaded", (e) => {
			e.preventDefault();

			let burgerSimple = document.querySelector('#burger-simple');
			let burgerToOpen = document.querySelector('.burger_to_open');
			let navMobile = document.querySelector('.nav_mobile');
			let mobileLinks = document.querySelectorAll('.nav_mobile a');
			let langLinks = document.querySelectorAll('.lang_display');

			// animate burger button
			burgerSimple.addEventListener('click', (e) => {
				burgerSimple.classList.toggle("simple");
			})

			// toggle mobile navbar
			burgerToOpen.addEventListener('click', (e) => {
				navMobile.classList.toggle("open");
			});

			// close navbar if clicked link = current location
			mobileLinks.forEach((e) => {
				e.addEventListener("click", () => {
					// console.log(e.getAttribute('href'));
					if (e.getAttribute('href') == window.location.href) {
						navMobile.classList.remove('open');
						burgerSimple.classList.remove("simple");
					}
				})
			})

			// close navbar if clicked lang = current lang
			langLinks.forEach((e) => {
				e.addEventListener('click', () => {
					// console.log(e);
					if (e.innerHTML == lang.toUpperCase()) {
						navMobile.classList.remove('open');
						burgerSimple.classList.remove("simple");
					};
				})
			})
		})
	</script>