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
        <div class=" container container_nav">
            <div class="logo_nav"><a href="<?php echo get_home_url(); ?>"><img class="logo_hulk" src="<?php echo get_template_directory_uri() ?>/images/logo_header.svg"></a></div>
            <?php wp_nav_menu(array('theme_location' => 'nav_menu', 'container_class' => 'nav_menu')); ?>
            <div class="nav_menu">
                <ul id="menu-login">
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Try for free</a></li>
                </ul>
                <div id="lang_switch_wrap">
                    <div id="lang_btns"></div>
                    <!-- generate by: lang_switch_handler.php -->
                </div>
            </div>
            <!-- <?php wp_nav_menu(array('theme_location' => 'login', 'container_class' => 'nav_menu')); ?> -->
            <div class="nav_mobile">
                <input type="checkbox" id="menu-toggle" />
                <label id="trigger" for="menu-toggle"></label>
                <label id="burger" for="menu-toggle"></label>
                <?php wp_nav_menu(array('theme_location' => 'burger', 'container' => '', 'container_id' => '#menu-burger',)); ?>
            </div>
        </div>
        </div>
    </header>