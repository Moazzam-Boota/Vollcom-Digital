<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp_vollcomdigital_Starter
 */

?><!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

    <!--Header-->
    <header id="masthead" class="<?php echo wp_vollcomdigital_starter_bg_class(); ?>" role="banner">
        <nav class="navbar navbar-expand-lg navbar-dark has-braun-background-color">
            <div class="container">
                <div class="navbar-brand py-0">
                    <?php if (get_theme_mod('wp_vollcomdigital_starter_logo')): ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <img class="img-fluid"
                                 src="<?php echo esc_url(get_theme_mod('wp_vollcomdigital_starter_logo')); ?>"
                                 alt="<?php echo esc_attr(get_bloginfo('name')); ?>" width="60">
                        </a>
                    <?php endif; ?>
                    <a class="site-title text-white"
                       href="<?php echo esc_url(home_url('/')); ?>"><?php esc_url(bloginfo('name')); ?></a>
                </div>
                <li class="menu-item menu-item-type-search menu-item-search-mobile nav-item text-white mx-3"><i
                            class="far fa-search"></i></li>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav"
                        aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => 'div',
                    'container_id' => 'main-nav',
                    'container_class' => 'collapse navbar-collapse',
                    'menu_id' => false,
                    'menu_class' => 'navbar-nav ml-auto',
                    'depth' => 3,
                    'fallback_cb' => 'wp_vollcomdigital_navwalker::fallback',
                    'walker' => new wp_vollcomdigital_navwalker()
                ));
                ?>

            </div>
        </nav>
        <?php if (is_front_page() && !get_theme_mod('header_banner_visibility')): ?>
            <div id="page-sub-header"
                 <?php if (has_header_image()) { ?>style="background-image: url('<?php header_image(); ?>');" <?php } ?>>
                <div class="container">
                    <h1>
                        <?php
                        if (get_theme_mod('header_banner_title_setting')) {
                            echo get_theme_mod('header_banner_title_setting');
                        } else {
                            echo 'WordPress + Bootstrap';
                        }
                        ?>
                    </h1>
                    <p>
                        <?php
                        if (get_theme_mod('header_banner_tagline_setting')) {
                            echo get_theme_mod('header_banner_tagline_setting');
                        } else {
                            echo esc_html__('To customize the contents of this header banner and other elements of your site, go to Dashboard > Appearance > Customize', 'wp-vollcom-digital');
                        }
                        ?>
                    </p>
                    <a href="#content" class="page-scroller"><i class="fa fa-fw fa-angle-down"></i></a>
                </div>
            </div>
        <?php endif; ?>
    </header>
    <div class="search-container">
        <div class="container">
            <div id="searchOverlay" class="overlay d-none">
                <div class="overlay-content">
                    <form action="<?php echo home_url('/'); ?>" method="get" id="searchform">
                        <span class="overlay-search-icon"><i class="far fa-search"></i></span>
                        <input type="text" class="search-input"
                               placeholder="<?php esc_html_e('What Are you Looking for?', 'wp-vollcom-digital'); ?>"
                               name="s">
                        <span class="close-search-btn mr-2"
                              title="<?php esc_html_e('Close Search', 'wp-vollcom-digital'); ?>"><i
                                    class="far fa-times"></i></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/.Header-->
