<?php
function oceania_setup() {
	//Enable Custom Menus
    add_theme_support('menus');

	if (function_exists('register_nav_menu')) {
		register_nav_menu('primary', 'Primary Menu');
	}

	//Enable Post Thumbnails
	add_theme_support('post-thumbnails');

	//Enable Theme Titles
	add_theme_support('title-tag');

	load_theme_textdomain( 'kreativ', get_template_directory() . '/languages' );

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

function kreativ_enqueue_lazyload() {
    wp_enqueue_script(
        'jquery-lazyload',
        get_template_directory_uri() . '/js/jquery.lazyload.min.js',
        array( 'jquery' ),
        '1.9.5',
        true
    );

    wp_enqueue_script(
        'kreativ-lazyload-init',
        get_template_directory_uri() . '/js/theme-lazyload.js',
        array( 'jquery-lazyload' ),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action('wp_enqueue_scripts', 'kreativ_enqueue_lazyload');


function kreativ_script_enqueue()
{
    $theme_version = wp_get_theme()->get( 'Version' );

    wp_enqueue_style( 'kreativ-styles', get_template_directory_uri() . '/assets/dist/main.min.css' , array(), $theme_version);
    wp_enqueue_style( 'kreativ-global', get_template_directory_uri() . '/css/kreativ-global.css', array( 'kreativ-styles' ), $theme_version );
    wp_register_script('init', get_template_directory_uri() . '/assets/assets/components/init.js', array('jquery'), $theme_version, true);
    wp_enqueue_script('init');
	if ( is_singular('post') || is_front_page() || is_tag() || is_category() ) {
		wp_dequeue_style( 'edd-styles' );
		wp_dequeue_script( 'edd-ajax' );
	}
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
if ( ! defined( 'EDD_SLUG' ) ) {
	define( 'EDD_SLUG', 'market' );
}

function kreativ_get_fallback_image_url() {
    return get_template_directory_uri() . '/img/logo-192.png';
}

function kreativ_get_theme_asset_url( $path ) {
    return trailingslashit( get_template_directory_uri() ) . ltrim( $path, '/' );
}

function kreativ_get_internal_url( $path = '/' ) {
    return home_url( '/' . ltrim( $path, '/' ) );
}

function kreativ_get_checkout_url( $download_id ) {
    return add_query_arg(
        array(
            'edd_action'  => 'add_to_cart',
            'download_id' => absint( $download_id ),
        ),
        kreativ_get_internal_url( 'checkout' )
    );
}

function kreativ_get_popular_fonts_url() {
    return kreativ_get_internal_url( 'fonts' );
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

function kreativ_render_category_update_cta() {
    if ( shortcode_exists( 'kcc_suggest_update' ) ) {
        return do_shortcode( '[kcc_suggest_update]' );
    }

    return '';
}

function kreativ_customize_register( $wp_customize ) {
    $wp_customize->add_section(
        'kreativ_theme_options',
        array(
            'title'    => __( 'Kreativ Theme Options', 'kreativ' ),
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
            'label'       => __( 'Show theme related posts on single posts', 'kreativ' ),
            'description' => __( 'Disable this if another plugin or custom system handles related posts.', 'kreativ' ),
        )
    );
}
add_action( 'customize_register', 'kreativ_customize_register' );

function kreativ_maybe_convert_showcases() {
    if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( ! isset( $_GET['convert_showcases'] ) ) {
        return;
    }

    $nonce = isset( $_GET['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ) : '';
    if ( ! wp_verify_nonce( $nonce, 'kreativ_convert_showcases' ) ) {
        return;
    }

    $query = new WP_Query(
        [
            'post_type'      => 'kreativ_showcase',
            'posts_per_page' => -1,
            'post_status'    => 'any',
            'fields'         => 'ids',
        ]
    );

    $count = 0;
    foreach ( $query->posts as $post_id ) {
        wp_update_post(
            [
                'ID'        => $post_id,
                'post_type' => 'post',
            ]
        );
        $count++;
    }

    add_action(
        'admin_notices',
        static function () use ( $count ) {
            ?>
            <div class="notice notice-success is-dismissible">
                <p><?php echo esc_html( sprintf( 'Converted %d showcase posts to regular posts.', $count ) ); ?></p>
            </div>
            <?php
        }
    );
}
add_action( 'admin_init', 'kreativ_maybe_convert_showcases' );

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
