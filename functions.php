<?php
function kreativ_core_setup() {
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'kreativ-core' ),
			'footer'  => __( 'Footer Menu', 'kreativ-core' ),
		)
	);

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Kreativ crimson', 'kreativ-core' ),
				'slug'  => 'kreativ-pink',
				'color' => '#c7184d',
			),
			array(
				'name'  => __( 'Kreativ blue', 'kreativ-core' ),
				'slug'  => 'kreativ-blue',
				'color' => '#007aa3',
			),
		)
	);
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'ffffff',
		)
	);
	add_theme_support(
		'custom-header',
		array(
			'width'         => 2000,
			'height'        => 600,
			'flex-width'    => true,
			'flex-height'   => true,
			'header-text'   => false,
			'uploads'       => true,
		)
	);
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

	load_theme_textdomain( 'kreativ-core', get_template_directory() . '/languages' );

	add_editor_style( 'editor-style.css' );

	if ( ! isset( $GLOBALS['content_width'] ) ) {
		$GLOBALS['content_width'] = 900;
	}

}

add_action( 'after_setup_theme', 'kreativ_core_setup' );

require_once get_template_directory() . '/inc/patterns.php';

function kreativ_script_enqueue() {
    $theme_version = wp_get_theme()->get( 'Version' );

    wp_enqueue_style( 'kreativ-core', get_stylesheet_uri(), array(), $theme_version );
    wp_enqueue_style( 'kreativ-global', get_template_directory_uri() . '/css/kreativ-global.css', array( 'kreativ-core' ), $theme_version );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'kreativ_script_enqueue' );

function kreativ_page_menu_fallback( $args = array() ) {
    $menu_class = ! empty( $args['menu_class'] ) ? $args['menu_class'] : 'kreativ-primary-menu';
    ?>
    <ul class="<?php echo esc_attr( $menu_class ); ?>">
        <?php wp_list_pages( array( 'depth' => 1, 'title_li' => '' ) ); ?>
    </ul>
    <?php
}

function kreativ_enqueue_page_assets() {
    $theme_version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'kreativ-navigation',
        get_template_directory_uri() . '/js/theme-navigation.js',
        array(),
        $theme_version,
        true
    );

    wp_enqueue_script(
        'kreativ-dark-mode',
        get_template_directory_uri() . '/js/theme-dark-mode.js',
        array(),
        $theme_version,
        true
    );

    wp_localize_script(
        'kreativ-dark-mode',
        'kreativCoreSettings',
        array(
            'darkModeLabel' => __( 'Toggle dark mode', 'kreativ-core' ),
            'submenuLabel'  => __( 'Toggle submenu', 'kreativ-core' ),
            'menuLabel'     => __( 'Menu', 'kreativ-core' ),
            'closeMenuLabel'=> __( 'Close menu', 'kreativ-core' ),
        )
    );

    if ( is_page_template( 'template-filter-all.php' ) ) {
        wp_enqueue_style(
            'kreativ-home',
            get_template_directory_uri() . '/css/kreativ-home.css',
            array( 'kreativ-global' ),
            $theme_version
        );
    }
}
add_action( 'wp_enqueue_scripts', 'kreativ_enqueue_page_assets' );


function kreativ_get_post_thumbnail_markup( $post_id = 0, $size = 'medium', $attributes = array() ) {
    $post_id = $post_id ? absint( $post_id ) : get_the_ID();

    $default_attributes = array(
        'class'    => 'card-img-top',
        'loading'  => 'lazy',
        'decoding' => 'async',
        'sizes'    => '(max-width: 575px) 100vw, (max-width: 991px) 50vw, (max-width: 1199px) 33vw, 25vw',
    );

    $attributes = wp_parse_args( $attributes, $default_attributes );
    if ( has_post_thumbnail( $post_id ) ) {
        if ( empty( $attributes['alt'] ) ) {
            $attributes['alt'] = trim( wp_strip_all_tags( get_the_title( $post_id ) ) );
        }

        return get_the_post_thumbnail( $post_id, $size, $attributes );
    }

    $class = trim( ( $attributes['class'] ?? '' ) . ' kreativ-fallback-thumb' );

    return sprintf(
        '<span class="%1$s" aria-hidden="true"></span>',
        esc_attr( $class )
    );
}

function kreativ_get_thumbnail_allowed_html() {
    static $allowed_html = null;

    if ( null === $allowed_html ) {
        $allowed_html = wp_kses_allowed_html( 'post' );
        $allowed_html['img'] = array_merge(
            $allowed_html['img'] ?? array(),
            array(
                'alt'           => true,
                'class'         => true,
                'decoding'      => true,
                'fetchpriority' => true,
                'height'        => true,
                'loading'       => true,
                'sizes'         => true,
                'src'           => true,
                'srcset'        => true,
                'width'         => true,
            )
        );
        $allowed_html['span'] = array_merge(
            $allowed_html['span'] ?? array(),
            array(
                'aria-hidden' => true,
                'class'       => true,
            )
        );
    }

    return $allowed_html;
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

    return __( 'A lightweight, responsive WordPress site.', 'kreativ-core' );
}

function kreativ_get_archive_heading() {
    $heading = trim( (string) get_theme_mod( 'kreativ_archive_heading', '' ) );

    return '' !== $heading ? $heading : __( 'Latest posts', 'kreativ-core' );
}

function kreativ_get_archive_intro() {
    return trim( (string) get_theme_mod( 'kreativ_archive_intro', '' ) );
}

function kreativ_get_posts_index_heading() {
    $posts_page_id = (int) get_option( 'page_for_posts' );

    if ( is_home() && $posts_page_id ) {
        return get_the_title( $posts_page_id );
    }

    return kreativ_get_archive_heading();
}

function kreativ_get_archive_sort() {
    $sort = isset( $_GET['sort'] ) ? sanitize_key( wp_unslash( $_GET['sort'] ) ) : 'latest';

    return in_array( $sort, array( 'latest', 'popular' ), true ) ? $sort : 'latest';
}

function kreativ_get_taxonomy_archive_query( $taxonomy, $term_id, $sort = 'latest' ) {
    $taxonomy = sanitize_key( $taxonomy );
    $sort     = in_array( $sort, array( 'latest', 'popular' ), true ) ? $sort : 'latest';

    return new WP_Query(
        array(
            'post_type'           => 'post',
            'posts_per_page'      => (int) get_option( 'posts_per_page' ),
            'paged'               => max( 1, (int) get_query_var( 'paged' ) ),
            'orderby'             => 'popular' === $sort ? 'comment_count' : 'date',
            'order'               => 'DESC',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'tax_query'           => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'term_id',
                    'terms'    => array( absint( $term_id ) ),
                ),
            ),
        )
    );
}

function kreativ_render_post_card() {
    $post_type = get_post_type();
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'kreativ-post-card' ); ?>>
        <?php if ( is_sticky() ) : ?>
            <p class="kreativ-post-card-badge"><?php esc_html_e( 'Featured', 'kreativ-core' ); ?></p>
        <?php endif; ?>

        <div class="kreativ-post-card-media" aria-hidden="true">
            <?php
            echo wp_kses(
                kreativ_get_post_thumbnail_markup(
                    get_the_ID(),
                    'medium_large',
                    array(
                        'class' => 'kreativ-post-card-image',
                        'sizes' => '(max-width: 767px) 100vw, (max-width: 1199px) 32vw, 18vw',
                    )
                ),
                kreativ_get_thumbnail_allowed_html()
            );
            ?>
        </div>

        <div class="kreativ-post-card-heading">
            <h2>
                <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                    <?php echo esc_html( get_the_title() ); ?>
                </a>
            </h2>

            <div class="kreativ-post-card-meta">
                <?php
                $date       = esc_html( get_the_date( 'F j, Y' ) );
                $categories = get_the_category_list( ', ' );

                if ( 'page' === $post_type ) {
                    $post_meta = __( 'Page', 'kreativ-core' );
                } elseif ( 'post' === $post_type && $categories ) {
                    $post_meta = sprintf(
                        /* translators: 1: publication date, 2: linked post categories. */
                        __( 'Published on %1$s in %2$s.', 'kreativ-core' ),
                        $date,
                        wp_kses_post( $categories )
                    );
                } else {
                    $post_meta = sprintf(
                        /* translators: %s: publication date. */
                        __( 'Published on %s.', 'kreativ-core' ),
                        $date
                    );
                }

                echo wp_kses_post( $post_meta );
                ?>
            </div>
        </div>

        <div class="kreativ-post-card-summary">
            <?php the_excerpt(); ?>
            <a class="kreativ-post-card-link" href="<?php echo esc_url( get_permalink() ); ?>">
                <?php esc_html_e( 'Read article', 'kreativ-core' ); ?>
            </a>
        </div>
    </article>
    <?php
}

function kreativ_render_pagination( $query = null, $args = array() ) {
    $pagination_args = array(
        'mid_size'  => 1,
        'prev_text' => __( 'Previous', 'kreativ-core' ),
        'next_text' => __( 'Next', 'kreativ-core' ),
    );

    if ( $query instanceof WP_Query ) {
        $pagination_args['total']   = max( 1, (int) $query->max_num_pages );
        $pagination_args['current'] = max( 1, (int) get_query_var( 'paged' ) );
    }

    $pagination_args = wp_parse_args( $args, $pagination_args );

    $pagination = paginate_links( $pagination_args );

    if ( $pagination ) {
        echo wp_kses_post( $pagination );
    }
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
            'title'    => __( 'Theme Options', 'kreativ-core' ),
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
            'label'       => __( 'Show theme related posts on single posts', 'kreativ-core' ),
            'description' => __( 'Disable this if another plugin or custom system handles related posts.', 'kreativ-core' ),
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
            'label'       => __( 'Featured category slugs', 'kreativ-core' ),
            'description' => __( 'Optional comma-separated category slugs for the homepage sections. Leave empty to use the most active categories automatically.', 'kreativ-core' ),
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
            'label'       => __( 'Footer text', 'kreativ-core' ),
            'description' => __( 'Optional footer note shown below the footer menu.', 'kreativ-core' ),
        )
    );

    $wp_customize->add_setting(
        'kreativ_archive_heading',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'kreativ_archive_heading',
        array(
            'type'        => 'text',
            'section'     => 'kreativ_theme_options',
            'label'       => __( 'Blog archive heading', 'kreativ-core' ),
            'description' => __( 'Optional heading for the main posts archive. Leave empty to use “Latest posts”.', 'kreativ-core' ),
        )
    );

    $wp_customize->add_setting(
        'kreativ_archive_intro',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        )
    );

    $wp_customize->add_control(
        'kreativ_archive_intro',
        array(
            'type'        => 'textarea',
            'section'     => 'kreativ_theme_options',
            'label'       => __( 'Blog archive introduction', 'kreativ-core' ),
            'description' => __( 'Optional introductory text below the main posts archive heading.', 'kreativ-core' ),
        )
    );

    $wp_customize->add_setting(
        'kreativ_accent_color',
        array(
            'default'           => '#c7184d',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'kreativ_accent_color',
            array(
                'section' => 'kreativ_theme_options',
                'label'   => __( 'Accent color', 'kreativ-core' ),
            )
        )
    );

    $wp_customize->add_setting(
        'kreativ_archive_density',
        array(
            'default'           => 'comfortable',
            'sanitize_callback' => 'kreativ_sanitize_archive_density',
        )
    );

    $wp_customize->add_control(
        'kreativ_archive_density',
        array(
            'type'    => 'select',
            'section' => 'kreativ_theme_options',
            'label'   => __( 'Archive spacing', 'kreativ-core' ),
            'choices' => array(
                'comfortable' => __( 'Comfortable', 'kreativ-core' ),
                'compact'     => __( 'Compact', 'kreativ-core' ),
            ),
        )
    );

    $wp_customize->add_setting(
        'kreativ_style_variation',
        array(
            'default'           => 'journal',
            'sanitize_callback' => 'kreativ_sanitize_style_variation',
        )
    );

    $wp_customize->add_control(
        'kreativ_style_variation',
        array(
            'type'        => 'select',
            'section'     => 'kreativ_theme_options',
            'label'       => __( 'Design variation', 'kreativ-core' ),
            'description' => __( 'Choose the default visual direction for the theme.', 'kreativ-core' ),
            'choices'     => array(
                'journal'   => __( 'Journal', 'kreativ-core' ),
                'studio'    => __( 'Studio', 'kreativ-core' ),
                'portfolio' => __( 'Portfolio', 'kreativ-core' ),
            ),
        )
    );

}
add_action( 'customize_register', 'kreativ_customize_register' );

function kreativ_sanitize_archive_density( $value ) {
    return in_array( $value, array( 'comfortable', 'compact' ), true ) ? $value : 'comfortable';
}

function kreativ_sanitize_style_variation( $value ) {
    return in_array( $value, array( 'journal', 'studio', 'portfolio' ), true ) ? $value : 'journal';
}

function kreativ_add_theme_option_body_classes( $classes ) {
    $classes[] = 'kreativ-archive-density-' . sanitize_html_class( get_theme_mod( 'kreativ_archive_density', 'comfortable' ) );
    $classes[] = 'kreativ-style-' . sanitize_html_class( get_theme_mod( 'kreativ_style_variation', 'journal' ) );

    if ( kreativ_get_custom_accent_color() ) {
        $classes[] = 'kreativ-has-custom-accent';
    }

    return $classes;
}
add_filter( 'body_class', 'kreativ_add_theme_option_body_classes' );

function kreativ_get_custom_accent_color() {
    return sanitize_hex_color( get_theme_mod( 'kreativ_accent_color', false ) );
}

function kreativ_add_theme_option_styles() {
    $accent_color = kreativ_get_custom_accent_color();

    if ( $accent_color ) {
        wp_add_inline_style( 'kreativ-core', 'body.kreativ-has-custom-accent { --color-brand: ' . $accent_color . '; }' );
    }
}
add_action( 'wp_enqueue_scripts', 'kreativ_add_theme_option_styles', 20 );

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

function kreativ_print_dark_mode_bootstrap() {
    ?>
    <script>
    try {
        if ( window.localStorage && 'true' === window.localStorage.getItem( 'kreativ-dark' ) ) {
            document.documentElement.classList.add( 'kreativ-dark-mode' );
        }
    } catch ( error ) {}
    </script>
    <?php
}
add_action( 'wp_head', 'kreativ_print_dark_mode_bootstrap', 0 );

function kreativ_is_new_post( $post_id ) {
    return ( time() - get_post_time( 'U', true, $post_id ) ) <= 7 * DAY_IN_SECONDS;
}
