<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    $site_title = kreativ_get_site_title();
    ?>

    <meta name="theme-color" content="#ffffff">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( kreativ_get_theme_asset_url( 'img/favicon-16x16.png' ) ); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( kreativ_get_theme_asset_url( 'img/favicon-32x32.png' ) ); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo esc_url( kreativ_get_theme_asset_url( 'img/favicon-96x96.png' ) ); ?>">

    <!-- PWA: Apple iOS Support -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( kreativ_get_theme_asset_url( 'img/apple-touch-icon-180x180.png' ) ); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="kreativ-skip-link" href="#kreativ-main-content"><?php esc_html_e( 'Skip to content', 'kreativ-core' ); ?></a>

<header class="kreativ-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div id="site-navigation" class="navbar-collapse offcanvas-collapse">
                
                <div class="kreativ-hdr-left">
					<h1 class="kreativ-logo">
						<a href="<?php echo esc_url( home_url('/') ); ?>" title="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
                            <?php if ( has_custom_logo() ) : ?>
                                <?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false, array( 'class' => 'kreativ-logo-icon', 'alt' => $site_title ) ); ?>
                            <?php else : ?>
							    <img src="<?php echo esc_url( kreativ_get_theme_asset_url( 'img/k-logo.svg' ) ); ?>"
								 alt="<?php echo esc_attr( $site_title ); ?>"
								 class="kreativ-logo-icon">
                            <?php endif; ?>
							<span class="kreativ-logo-text"><?php echo esc_html( $site_title ); ?></span>
						</a>
					</h1>

                </div>				

                <div class="kreativ-search">
                    <form method="get" id="searchform" action="<?php echo esc_url( home_url('/') ); ?>">
                        <label class="screen-reader-text" for="searchi"><?php esc_html_e( 'Search for:', 'kreativ-core' ); ?></label>
                        <input id="searchi" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>"
                               maxlength="128" placeholder="Type your search and press enter"
                               aria-label="<?php esc_attr_e( 'Search site content', 'kreativ-core' ); ?>"
                               class="form-control form-control-sm">
                    </form>
                </div>

                <div class="kreativ-hdr-right">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'navbar-nav btn',
                        'depth' => 1,
                    ));
                    ?>
                </div>

            </div>


			<h2 class="kreativ-logo offcanvas-show">
				<a href="<?php echo esc_url( home_url('/') ); ?>" title="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
                    <?php if ( has_custom_logo() ) : ?>
                        <?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false, array( 'class' => 'kreativ-logo-icon', 'alt' => $site_title ) ); ?>
                    <?php else : ?>
						<img src="<?php echo esc_url( kreativ_get_theme_asset_url( 'img/k-logo.svg' ) ); ?>"
						 alt="<?php echo esc_attr( $site_title ); ?>"
						 class="kreativ-logo-icon">
                    <?php endif; ?>
					<span class="kreativ-logo-text"><?php echo esc_html( $site_title ); ?></span>
				</a>
			</h2>

            <button class="navbar-toggler" type="button" data-toggle="offcanvas" aria-controls="site-navigation" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle menu', 'kreativ-core' ); ?>">
                <?php esc_html_e( 'Menu', 'kreativ-core' ); ?>
            </button>
        </nav>
    </div>
</header>

<section id="kreativ-main-content" class="kreativ-content" tabindex="-1">
