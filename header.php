<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    $site_title = kreativ_get_site_title();
    ?>

    <meta name="theme-color" content="#ffffff">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="kreativ-skip-link" href="#primary"><?php esc_html_e( 'Skip to content', 'kreativ-core' ); ?></a>

<?php if ( get_header_image() ) : ?>
    <div class="kreativ-custom-header">
        <?php the_header_image_tag( array( 'class' => 'kreativ-custom-header-image' ) ); ?>
    </div>
<?php endif; ?>

<header class="kreativ-header">
    <div class="container">
        <div class="kreativ-site-nav">
            <p class="kreativ-logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
                    <?php if ( has_custom_logo() ) : ?>
                        <?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false, array( 'class' => 'kreativ-logo-icon', 'alt' => $site_title ) ); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url( kreativ_get_theme_asset_url( 'img/k-logo.svg' ) ); ?>"
                            alt="<?php echo esc_attr( $site_title ); ?>"
                            class="kreativ-logo-icon">
                    <?php endif; ?>
                    <span class="kreativ-logo-text"><?php echo esc_html( $site_title ); ?></span>
                </a>
            </p>

            <button class="kreativ-menu-toggle" type="button" data-kreativ-menu-toggle aria-controls="site-navigation" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle menu', 'kreativ-core' ); ?>">
                <span data-kreativ-menu-label><?php esc_html_e( 'Menu', 'kreativ-core' ); ?></span>
            </button>

            <nav id="site-navigation" class="kreativ-site-navigation kreativ-offcanvas" aria-label="<?php echo esc_attr__( 'Primary Menu', 'kreativ-core' ); ?>">
                <div class="kreativ-search">
                    <?php get_search_form(); ?>
                </div>

                <div class="kreativ-hdr-right">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'kreativ-primary-menu',
                        'depth' => 0,
                        'fallback_cb' => 'kreativ_page_menu_fallback',
                    ));
                    ?>
                </div>
            </nav>
        </div>
    </div>
</header>
