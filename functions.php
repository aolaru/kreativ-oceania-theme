<?php
function oceania_setup() {
	//Enable Custom Menus
    add_theme_support('menus');

	if (function_exists('register_nav_menu')) {
		register_nav_menu( 'primary', __( 'Primary Menu', 'kreativ-oceania-theme' ) );
        register_nav_menu( 'footer', __( 'Footer Menu', 'kreativ-oceania-theme' ) );
	}

	//Enable Post Thumbnails
	add_theme_support('post-thumbnails');

	//Enable Theme Titles
	add_theme_support('title-tag');
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 96,
            'width'       => 96,
            'flex-height' => true,
            'flex-width'  => true,
        )
    );
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

	load_theme_textdomain( 'kreativ-oceania-theme', get_template_directory() . '/languages' );

	add_editor_style( 'assets/dist/main.min.css' );

	if ( ! isset( $GLOBALS['content_width'] ) ) {
		$GLOBALS['content_width'] = 900;
	}

}

add_action( 'after_setup_theme', 'oceania_setup' );

function kreativ_jquery_loading() {
    if ( ! is_admin() ) {
        wp_enqueue_script( 'jquery' );
    }
}
add_action('wp_enqueue_scripts', 'kreativ_jquery_loading');

function kreativ_script_enqueue()
{
    $theme_version = wp_get_theme()->get( 'Version' );

    wp_enqueue_style( 'kreativ-styles', get_template_directory_uri() . '/assets/dist/main.min.css' , array(), $theme_version);
    wp_enqueue_style( 'kreativ-global', get_template_directory_uri() . '/css/kreativ-global.css', array( 'kreativ-styles' ), $theme_version );
    wp_register_script('init', get_template_directory_uri() . '/assets/assets/components/init.js', array('jquery'), $theme_version, true);
    wp_enqueue_script('init');
	wp_deregister_script('wp-embed');
}
add_action('wp_enqueue_scripts', 'kreativ_script_enqueue');

function kreativ_enqueue_page_assets() {
    $theme_version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'kreativ-dark-mode',
        get_template_directory_uri() . '/js/theme-dark-mode.js',
        array(),
        $theme_version,
        true
    );

    if ( is_page_template( array( 'template-filter-all.php', 'template-filter-market.php' ) ) ) {
        wp_enqueue_style(
            'kreativ-home',
            get_template_directory_uri() . '/css/kreativ-home.css',
            array( 'kreativ-global' ),
            $theme_version
        );
    }
}
add_action( 'wp_enqueue_scripts', 'kreativ_enqueue_page_assets' );


function remove_comments_rss($for_comments)
{
    return;
}

add_filter('post_comments_feed_link', 'remove_comments_rss');

remove_action('wp_head', 'wp_generator');

remove_action('wp_head', 'wlwmanifest_link');

remove_action('wp_head', 'rsd_link');

remove_action('wp_head', 'print_emoji_detection_script', 7);

remove_action('wp_print_styles', 'print_emoji_styles');

function my_login_head()
{
    $logo_url = esc_url( kreativ_get_theme_asset_url( 'img/logo-192.png' ) );

    echo "
	<style>
	body.login #login h1 a {
		background: url('{$logo_url}') no-repeat scroll center top transparent;
		background-size: 128px 128px;
		height: 128px;
		width: 128px;
	}
	</style>
	";
}

add_action("login_head", "my_login_head");

//change login form URL
function my_login_logo_url()
{
    return home_url();
}

add_filter('login_headerurl', 'my_login_logo_url');

//change login form info
function my_login_logo_url_title()
{
    return get_bloginfo('name');
}

add_theme_support( 'title-tag' );


add_filter('login_headertitle', 'my_login_logo_url_title');

// marketplace slug menu
function kreativ_get_fallback_image_url() {
    return get_template_directory_uri() . '/img/logo-192.png';
}

function kreativ_get_post_thumbnail_markup( $post_id = 0, $size = 'medium', $attributes = array() ) {
    $post_id = $post_id ? absint( $post_id ) : get_the_ID();

    $default_attributes = array(
        'class'    => 'card-img-top',
        'loading'  => 'lazy',
        'decoding' => 'async',
        'sizes'    => '(max-width: 575px) 100vw, (max-width: 991px) 50vw, (max-width: 1199px) 33vw, 25vw',
    );

    $attributes = wp_parse_args( $attributes, $default_attributes );
    $thumb_id   = get_post_thumbnail_id( $post_id );

    if ( $thumb_id ) {
        if ( empty( $attributes['alt'] ) ) {
            $attributes['alt'] = trim( wp_strip_all_tags( get_the_title( $post_id ) ) );
        }

        return wp_get_attachment_image( $thumb_id, $size, false, $attributes );
    }

    $class   = trim( ( $attributes['class'] ?? '' ) . ' kreativ-fallback-thumb' );
    $alt     = $attributes['alt'] ?? trim( wp_strip_all_tags( get_the_title( $post_id ) ) );
    $loading = $attributes['loading'] ?? 'lazy';
    $decoding = $attributes['decoding'] ?? 'async';

    return sprintf(
        '<img src="%1$s" class="%2$s" alt="%3$s" loading="%4$s" decoding="%5$s" width="192" height="192" />',
        esc_url( kreativ_get_fallback_image_url() ),
        esc_attr( $class ),
        esc_attr( $alt ),
        esc_attr( $loading ),
        esc_attr( $decoding )
    );
}

function kreativ_get_theme_asset_url( $path ) {
    return trailingslashit( get_template_directory_uri() ) . ltrim( $path, '/' );
}

function kreativ_get_site_title() {
    return get_bloginfo( 'name' ) ? get_bloginfo( 'name' ) : wp_get_theme()->get( 'Name' );
}

function kreativ_get_site_description() {
    $description = get_bloginfo( 'description' );

    if ( $description ) {
        return $description;
    }

    return __( 'A lightweight, responsive WordPress site.', 'kreativ-oceania-theme' );
}

function kreativ_get_schema_social_links() {
    $raw_urls = (string) get_theme_mod( 'kreativ_social_profile_urls', '' );

    if ( '' === trim( $raw_urls ) ) {
        return array();
    }

    $urls = preg_split( '/[\r\n,]+/', $raw_urls );
    $urls = array_filter( array_map( 'esc_url_raw', array_map( 'trim', $urls ) ) );

    return array_values( array_unique( $urls ) );
}

function kreativ_get_featured_categories( $limit = 6 ) {
    $slugs = (string) get_theme_mod( 'kreativ_featured_category_slugs', '' );

    if ( '' !== trim( $slugs ) ) {
        $categories = array();
        foreach ( array_map( 'trim', explode( ',', $slugs ) ) as $slug ) {
            if ( '' === $slug ) {
                continue;
            }

            $category = get_category_by_slug( sanitize_title( $slug ) );
            if ( $category && ! is_wp_error( $category ) && (int) $category->count > 0 ) {
                $categories[] = $category;
            }

            if ( count( $categories ) >= $limit ) {
                break;
            }
        }

        if ( ! empty( $categories ) ) {
            return $categories;
        }
    }

    $categories = get_categories(
        array(
            'orderby'    => 'count',
            'order'      => 'DESC',
            'hide_empty' => true,
            'number'     => $limit,
            'exclude'    => array( 1 ),
        )
    );

    return is_array( $categories ) ? $categories : array();
}

function kreativ_get_internal_url( $path = '/' ) {
    return home_url( '/' . ltrim( $path, '/' ) );
}

function kreativ_get_category_url( $slug ) {
    $category = get_category_by_slug( $slug );

    if ( $category && ! is_wp_error( $category ) ) {
        return get_category_link( $category );
    }

    return kreativ_get_internal_url( 'category/' . ltrim( $slug, '/' ) );
}

function kreativ_render_icon( $key ) {
    $icons = array(
        'fonts'             => 'Aa',
        'templates-themes'  => '&#9638;',
        'graphics'          => '&#9998;',
        'photos'            => '&#128247;',
        'videos'            => '&#9654;',
        'sounds'            => '&#9835;',
        'free'              => '&#10024;',
        'search'            => '&#128269;',
        'magic'             => '&#10024;',
        'idea'              => '&#128161;',
        'tag'               => '#',
        'folder'            => '&#9635;',
    );

    $symbol = $icons[ $key ] ?? $icons['folder'];

    return sprintf(
        '<span class="kreativ-symbol-icon kreativ-symbol-icon--%1$s" aria-hidden="true">%2$s</span>',
        esc_attr( sanitize_html_class( $key ) ),
        $symbol
    );
}

function kreativ_get_primary_category_badge( $post_id, $labels ) {
    $terms = get_the_terms( $post_id, 'category' );

    if ( ! $terms || is_wp_error( $terms ) ) {
        return array( null, null );
    }

    foreach ( $terms as $term ) {
        if ( isset( $labels[ $term->slug ] ) ) {
            return array( $term->slug, $labels[ $term->slug ] );
        }
    }

    return array( null, null );
}

function kreativ_single_related_posts_enabled() {
    return (bool) get_theme_mod( 'kreativ_enable_theme_related_posts', true );
}

function kreativ_get_related_posts_query( $post_id, $posts_per_page = 4 ) {
    $category_ids = wp_get_post_categories( $post_id );
    $tag_ids      = wp_get_post_tags( $post_id, array( 'fields' => 'ids' ) );

    $args = array(
        'post_type'              => 'post',
        'posts_per_page'         => absint( $posts_per_page ),
        'post__not_in'           => array( absint( $post_id ) ),
        'ignore_sticky_posts'    => true,
        'post_status'            => 'publish',
        'orderby'                => 'date',
        'order'                  => 'DESC',
        'no_found_rows'          => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
    );

    if ( ! empty( $tag_ids ) ) {
        $args['tag__in'] = array_map( 'absint', $tag_ids );
    } elseif ( ! empty( $category_ids ) ) {
        $args['category__in'] = array_map( 'absint', $category_ids );
    }

    return new WP_Query( $args );
}

function kreativ_customize_register( $wp_customize ) {
    $wp_customize->add_section(
        'kreativ_theme_options',
        array(
            'title'    => __( 'Theme Options', 'kreativ-oceania-theme' ),
            'priority' => 160,
        )
    );

    $wp_customize->add_setting(
        'kreativ_enable_theme_related_posts',
        array(
            'default'           => true,
            'sanitize_callback' => 'rest_sanitize_boolean',
        )
    );

    $wp_customize->add_control(
        'kreativ_enable_theme_related_posts',
        array(
            'type'        => 'checkbox',
            'section'     => 'kreativ_theme_options',
            'label'       => __( 'Show theme related posts on single posts', 'kreativ-oceania-theme' ),
            'description' => __( 'Disable this if another plugin or custom system handles related posts.', 'kreativ-oceania-theme' ),
        )
    );

    $wp_customize->add_setting(
        'kreativ_featured_category_slugs',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'kreativ_featured_category_slugs',
        array(
            'type'        => 'text',
            'section'     => 'kreativ_theme_options',
            'label'       => __( 'Featured category slugs', 'kreativ-oceania-theme' ),
            'description' => __( 'Optional comma-separated category slugs for the homepage sections. Leave empty to use the most active categories automatically.', 'kreativ-oceania-theme' ),
        )
    );

    $wp_customize->add_setting(
        'kreativ_footer_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'kreativ_footer_text',
        array(
            'type'        => 'text',
            'section'     => 'kreativ_theme_options',
            'label'       => __( 'Footer text', 'kreativ-oceania-theme' ),
            'description' => __( 'Optional footer note shown below the footer menu.', 'kreativ-oceania-theme' ),
        )
    );

    $wp_customize->add_setting(
        'kreativ_social_profile_urls',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        )
    );

    $wp_customize->add_control(
        'kreativ_social_profile_urls',
        array(
            'type'        => 'textarea',
            'section'     => 'kreativ_theme_options',
            'label'       => __( 'Organization social profile URLs', 'kreativ-oceania-theme' ),
            'description' => __( 'Optional URLs for Schema.org sameAs, one per line or comma-separated.', 'kreativ-oceania-theme' ),
        )
    );
}
add_action( 'customize_register', 'kreativ_customize_register' );

function kreativ_add_category_body_class( $classes ) {
    if ( is_category() ) {
        $cat = get_queried_object();
        if ( isset( $cat->slug ) ) {
            $classes[] = 'kreativ-cat-' . sanitize_html_class( $cat->slug );
        }
    }
    return $classes;
}
add_filter( 'body_class', 'kreativ_add_category_body_class' );

function kf_is_new_post( $post_id ) {
    return ( time() - get_post_time( 'U', true, $post_id ) ) <= 7 * DAY_IN_SECONDS;
}

add_action('wp_enqueue_scripts', function () {

    if (is_category() || is_tag()) {
        wp_enqueue_style(
            'kreativ-archive',
            get_template_directory_uri() . '/css/kreativ-archive.css',
            [],
            '1.0.0'
        );
    }

});
